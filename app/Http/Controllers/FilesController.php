<?php
namespace App\Http\Controllers;

use App\evaLib\Services\GoogleFiles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * @group Files
 *
 * Files handing mostly used to upload new files
 */
class FilesController extends Controller
{

/**
 * Uploads files send though HTTP multipart/form-data
 *
 * Uploads provided file though HTTPFile  multipart/form-data; and returns full file URL.
 *
 * In the request the file data came in field called file.
 *
 * But in case this field name should be changed, It could be done though
 *
 * field_name parameter
 *
 * HTTPFile could be just one file on multiple files,
 *
 *  for one file this function returns  a string with the url
 * for multiple files It returns an array of URLS.
 *
 * @bodyParam  file file required file sent using multipart/form-data;
 *
 * Example request;
 * using axios, varible file contains data from a input HTML file field
 *
 *  let data = new FormData();
 *  data.append("file", file);
 *  await = axios.post(url, data);
 *  console.log(`Data: ${res.data}`);
 *
 * @param Request $request
 * @param string $field_name
 * @param GoogleFiles $gfService
 * @return string of file uploaded url  or  array of urls for multiple files
 *
 */
    public function upload(Request $request, string $field_name = null, GoogleFiles $gfService)
    {
        //@debug post $entityBody = file_get_contents('php://input');
        $imgurls = [];

        //valor por defecto de campo que contiene el archivo
        $field_name = ($field_name) ? $field_name : "file";
        
        //No viene ningun archivo
        if (!$request->hasFile($field_name)) {
            $statusCode = "400";
            $message = "No file found in field '" . $field_name . "' to be uploded";
            return response()->json(['error' => $message], $statusCode);
        }
        $files = $request->file($field_name);

        //convertimos un solo elemento a array
        $files = is_array($files) ? $files : [$files];

        foreach ($files as $file) {

            //name
            $name = time();
            if (is_object($file) && isset($file->getClientOriginalName)) {
                $name .= "_" . preg_replace("/[^[:alnum:][:space:]]/u", '', $file->getClientOriginalName());
            }

            //extension
            if (is_object($file) && isset($file->guessExtension) && $file->guessExtension()) {
                $name .= "." . $file->guessExtension();
                return $name;
            } else if (is_object($file) && isset($file->getClientOriginalExtension) && $file->getClientOriginalExtension()) {
                $name .= "." . $file->getClientOriginalExtension();
            } else {
                //suponemos es una imagen por defecto ya en caso extremo
                $name .= ".png";
            }

            $imgurls[] = $gfService->storeFile($file, $name);
        }
        //devolvemos una cadena o un arreglo segun sea el caso
        return (count($imgurls) > 1) ? $imgurls : reset($imgurls);

    }
    /**
     * _storeBaseImg_: Uploads images send though HTTP multipart/form-data  with resizing option

     * Uploads files send though HTTP multipart/form-data
     *
     * Uploads provided file though HTTPFile  multipart/form-data; and returns full file URL.
     *
     * In the request the file data came in field called file.
     *
     * But in case this field name should be changed, It could be done though
     *
     * field_name parameter
     *
     * HTTPFile could be just one file on multiple files,
     *
     *  for one file this function returns  a string with the url
     * for multiple files It returns an array of URLS.
     *
     * @bodyParam  file file required file sent using multipart/form-data;
     * @bodyParam  type string  ["icon" => 240, "wall" => 500, "default" => 600, "email" => 600]; by default 600
     * @urlParam   name  file field by default file
     * Example request;
     * using axios, varible file contains data from a input HTML file field
     *
     *  let data = new FormData();
     *  data.append("file", file);
     *  await = axios.post(url, data);
     *  console.log(`Data: ${res.data}`);
     */

    public function storeBaseImg(Request $request, string $key = "file", GoogleFiles $gfService)
    {
        Image::configure(array('driver' => 'imagick'));
        $data = $request->all();
        $name = $key;
        $img = $data[$key];
        $formats = array("png", "jpg", "jpeg");

        $ext = "png";
        foreach ($formats as $format) {
            if (stristr($img, $format)) {
                $ext = $format;
                break;
            }
        }
        $name = $name . time() . "." . $ext;

        $width_size = 600;
        $width_sizes = ["icon" => 240, "wall" => 500, "default" => 600, "email" => 600];
        if ((isset($data['type']) && isset($width_sizes[$data['type']]))) {
            $width_size = $width_sizes[$data['type']];
        }

        $imgresize = self::imgResize($img, $ext, $width_size);

        $image = base64_decode(base64_encode($imgresize));
        $imgurl = $gfService->storeFile($image, $name);
        return $imgurl;
    }

    private static function imgResize($img, $ext, $width_size)
    {
        return Image::make($img)->resize($width_size, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode($ext);
    }
}
