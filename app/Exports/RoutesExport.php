<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Concerns\FromView;

class RoutesExport implements FromView
{
  public function view(): View
  {
      // OBTENER TODAS LAS RUTAS DISPONIBLES Y MODIFICARLAS
      $routeCollection = Route::getRoutes();
      $allRoutes = [];
      foreach ($routeCollection as $value) {
          array_push($allRoutes, ['url' => $value->uri, 'method' => $value->methods[0]]);
      }
      $routesMod1 = [];
      foreach ($allRoutes as $route) {
          array_push($routesMod1, ['url' => str_replace('{', ':', $route['url']), 'method' => $route['method']]);
      }
      $routesMod2 = [];
      foreach ($routesMod1 as $route) {
          array_push($routesMod2, ['url' => str_replace('}', '', $route['url']), 'method' => $route['method']]);
      }
      // OBTENER TODAS LAS RUTAS DOCUMENTADAS
      $apidoc = json_decode( file_get_contents('/var/www/public/docs/collection.json'), true);
      $items = $apidoc['item'];
      $routeDocs = [];
      foreach ($items as $item) {
          $requests = $item['item'];
          foreach ($requests as $request) {
            array_push($routeDocs, [ 'url' => $request['request']['url']['path'], 'method' => $request['request']['method'] ]);
          }
      }

      return view('routesExport', ['withDocs' => $routeDocs, 'allRoutes' => $routesMod2]);
  }
}
