<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),
    //'default' => env('FILESYSTEM_DRIVER', 'gcs'),
    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 'gcs'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        /* 'google' => [
            'driver' => 's3',
            'key' => env('evius-storage'),
            'secret' => env('-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQC5nccx9xtdoho3\nRi5rtwXuARZ7Z7KdBS7yBMUmseQfMM+8ms11s+JtPiMoAwGPsJCtdWS5JRJzN7jE\n2oqIldCdONu7bZS+8BeCxic/cOHPlHgDnFVWUn/YdBeQgrY0VSsa+aW+vn1r+pir\n43ZOXji8h98iiH4UZQOSHj7sGLn74+juQ+IykIzqKgeef+OihSqKYzXI43S4abWF\nbDdzrwpGvJG5F/voHpNDqHHAM6Aeb7aPfy4IOCcTn8kJkrCYKfq0tOZbazkUZgHm\n/hh+DQrLksdMtnx7ux73TxurEsix2jR24Jetku6iuH2/0iuGJaG+q1vUlGsguq6b\ncxxOYHkpAgMBAAECggEAR9evv8EbEHSrnPVHBl4Cp4o4P291jJzy/K2n+UAlQYVN\nAn0QRRxo6UuBo/z1373BYcHsSFT2/S12EItdz1vdMN1O/w584iJflzhG/KEeZY/b\nm9oolY68+PSGImLVTxAf7QLvihKEzQRjjzQtGEwTvbUBQoZ99jra1PVr+UngwoNd\nZVCXuxdNUkzmf1d9ro+vUMXU0HKE/QBWTQfytJFXndXeEODea+fEVhBM2QUngvx6\nfvMr/W/f5Jv7jh6N+fOZ3IMRhA/73155Opq8evwKo7VGmGMTbOyfqBkaOw+XFj7T\nVvLuKh4Ihl3hGppvyCJhzBqbWjd+PBC997HiM79rOQKBgQDcf8e0tUCrcDo4lCmi\nNGrjBqMVA3iW3qsCe5nUy7wtMC+k+o8Wh15rWYOlCY/YrrYYD8nV4j4/eKkzWMfy\nQBXnqjbCnE+bbTg6RkAkYvxy6cNNCKm5gJrbYvx4elfUxWJjm6hB7nTooqrR3jb8\nkNoUiyDdDtI1bdpSZyH5Em8SlwKBgQDXgD9fFgR8zM/jlfQHCSqW9MrUeI/FAh7n\n3hmEqWbIBhXL/1uhFgFo82bqNbiqJbVn4qf5Az1y5Md48mP2jYLUH/CBNaLkm6uQ\nRWhR5+l6wiRPW2LuYKx61law9Fw5uS4bMreWRAzmh04/OSaniNzCcXFZzm3vVwwZ\ngqeMa1cKPwKBgDnVFecSpwyQGeUfDzBo+SPkaL+pMma3rjivfHBwo0Fi4wwtX3w0\nMxKK3tlZga3+XOpAsdp0RYlWN2KtRXwHTPd/EG/ImaSVZ+r44/fnMnldUIkS3Zk2\n3ubttnRO+lxnDOA9QktQpL8jcxQqaVejEl/TAeKY8Y9r6Zg1TpbKO/GvAoGAVC6c\nEsfmDt5vI0dToV/6TCfqB9/kwZ/XdNo0+7a1GNQPtbXWFHIlMNtMS5eawJSkbaWD\n2mlimrw2E9AULp8PCVBEwiSysj0BYwVKABzo/vRR/NIFLnuDRSTvjoaWdFIbabKB\nNuj0ZSVb8qSfrfhvzGFGVz+lgEZvypNYYikYQj8CgYAYqU2v3EjSMiWpGBRq6kzm\n34hc/+Mxv/r4x1NgJJq3savtsjPzSZQPOFTIoywZmE3gagkv+/STDcHLomz5KSKE\n8bzSUblJOcM6wYYtXd67H4Hzv6COuWwhbTz2/mhTJCgS77DxywsuJxvahEOsr1nA\n39a0NvQKDp/I+bHiLvNQ3g==\n-----END PRIVATE KEY-----\n'),
            'bucket' => env('herba-images'),
            'region' => env('us-central1'),
            'base_url' => env('https://storage.googleapis.com'),
        ], */
        'gcs' => [
            'driver' => 'gcs',
            'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'eviusauth'),
            'key_file' => env('GOOGLE_CLOUD_KEY_FILE', base_path("/firebase_credentials.json")), // optional: /path/to/service-account.json
            'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'eviusauth.appspot.com'),
            'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', null), // optional: /default/path/to/apply/in/bucket
            'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
        ],

    ],

];
