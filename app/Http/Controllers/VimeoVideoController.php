<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Vimeo\Vimeo;
use Log;

class VimeoVideoController extends Controller
{
    //
    protected $folder_id = "16219131"; // For the GEN.iality folder

    private function getVimeoClient() {
        $client = new Vimeo(
            "4f529fcb6e53b1d98128f422b0da074c4e5dcd3d",
            "5bMw/derPE1J2RtkiNCOLZFh0zORhFOOR3VCLnuSkm6uMqEsW+cOeE3xO5xYOcdFoIGpUQE7/QP9ITPpLSkVx1k2eYid8iUEOnhipTkbkymYf5IxwDsbWNxYREFDhYEk",
            "0deea97a5f2f0316ef84de0a33d83421",
        );
        return $client;
    }

    private function uploadVideoToVimeo($file, $file_name, $file_description) {
        $client = $this->getVimeoClient();

        // $new_file = '/var/www/public/uploaded/uploaded_'.$file_name;
        // if (!copy($file, $new_file)) {
        //     Log::error("Cannot copy the file ".$file." to ".$new_file);
        //     return;
        // }

        $uri = $client->upload($file, array(
            "name" => $file_name,
            "description" => $file_description,
            "folder_uri" => "https://vimeo.com/manage/folders/".$this->folder_id,
        ));

        Log::debug("Your video URI is: " . $uri);

        $response = $client->request($uri . '?fields=link');
        Log::debug("Your video link is: " . $response['body']['link']);

        $response = $client->request($uri);
        $video = $response['body'];

        $embed_link = $video['embed']['html'];
        Log::debug("embeding link: ".$embed_link);

        $regex = '/src="(.*?)"/';
        $matches = array();
        if (preg_match($regex, $embed_link, $matches)) {
            $src = $matches[1];
            Log::debug('final url for embeding: '.$src);
            return $src;
        }

        return $uri;
    }


    public function videoStatus(Request $request, string $video_id = null) {
        // First, take the file sent
        $client = $this->getVimeoClient();

        $video_id = $request->query('video_id');

        $uri = '/videos/'.$video_id.'?fields=uri,upload.status,transcode.status';

        $response = $client->request($uri);
        $body = $response['body'];
        return response()->json(['status' => json_encode( $body) ]);

    }  

    public function downloadVideo(Request $request) {
        $vimeo_url = $request->query('vimeo_url');

        Log::debug($vimeo_url);

        $url_components = parse_url($vimeo_url);
        if (!isset($url_components['path'])) {
            return response()->json(['error' => 'URL is invalid'], 404);
        }

        $path_parts = explode("/", $url_components["path"]);
        $vimeo_video_id = end($path_parts);
        if (!isset($vimeo_video_id)) {
            return response()->json(['error' => 'URL is invalid: no ID found'], 404);
        }

        // Ask for Vimeo
        $client = $this->getVimeoClient();

        $response = $client->request("/videos/${vimeo_video_id}", [], "GET");

        $width = $response['body']['width'];
        $height = $response['body']['height'];
        $name = $response['body']['name'];
        Log::debug("max width: $width - max height: $height");
        Log::debug("vimeo video name: $name");

        $download = $response['body']['download'];
        if (!isset($download)) {
            return response()->json(['error' => 'no options to download'], 404);
        }

        $best = end($download);

        $link = $best['link'];

        Log::debug("will download the vimeo video at expireable link: $link");

        $data = file_get_contents($link);

        if (!isset($data) || $data == false) {
            return response()->json(['error' => 'maybe the link expired']);
        }

        $file = $data;

        return response($file)
            ->header('Content-Type', 'video/mp4')
            ->header('Content-Disposition', 'attachment; filename="' . $name .'.mp4'. '"');
    }

    public function uploadVideo(Request $request, string $field_name = null) {
        // First, take the file sent
        $field_name = 'file';
        if (!$request->hasFile($field_name)) {
            $statusCode = "400";
            $message = "No file found in field '" . $field_name . "' to be uploded";
            return response()->json(['error' => $message], $statusCode);
        }
        $files = $request->file($field_name);
        $files = is_array($files) ? $files : [$files];

        // We need this the description or not, we don't care
        $file_description = $request->query('description');
        if (!isset($file_description)) $file_description = "Nuevo vídeo subido [fecha]";

        // For each video, we will upload and save the vimeo uri in an array
        $all_good = true;
        $uri_list = [];
        foreach ($files as $file) {
            //name
            $file_name = time();
            if (is_object($file) && isset($file->getClientOriginalName)) {
                $file_name .= "_" . preg_replace("/[^[:alnum:][:space:]]/u", '', $file->getClientOriginalName());
            }
            // If the video has no extension, then we set .mp4 just because
            if (strpos($file_name, '.') == false) {
                $file_name .= '.mp4';
            }
            Log::debug("will upload as ".$file_name);

            $uri = $this->uploadVideoToVimeo($file->getPathname(), $file_name, $file_description);

            if ($uri) {
                array_push($uri_list, $uri);
            } else {
                Log::error('Cannot upload this video: '.$file);
                $all_good = false;
            }
        }

        if (!$all_good) {
            return response()->json(['error' => 'Cannot upload the files and nobody knows the reason :c']);
        }
        return response()->json(['uri_list' => $uri_list]);
    }
}
