<?php

namespace App\Http\Controllers;

use App\Url;

class UrlController extends Controller
{
    public function redirectToLanding(string $code)
    {
        $url = Url::where('code', $code)->first();
        if (isset($url)) {
            return redirect($url->long_url);
        }
        return redirect(config('app.front_url'));
    }
}
