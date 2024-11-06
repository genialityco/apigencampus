<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

use Log;

class AwsS3Controller extends Controller
{
    public function __invoke(string $prefix = null)
    {

        $s3conf = [
            'version' => 'latest',
            'region'  => 'sa-east-1'
        ];

        $bucket = 'caracolinternacional';


        $client = new S3Client($s3conf);

        $result = $client->listObjects([
            'Bucket' => $bucket, // REQUIRED
            // 'Delimiter' => '<string>',
            // 'EncodingType' => 'url',
            // 'ExpectedBucketOwner' => '<string>',
            // 'KeyMarker' => '<string>',
            // 'MaxKeys' => <integer>,
            'Prefix' => $prefix
            // 'VersionIdMarker' => '<string>',
        ]);

        // $result = $client->listObjects([
        //     'Bucket' => $bucket, // REQUIRED
        //     'Delimiter' => '/',
        //     'EncodingType' => 'url',
        //     'ExpectedBucketOwner' => 'root',
        //     //'Marker' => '<string>',
        //     'MaxKeys' => 100,
        //     'Prefix' => $prefix,
        //     'RequestPayer' => 'requester',
        // ]);
        // Log::info($result);

        return $result;
    }
}
