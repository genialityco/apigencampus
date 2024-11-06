<?php

namespace App\Http\Controllers;

use App\Rol;
use App\OrganizationUser;
use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;
use Validator;
/**
 * @group RolEvent
 */
class RolOrganizationController extends Controller
{   
    const AVALIABLE_TYPES = 'attendee,administrator';
    const AVALIABLE_PERMISSIONS = 'list, show, update, create, destroy';

    /**
     * _index_: list all roles by event and the system default roles that can use in every events.
     * @authenticated
     * 
     * @urlParam organizaton required organization id 
     * 
     */
    public function index($organization_id)
    {
        $rolOrganization = Rol::where('organization_id' , $organization_id)->get();
        
        // This query return the default roles in the systme, this roles are going to in every events.
        $rolesSystem = Rol::where('module' , Rol::MODULE_SYSTEM)->get();
        $roles = $rolOrganization->concat($rolesSystem);
        return JsonResource::collection($roles);
    }

    
    /**
     * _store_: create a new rol
     * @authenticated
     * 
     * @urlParam organization required organization id
     * 
     * @bodyParam name string required name of the role
     * @bodyParam type string required
     * @bodyParam module required string This indicate management in to organization  organization defaul value. 
     * 
     */
    public function store($organization_id , Request $request)
    {
        //
        $rules = $request->validate([
            'name' => 'required'
        ]);
        $data = $request->json()->all();
        
        $repeatRol = Rol::where('name' , $data['name'])->fisrt();
        if(isset($repeatRol))
        {
            response()->json([
                "You can't create more than one role with the same name"
            ],409);
        }
        
        $data['module'] = 'organization';
        $data['organization_id'] = $organization_id;
              
        $result = new Rol($data);
        $result->save();
        return $result;
    }

    /**
     * _show_: information from a specific role in an event
     * @authenticated
     * 
     * @urlParam organization required organization id
     * @urlParam rol required organization rol
     */
    public function show($organization_id, $rol_id)
    {
        $rol = Rol::where('rol_id' , $rol_id)
                ->where('organization_id' , $organization_id )
                ->first();
        return $rol;
    }

    /**
     * _update_: update the specified resource in storage.
     * @authenticated
     * 
     * @urlParam organization required organization id
     * @urlParam rol required organization rol
     * 
     * @bodyParam name string required
     * @bodyParam model string required 
     * 
     */
    public function update(Request $request, $organization_id, $rol_id)
    {
        //
        $data = $request->json()->all();
        $data['organization_id'] = $organization_id;

        $rol = Rol::where('_id' , $rol_id)
                ->where('organization_id' , $organization_id )
                ->first();
        
        $rol->fill($data);
        $rol->save();
        return $rol;
    }
    
    /**
     * _destroy_:Remove the specified resource from storage.
     * @authenticated
     * 
     * @urlParam organization required organization id
     * @urlParam rol required organization rol
     */
    public function destroy($organization_id, $rol_id)
    {
        $rol = Rol::where('rol_id' , $rol_id)
            ->where('organization_id' , $organization_id )
            ->first();
        
        $organizationUsersRol =  OrganizationUser::where('rol_id' , $rol->_id)->get();

        if(isset($organizationUsersRol))
        {
            response()->json([
                "You can't do this action because there are still users with this role"
            ],409);
        }

        return (string) $rol->delete();
    }

    /**
     * 
     */
    public function crearPermisosRolEvent(Request $request)
    {
        $data = $request->json()->all();
        $rolAdmin = Rol::where('name' , 'Administrador')->first();
        
        $permission = new Permission($data);
        $permission->save();
        $permission->role_ids = [$rolAdmin->_id];
        $permission->save();


        $rolInPermission = $rolAdmin->permission_ids;
        array_push($rolInPermission , $permission->_id );
        $rolAdmin->permission_ids = $rolInPermission;
        $rolAdmin->save();
    }

    /**
     * 
     */
    public function assignPermisosRolEvent(Request $request)
    {
        $data = $request->json()->all();

        $permissions = Permission::where('name', 'like', '%'.$data['type_permission'].'%')->get();        
        $rol = Rol::where('name' , $data['rol_name'])->first();
        
        if(!isset($rol))
        {   
            $dataRolEvent = [
                'name' => $data['rol_name'],
                'guard_name' => 'web'
            ];
            $rol = new Rol($dataRolEvent);
            $rol->save();
        }        

        $rolInPermission = $rol->permission_ids;

        foreach($permissions as $permission)
        {  
            $permissonInRolEvent = $permission->role_ids;    
            
            if(array_search($rol->_id, $permissonInRolEvent) === false)
            {
                var_dump('Entrada');
                array_push($permissonInRolEvent , $rol->_id );
                $permission->role_ids = $permissonInRolEvent;
                $permission->save(); 
            }

            // $permission->save();

            if(array_search($permission->_id, $rol->permission_ids) === false)
            {   
                var_dump('Entrada1');
                array_push($rolInPermission , $permission->_id );
                $rol->permission_ids = $rolInPermission;
                $rol->save(); 
            }

              
        }           

        return $rol;
    }

    

}