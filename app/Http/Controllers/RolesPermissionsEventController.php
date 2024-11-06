<?php

namespace App\Http\Controllers;

use App\Rol;
use App\Attendee;
use App\PermissionEvent;
use Illuminate\Http\Request;
use App\RolesPermissions;
use Illuminate\Http\Resources\Json\JsonResource;
use App\evaLib\Services\FilterQuery;
/**
 * @group Roles Permissions
 * These endpoint allow you manage the relationship between roles and permissions.
 * Here you can see the which permissions have the roles and also you can add permissions
 * to the roles.
 */
class RolesPermissionsEventController extends Controller
{
    /**
     * _index_: list all roles and their permissions
     * @authenticated
     * 
     * @urlParam event requires event id.
     * 
     * @response [
     *  	{
	 *      	"_id": "62265556a2634aabe418619e",
	 *      	"rol_id": "60e8a7e74f9fb74ccd00dc22",
	 *      	"permission_id": "6220f361b472fe2eb78b6d7b",
	 *      	"updated_at": "2021-08-06 19:48:01",
	 *      	"created_at": "2021-08-06 19:48:01",
	 *      	"rol": {
	 *      		"_id": "60e8a7e74f9fb74ccd00dc22",
	 *      		"name": "Attendee",
	 *      		"guard_name": "web",
	 *      		"updated_at": "2021-08-06 19:04:06",
	 *      		"created_at": "2021-07-09 19:47:51",
	 *      		"type": "attendee",
	 *      		"module": "system"
	 *      	},
	 *      	"permission": {
	 *      		"_id": "6220f361b472fe2eb78b6d7b",
	 *      		"name": "list_activities"
	 *      	}
	 *      }
     * ]
     */
    public function index($event_id, FilterQuery $filterQuery = null)
    {   
        $rolesSystem = RolesPermissions::
            whereHas('rol', function($query) use ($event_id)
            {
                $query->where('module' , Rol::MODULE_SYSTEM);
            
            })->get(); 

        $rolesEvent =  RolesPermissions::
            whereHas('rol', function($query) use ($event_id)
            {
                $query->where('modeltable_id', $event_id);
            
            })->paginate(config('app.page_size'));     
        
        $roles = $rolesEvent->concat($rolesSystem);

        return JsonResource::collection($roles);
    }

    /**
     * _indexByRoles_: list all permisos by rol
     * @authenticated
     * 
     * @urlParam event requires event id.
     * @urlParam rol requires event rol id.
     * 
     */
    public function indexByRol($event_id, $rol_id, FilterQuery $filterQuery = null)
    {   

        $query = RolesPermissions::where('rol_id' , $rol_id)
        ->whereHas('rol', function($query) use ($event_id)
        {
            $query->where('modeltable_id', $event_id);
        
        })->first();
        
        return $query;
    }

    /**
     * _store_: create new rolespermissions
     * @authenticated
     * 
     * @bodyParam rol_id string required
     * @bodyParam permission_id string required
     */
    public function store(Request $request)
    {
        $eventUser = RolesPermissions::updateOrCreate($request->json()->all());

        return new JsonResource($eventUser);
    }

    /**
     * _show_: information from a specific relationship between role and permiision 
     * @authenticated
     * 
     * @urlParam rolpermission required rolpermission_id
     */
    public function show(RolesPermissionsEventEventController $rolesPermissionsController)
    {        
        return new JsonResource($rolesPermissionsController);
    }
    
    /**
     * _update_: update a specific rolepermission
     * @authenticated
     * 
     * @bodyParam rol_id string required
     * @bodyParam permission_id string required
     */
    public function update(Request $request, RolesPermissionsEventEventController $rolesPermissionsController)
    {
        //
        $data = $request->json()->all();
        $rolespermissions = $rolesPermissionsController;
        $rolespermissions->fill($data);
        $rolespermissions->save();
        return $rolespermissions;
    }

