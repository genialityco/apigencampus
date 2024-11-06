<?php

if (!defined("SUGGESTED")) {
    define("SUGGESTED", "SUGGESTED");
}

if (!defined("EXCLUSIVE")) {
    define("EXCLUSIVE", "EXCLUSIVE");
}

if (!defined("OPEN")) {
    define("OPEN", "OPEN");
}

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
     */

    'name' => env('APP_NAME', 'Evius'),
    'aws_key' => env('AWS_KEY', 'production'),
    'aws_secret' => env('AWS_SECRET', 'production'),
    'front_url' => env('FRONT_URL', 'https://app.evius.co'),
    'evius_api' => env('EVIUS_API', 'https://api.evius.co/api'),
    'page_size' => 2500,
    'sendinblue_page' => 'https://api.sendinblue.com/v2.0', // Wasn't this deleted yet?
    'default_event_styles' => ['buttonColor' => "#FFF", 'banner_color' => "#FFF", 'menu_color' => "#FFF", 'event_image' => "#FFF", 'banner_image' => "#FFF", 'menu_image' => "#FFF", 'banner_image_email' => "", 'footer_image_email' => ""],
    'app_configuration' => [],
    'access_restriction_types_available' => [SUGGESTED, EXCLUSIVE, OPEN],
    'pushdirection' => env('PUSH_URL', 'production'),
    'api_evius' => env('EVIUS_API', 'https://api.evius.co/api'),
    'encryption_iv' => env('ENCRYPTION_IV', "1234567812345678"),
    'encryption_key' => env('ENCRYPTION_KEY'),
    'zoom_server' => env('ZOOM_API'),
    'support_email' =>env('SUPPORT_EMAIL','soporte@evius.co'),
    'base_uri' => env('BASE_URI', 'https://graph.facebook.com/v14.0/100339866185300/'), //whatsapp base uri
    'authorization' => env('AUTHORIZATION'), //whatsapp token
    'authorization_mmasivo' => env('AUTHORIZATION_MMASIVO'), //mmasivo token
    'rol_admin' => env('ROL_ADMIN', '5c1a59b2f33bd40bb67f2322'), //rol admin
    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
     */

    'url' => env('APP_URL', 'https://api.evius.co'),
    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
     */

    'env' => env('APP_ENV', 'development'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
     */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
     */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
     */

    'locale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
     */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
     */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
     */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Sentry\Laravel\ServiceProvider::class,
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        RealRashid\SweetAlert\SweetAlertServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\TelescopeServiceProvider::class,
        App\Providers\HelpersServiceProvider::class,
        App\Providers\BroadcastServiceProvider::class,
        App\Providers\EvaFilesServiceProvider::class,
        App\Providers\EvaRolServiceProvider::class,
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\TelescopeServiceProvider::class,

        /*
         * Third Party Service Providers attendize platform
         */
        //Aws\Laravel\AwsServiceProvider::class,
        Vinelab\Http\HttpServiceProvider::class,
        Milon\Barcode\BarcodeServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        // Maatwebsite\Excel\ExcelServiceProvider::class,
        Laravel\Socialite\SocialiteServiceProvider::class,
        Nitmedia\Wkhtml2pdf\L5Wkhtml2pdfServiceProvider::class,
        // Mews\Purifier\PurifierServiceProvider::class,
        MaxHoffmann\Parsedown\ParsedownServiceProvider::class,
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        Laracasts\Utilities\JavaScript\JavaScriptServiceProvider::class,
        Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider::class,

        /**
         * Third Party Service Providers EVIUS platform
         */
        Collective\Html\HtmlServiceProvider::class,
        Superbalist\LaravelGoogleCloudStorage\GoogleCloudStorageServiceProvider::class,
        Jenssegers\Mongodb\MongodbServiceProvider::class,
        Jenssegers\Mongodb\MongodbQueueServiceProvider::class,
        Mpociot\ApiDoc\ApiDocGeneratorServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,
        Spatie\Permission\PermissionServiceProvider::class,
        Maatwebsite\Excel\ExcelServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
     */

    'aliases' => [
        'Sentry' => Sentry\Laravel\Facade::class,
        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'LaravelEvent' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Input' => Illuminate\Support\Facades\Input::class,
        'Inspiring' => Illuminate\Foundation\Inspiring::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Form' => Collective\Html\FormFacade::class,
        'HTML' => Collective\Html\HtmlFacade::class,
        'Str' => Illuminate\Support\Str::class,
        'Utils' => App\Attendize\Utils::class,
        'Carbon' => Carbon\Carbon::class,
        'DNS1D' => Milon\Barcode\Facades\DNS1DFacade::class,
        'DNS2D' => Milon\Barcode\Facades\DNS2DFacade::class,
        'Image' => Intervention\Image\Facades\Image::class,
        // 'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        'Socialize' => Laravel\Socialite\Facades\Socialite::class,
        'HttpClient' => Vinelab\Http\Facades\Client::class,
        // 'Purifier' => Mews\Purifier\Facades\Purifier::class,
        'Markdown' => MaxHoffmann\Parsedown\ParsedownFacade::class,
        'Omnipay' => Omnipay\Omnipay::class,
        'LaravelLocalization' => Mcamara\LaravelLocalization\Facades\LaravelLocalization::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Moloquent' => Jenssegers\Mongodb\Eloquent\Model::class,
        'PDF' => Barryvdh\DomPDF\Facade::class,
        'AWS' => Aws\Laravel\AwsFacade::class,
        //Not support by this version 'PDF' => Nitmedia\Wkhtml2pdf\Facades\Wkhtml2pdf::class,
        'Form' => Collective\Html\FormFacade::class,
        'HTML' => Collective\Html\HtmlFacade::class,
        'Alert' => RealRashid\SweetAlert\Facades\Alert::class,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,

    ],

    'human' => [
        'sms_checker' => env('PHONE_NUMBER_HUMAN_CHECKER'),
    ],

];
