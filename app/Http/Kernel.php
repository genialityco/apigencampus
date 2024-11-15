<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */

    protected $middleware = [
        \App\Http\Middleware\Cors::class,
        \App\Http\Middleware\SetLanguage::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,

        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,

        // \App\Http\Middleware\ForceJsonResponse::class,
        
        // \Illuminate\Session\Middleware\StartSession::class,
        // \Illuminate\View\Middleware\ShareErrorsFromSession::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            // \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \Spatie\ResponseCache\Middlewares\CacheResponse::class,
        ],

        'api' => [
            //'throttle:6000,1',
            // \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\ForceJsonResponse::class,
            'bindings',
            // \Spatie\ResponseCache\Middlewares\CacheResponse::class,
        ],
        'token' => [
            \App\Http\Middleware\ForceJsonResponse::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'first.run' => \App\Http\Middleware\FirstRunMiddleware::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
        'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
        'installed' => \App\Http\Middleware\CheckInstalled::class,
        'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
        'cacheResponse' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
        'permission' => \App\Http\Middleware\Permissions\PermissionMiddleware::class,
        'permissionUser' => \App\Http\Middleware\Permissions\PermissionsManageUser::class,
        'permissionAttendee' => \App\Http\Middleware\Permissions\PermissionAttendeeMidleware::class,
        // Restriction plan
        'userRegistrationRestriction' => \App\Http\Middleware\RestrictionPlan\UserRegistrationRestriction::class,
        'OrganizersRestriction' => \App\Http\Middleware\RestrictionPlan\OrganizersRestriction::class

    ];
}