    /**
     * _delete_: remove the specified resource from storage.
     * @authenticated
     */
    public function destroy(RolesPermissionsEventEventController $rolesPermissionsController)
    {
        //
        $rolespermissions = $rolesPermissionsController;
        $rolespermissions->delete();
    }

    /**
     * _addPermissionToRol_:
     * @authenticated
     * 
     * @urlParam rol required rol_id
     * 
     * @bodyParam module_name string required module name in prural Example: activities
     * @bodyParam permission_name string if you want create a permission diferen of CRUD addd permission name. 
     *  
     */
    public function addPermissionToRol(Request $request, $rol_id)
    {
        $data = $request->json()->all();

        $permission = Permission::updateOrCreate([
            'name' => $data['permission_name'],
            'module' => $data['module_name'],
            'guard_name' => 'web'
        ]); 
        

        //Se guardan los permisos en los roles por defecto
        //El rol de administador tendras todos los nuevo permisos que se creen
        //El rol de colaborador tendrá todos los permisos de update, list, show y create.
        $rolesdefault = ['Administrator' , 'Colaborator'];
        $roles = Rol::whereIn('name' , $rolesdefault)->get();
        

        foreach($roles as $role)
        {
            RolesPermissionsEvent::updateOrCreate(
                ["rol_id" => $role->_id,"permission_id" => $permission->_id],
            );
        }
        
        
        $roleUpdate = Rol::find($rol_id);
        
        return RolesPermissionsEvent::updateOrCreate(
            ["rol_id" => $roleUpdate->_id,"permission_id" => $permission->_id],
        );;

        //***********Este código comentado no va aquí per no eliminar  porque sirve para automatizar los roles**********
        // //Validar si se crea el crud o no
        // if($data['crud_resourse'])
        // {  
        //     $crudPermissions = [
        //         'list' => 'list_' . $data['module_name'],
        //         'show' => 'show_' .$data['module_name'],
        //         'create' => 'create_' .$data['module_name'],
        //         'update' => 'update_' .$data['module_name'] ,
        //         'destroy' =>'destroy_' .$data['module_name']
        //     ];            
            
        //     foreach($crudPermissionsas as $key => $value)
        //     {   
        //         $permission = Permission::updateOrCreate([
        //             'name' => $value,
        //             'module' => $data['module_name'],
        //             'guard_name' => 'web'
        //         ]);

        //         switch ($key) {
        //             case 'list':
        //                 RolesPermissionsEvent::updateOrCreate(
        //                     ["rol_id" => $rolAdmin->_id,"permission_id" => $permission->_id],
        //                     ["rol_id" => $rolColaborator->_id,"permission_id" => $permission->_id],
        //                     ["rol_id" => $rolAttendee->_id,"permission_id" => $permission->_id],
        //                 );
        //             break;
        //             case 'show':
        //                 RolesPermissionsEvent::updateOrCreate(
        //                     ["rol_id" => $rolAdmin->_id,"permission_id" => $permission->_id],
        //                     ["rol_id" => $rolColaborator->_id,"permission_id" => $permission->_id],
        //                     ["rol_id" => $rolAttendee->_id,"permission_id" => $permission->_id],
        //                 );
        //             break;
        //             case 'create':
        //                 RolesPermissionsEvent::updateOrCreate(
        //                     ["rol_id" => $rolAdmin->_id,"permission_id" => $permission->_id],
        //                     ["rol_id" => $rolColaborator->_id,"permission_id" => $permission->_id],
        //                 );
        //             break;
        //             case 'update':
        //                 RolesPermissionsEvent::updateOrCreate(
        //                     ["rol_id" => $rolAdmin->_id,"permission_id" => $permission->_id],
        //                     ["rol_id" => $rolColaborator->_id, "permission_id" => $permission->_id]
        //                 );
        //             break;
        //             case 'destroy':
        //                 RolesPermissionsEvent::updateOrCreate(["rol_id" => $rolAdmin->_id, "permission_id" => $permission->_id]);
        //             break;
        //         }

        //     }

        // }


    }
}
