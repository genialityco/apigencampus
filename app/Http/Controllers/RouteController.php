<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RoutesExport;

class RouteController extends Controller
{
  public function index() 
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
  $apidoc = json_decode( file_get_contents('../public/docs/collection.json'), true);
  $items = $apidoc['item'];
  $routeDocs = [];
  foreach ($items as $item) {
      $requests = $item['item'];
      foreach ($requests as $request) {
	array_push($routeDocs, [ 'url' => $request['request']['url']['path'], 'method' => $request['request']['method'] ]);
      }
  }
  // Ver rutas sin docs
  $routeWithoutDocs = [];
  foreach ($routesMod2 as $route) {
    !in_array($route, $routeDocs) ? array_push($routeWithoutDocs, $route) : null ;
  }

  return view('routes')->with(['withDocs' => $routeDocs, 'allRoutes' => $routesMod2]);
  }
  public function excel()
  {
    return Excel::download(new RoutesExport, 'routes-doc.xlsx');
  }
}
