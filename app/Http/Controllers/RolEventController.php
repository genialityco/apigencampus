<?php

namespace App\Http\Controllers;

use App\Rol;
use App\Event;
use Illuminate\Http\Request;
use App\Permission;
use \App\Attendee;
use \App\RolesPermissions;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;
use Validator;
use App\evaLib\Services\FilterQuery;

/**
 * @group Rol Events
 * 
 * These enpoints help you to manage the roles of attendes 
 * and aministrators in a event.
 * 
 * You can create all roles that yo want. 
 * 
 * For view and manage this endpoints you have to be administrator in the event.
 */
class RolEventController extends Controller
{   
    const AVALIABLE_TYPES = ['attendee', 'admin'];
    const AVALIABLE_PERMISSIONS = 'list, show, update, create, destroy';

    /**
     * _index_: list roles by event.
     * 
     * In this list you can see the two roles default of the system: Attendee and Administrator. 
     * Also you can see all roles created for you in you event.
     * When you create an event, you are assigned the Administrator role.
     * 
     * @authenticated
     * 
     * @urlParam event required The ID of the event
     * @queryParam filtered optional filter parameters Example: [{"field":"type","value":"attendee"}] 
     * 
     * @response [
     * 	{
     * 		"_id": "60e8a7e74f9fb74ccd00dc22",
     * 		"name": "Attendee",
     * 		"guard_name": "web",
     * 		"updated_at": "2021-08-06 19:04:06",
     * 		"created_at": "2021-07-09 19:47:51",
     * 		"type": "attendee",
     * 		"module": "system"
     * 	},
     * 	{
     * 		"_id": "5c1a59b2f33bd40bb67f2322",
     * 		"name": "Administrator",
     * 		"guard_name": "web",
     * 		"updated_at": "2021-07-02 20:58:53",
     * 		"created_at": "2018-12-19 14:46:10",
     * 		"type": "admin",
     * 		"module": "system"
     * 	}
     * ]
     */
    public function index($event_id , Request $request, FilterQuery $filterQuery)
    {   
        $input = $request->all();
        $rolEvent = Rol::where('event_id' , $event_id);

        // This query return the default roles in the systme, this roles are going to in every events.
        $query = Rol::where('module' , Rol::MODULE_SYSTEM)->get();

        $results = $filterQuery::addDynamicQueryFiltersFromUrl($rolEvent, $input);
        $roles = $results->concat($query);

        return JsonResource::collection($roles);
    }

    
    /**
     * _store_: create a new rol
     * @authenticated
     * 
     * @urlParam event required The ID of the event
     * 
     * @bodyParam name string required unique Rol name, the name of the role have to be unique, you can't create two or more roles with the same name. Example: RolName
     * @bodyParam type string required The type can be attendee or admin. The user with role type attendee can have access to event’s landing and can consult only the functions get, thist ype of rol doesn’t  access to CMS. Example: attendee  
     * 
     */
    public function store(Request $request, $event_id)
    {   
        //
        $data = $request->json()->all(); 
        $rules = [
            'name' => 'required|unique:roles,name,NULL,id,modeltable_id,' . $event_id,
            'type' => ["required", Rule::in(RolEventController::AVALIABLE_TYPES)]
        ];
        //Standardize role names
        $data['name'] =  ucfirst(strtolower($data['name']));   

        $messages = [
            'in' => "Type should be one of: " . implode(", ", RolEventController::AVALIABLE_TYPES),           
        ];
        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->passes()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }
   
        $event = Event::find($event_id);
        

        $result = $event->rols()->create($data);
            
        // $result->save();
        return $result;
    }

    /**
     * _show_: information from a specific role 
     * @authenticated
     * 
     * @urlParam event required The ID of the event
     * @urlParam rolevent required rol id
     */
    public function show($event_id , $id)
    {   
        $rol = Rol::findOrFail($id);
        return $rol;
    }

    /**
     * _show_: information from a specific role 
     * @authenticated
     */
    public function showRolPublic(Rol $id)
    {
        //
        return $id;
    }


    /**
     * _update_: update the specified rol in the event.
     * @authenticated
     * 
     * @urlParam event required The ID of the event
     * @urlParam rolevent required rol id
     * 
     * @bodyParam name string Rol name
     * @bodyParam type string The type can be attendee or admin 
     * 
     */
    public function update(Request $request, $event_id, $rol_id)
    {
        //
        $data = $request->json()->all(); 
        $rules = [
            'name' => 'unique:roles,name,NULL,id,modeltable_id,' . $event_id,
            'type' => [Rule::in(RolEventController::AVALIABLE_TYPES)]
        ];
        //Standardize role names
        $data['name'] =  ucfirst(strtolower($data['name']));   

        $messages = [
            'in' => "Type should be one of: " . implode(", ", RolEventController::AVALIABLE_TYPES),           
        ];
        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->passes()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }
        
        $rol = Rol::find($rol_id);
        $rol->fill($data);
        $rol->save();
        return $rol;
    }
    
    /**
     * _destroy_: if the roll is not used for none user you can remove them.
     * 
     * @urlParam event required The ID of the event
     * @urlParam rolevent required rol id
     */
    public function destroy($event_id, $rol_id)
    {
        $eventUser = Attendee::where('rol_id' , $rol_id)->where('event_id' , $event_id)->first();
        
        if(!isset($eventUser)){            
            RolesPermissions::where("rol_id", $rol_id)->delete();
            $rol = Rol::find($rol_id);
            return (string )$rol->delete();
        }else{
            return response()->json([
                "message" => "You can't delete this role because there are users using it"
            ], 403);
        }
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
            $rol = new RolEvent($dataRolEvent);
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