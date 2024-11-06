<?php

namespace App\Http\Controllers;

use App\Permission;
use App\AttendeTicket;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\evaLib\Services\FilterQuery;

/**
 * @group Permissions
 * 
 * These endpoints allow you to view all permissions enabled by the system.
 */
class PermissionController extends Controller
{
    /**
     * _index_: list all permissions that you can add to the roles.
     * @authenticated
     */
    public function index(Request $request, FilterQuery $filterQuery)
    {
        //
        $input = $request->all();
        $query = Permission::paginate(config('app.page_size'));
        $results = $filterQuery::addDynamicQueryFiltersFromUrl($query, $input);
        return JsonResource::collection($results);
    }

    /**
     * _store_: Store a newly created resource in storage.     
     */
    public function store(Request $request)
    {
        //
        $routeCollection = Route::getRoutes();
        $allRoutes = [];
        foreach ($routeCollection as $value) {

            $controller = explode('@',$value->action['controller']);
            
            if($value->methods[0] === "GET" && $controller[1] === 'index')
            {   
                $module = explode('/',$value->uri);
                // echo $value->uri .'<br>';
                echo  'list_' . end($module) . ',' . end($module) .'<br>';
            }
            

        }
        dd($allRoutes);

        $result = new PermissionEvent($request->json()->all());
        $result->guard_name = 'web';
        $result->save();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(PermissionEvent $permission)
    {
        return new JsonResource($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionEvent $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermissionEvent $permission)
    {
        $data = $request->json()->all();
        $permissions = $permission;
        $permissions->fill($data);
        $permissions->save();
        return $permissions;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermissionEvent  $permission)
    {
        //
    }

    public function getUserPermissionByEvent(Request $request,$id){
        $rol = AttendeTicket::where('event_id', $id)
                                    ->where('user_id', $request->get('user')->id)->firstOrFail();
        $permissions = Rol::find($rol->rol_id);
        return $permissions;
    }
}
