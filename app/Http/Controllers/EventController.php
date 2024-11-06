<?php

namespace App\Http\Controllers;

use App\Account;
use App\evaLib\Services\EvaRol;
use App\evaLib\Services\EventService;
use App\evaLib\Services\FilterQuery;
use App\evaLib\Services\GoogleFiles;
use App\Event;
use App\Plan;
use App\EventType;
use App\Attendee;
use App\Http\Resources\EventResource;
use App\ModelHasRole;
use App\Organization;
use App\OrganizationUser;
use App\Position;
use App\Properties;
use App\UserProperties;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Validator;
use Mail;
use Log;
use App\evaLib\Services\OrganizationServices;

/**
 * @group Event
 *
 */

class EventController extends Controller
{
    
    /**
     *
     *  _index:_ Listing of all events
     *
     * This method allows dynamic querying of any property through the URL using FilterQuery services for example : Exmaple: [{"id":"event_type_id","value":["5bb21557af7ea71be746e98x","5bb21557af7ea71be746e98b"]}]
     * 
     * @queryParam filtered optional filter parameters Example: [{"field":"name","value":["Demo"]}]
     * 
     * @response{
     *   "_id": "61a687713bbf847b3f59d117",
     *   "name": "Demo",
     *   "address": null,
     *   "type_event": "onlineEvent",
     *   "datetime_from": "2021-11-30 15:18:00",
     *   "datetime_to": "2021-11-30 16:18:00",
     *   "picture": null,
     *   "venue": null,
     *   "location": null,
     *   "visibility": "PUBLIC",
     *   "description": null,
     *   "allow_register": true,
     *   "styles": {
     *    "buttonColor": "#FFF",
     *    "banner_color": "#FFF",
     *    "menu_color": "#FFF",
     *    "event_image": null,
     *    "banner_image": null,
     *    "menu_image": null,
     *    "banner_image_email": null,
     *    "footer_image_email": "",
     *    "brandPrimary": "#FFFFFF",
     *    "brandSuccess": "#FFFFFF",
     *    "brandInfo": "#FFFFFF",
     *    "brandDanger": "#FFFFFF",
     *    "containerBgColor": "#ffffff",
     *    "brandWarning": "#FFFFFF",
     *    "toolbarDefaultBg": "#FFFFFF",
     *    "brandDark": "#FFFFFF",
     *    "brandLight": "#FFFFFF",
     *    "textMenu": "#555352",
     *    "activeText": "#FFFFFF",
     *    "bgButtonsEvent": "#FFFFFF",
     *    "BackgroundImage": null,
     *    "FooterImage": null,
     *    "banner_footer": null,
     *    "mobile_banner": null,
     *    "banner_footer_email": null,
     *    "show_banner": "true",
     *    "show_card_banner": false,
     *    "show_inscription": false,
     *    "hideDatesAgenda": true,
     *    "hideDatesAgendaItem": false,
     *    "hideHoursAgenda": false,
     *    "hideBtnDetailAgenda": true,
     *    "loader_page": "no",
     *    "data_loader_page": null
     *   },
     *    "author_id": "61a685292e66fd61921378f2",
     *    "organizer_id": "61a687203bbf847b3f59d113",
     *    "event_type_id": "5bf47203754e2317e4300b68",
     *    "updated_at": "2021-11-30 20:20:03",
     *    "created_at": "2021-11-30 20:20:01",
     *    "user_properties": [
     *     {
     *      "name": "email",
     *      "label": "Correo",
     *      "unique": false,
     *      "mandatory": false,
     *      "type": "email",
     *      "updated_at": {
     *       "$date": {
     *        "$numberLong": "1638303602342"
     *       }
     *      }
     *     }
     *    ]
     * }
     */
    public function index(Request $request, FilterQuery $filterQuery)
    {
        $currentDate = new \Carbon\Carbon();

        $query = Event::with('positions')->where('visibility', '=', Event::VISIBILITY_PUBLIC) //Public
            ->whereNotNull('visibility') 
            ->orderBy('datetime_from', 'ASC');

        $input = $request->all();
        $results = $filterQuery::addDynamicQueryFiltersFromUrl($query, $input);
        return EventResource::collection($results);
    }

    /**
     * _beforeToday:_ list finished events
     * This method allows dynamic querying of any property through the URL using FilterQuery services for example : Exmaple: [{"id":"event_type_id","value":["5bb21557af7ea71be746e98x","5bb21557af7ea71be746e98b"]}]
     * @queryParam filtered optional filter parameters Example: [{"field":"name","value":["Demo"]}]
     * 
     */
    public function beforeToday(Request $request, FilterQuery $filterQuery)
    {
        $currentDate = new \Carbon\Carbon();

        $query = Event::with('positions')->where('visibility', '=', Event::VISIBILITY_PUBLIC) //Public
            ->whereNotNull('visibility') //not null
            ->Where('datetime_to', '<', $currentDate)
            ->orderBy('datetime_from', 'DESC');

        $input = $request->all();
        $results = $filterQuery::addDynamicQueryFiltersFromUrl($query, $input);
        return EventResource::collection($results);
    }

    /**
     * _afterToday:_ list upcoming events
     * This method allows dynamic querying of any property through the URL using FilterQuery services for example : Exmaple: [{"id":"event_type_id","value":["5bb21557af7ea71be746e98x","5bb21557af7ea71be746e98b"]}]
     * 
     * @queryParam filtered optional filter parameters Example: [{"field":"name","value":["Demo"]}]
     */
    public function afterToday(Request $request, FilterQuery $filterQuery)
    {
        $currentDate = new \Carbon\Carbon();
        //$currentDate = $currentDate->subWeek(2);

        $query = Event::with('positions')->where('visibility', '=', Event::VISIBILITY_PUBLIC) //Public
            ->whereNotNull('visibility') //not null
            ->Where('datetime_to', '>', $currentDate)
            ->orderBy('datetime_from', 'ASC');

        $input = $request->all();
        $results = $filterQuery::addDynamicQueryFiltersFromUrl($query, $input);
        return EventResource::collection($results);

    }
    
    /**
     * _currentUserindex_: list of events of the organizer who is logged in 
     * @authenticated
     */
    public function currentUserindex(Request $request)
    {
        $user = Auth::user();
        return EventResource::collection(
            Event::with('positions')->where('author_id', $user->id)
                ->paginate(config('app.page_size'))
        );
    }

    /**
     * _EventbyUsers_: search of events by user organizer.
     * 
     * @urlParam user required  organiser_id
     *
     */
    public function EventbyUsers(string $id)
    {
        return EventResource::collection(
            Event::with('positions')->where('organiser_id', $id)
                ->paginate(config('app.page_size'))
        );
    }
    /**
     * EventbyAuthor_: search of events by author.
     * 
     * @urlParam user required  author_id
     *
     */
    public function EventbyAuthor(string $id_author)
    {
        return EventResource::collection(
            Event::with('positions')->where('author_id', $id_author)
                ->paginate(config('app.page_size'))
        );
    }

    /**
     * _EventbyOrganizations_: search of events by user organizer.
     * 
     * @urlParam id required  organizer_id
     *
     * @param string $id
     * @return void
     */
    public function EventbyOrganizations(string $id)
    {
        return EventResource::collection(
            Event::setEagerLoads([])->with('positions')->where('organizer_id', $id)
                ->orderBy('datetime_from', 'ASC')
                ->paginate(config('app.page_size'))
        );
    }

    /**
     * _delete_: delete event.
     * 
     * @urlParam id required id del evento a eliminar.
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id)
    {
        $res = $id->delete();
        if ($res == true) {
            return 'True';
        } else {
            return 'Error';
        }
    }

    /**
     * _store_: Create new event of the organizer.
     * @authenticated 
     * 
     * @bodyParam name string required name to event Example: Demo 
     * @bodyParam adress string adress when is the event. Example: Avenida siempre viva
     * @bodyParam datetime_from datetime required date and time of start of the event Example: 2020-10-16 18:00:00
     * @bodyParam datetime_to datetime  date and time of the end of the event Example: 2020-10-16 21:00:00
     * @bodyParam type_event string required This parameter has two options: onlineEvent or PhysicalEvent, when onlineEvent the event emails will have the link to log in to the event page and physialEvent will send a QR code to enter the event at the physical point.     
     * @bodyParam picture string image of the event
     * @bodyParam venue string Event venue. Example: Venue B
     * @bodyParam location object This parameter specific all information of event location.
     * @bodyParam location.Latitude float Latitude coordinates Example: 4.668184
     * @bodyParam location.Longitude float Longitude coordinates Example: -74.051968
     * @bodyParam location.number string Number build Example: #123
     * @bodyParam location.street string Event street Example: Avenida siempre viva
     * @bodyParam location.city string Event city Example: Bogotá
     * @bodyParam location.state string Event state Example: Bogotá D.C
     * @bodyParam location.FormattedAddress string Epecific complete adress Example: Av. Siempre viva #123, Bogotá, Colombia     
     * @bodyParam visibility string required restricts access for registered users or any unregistered user Example: PUBLIC
     * @bodyParam user_properties array user registration properties.    
     * @bodyParam description string Explanation about  event. Example: Evento para mostrel funcionamiento de la plataforma.
     * @bodyParam event_type_id string required App\EventType This a event Example: 5bf47226754e2317e4300b6a
     * @bodyParam organizer_id string required Id Event's organization Example: 5e9caaa1d74d5c2f6a02a3c3
     * @bodyParam category_ids array App\Category
     * @bodyParam styles object required This is the event's appearance
     * @bodyParam styles.buttonColor string required Example: #FFF 
     * @bodyParam styles.banner_color string required Example: #FFF
     * @bodyParam styles.menu_color string required Example: #FFF 
     * @bodyParam styles.brandPrimary string required Example: #FFFFFF
     * @bodyParam styles.brandSuccess string required Example: #FFFFFF 
     * @bodyParam styles.brandInfo string required Example: #FFFFFF
     * @bodyParam styles.brandDanger string required Example: #FFFFFF 
     * @bodyParam styles.containerBgColor string required Example: #FFFFFF 
     * @bodyParam styles.brandWarning string required Example: #FFFFFF
     * @bodyParam styles.brandDark string required Example: #FFFFFF 
     * @bodyParam styles.brandLight string required Example: #FFFFFF 
     * @bodyParam styles.textMenu string required Example: #555352
     * @bodyParam styles.activeText string required Example: #FFFFFF
     * @bodyParam styles.bgButtonsEvent string required Example: #FFFFFF 
     *  
     */
    public function store(Request $request, GoogleFiles $gfService, EvaRol $RolService)
    {
        $user = Auth::user();
        $data = $request->except(['user_properties', 'token']);
        $dataUserProperties = $request->only('user_properties');
        
        //este validador pronto se va a su clase de validacion no pude ponerlo aún no se como se hace esta fue la manera altera que encontre
        $validator = Validator::make(
            $data,
            [
                'name' => 'required',
            ]
        );

        //Flow to validate the creation of a course depending on whether the creator is an administrator or a teacher
        $userRol = isset($user->others_properties['role']) ? $user->others_properties['role'] : null;
        if (isset($userRol) && ($userRol == 'admin' || $userRol == 'teacher')) {
            $data['status'] = ($userRol == 'admin') ? 'approved' : 'draft';
        }

        /* Validation plan free:
        If the user has Plan "Free" its not allowed to create more than 1 event.
            @response 400 {
                'message': 'User has no plan related'
            }
            @response 401 {
                'message': 'Error, events limit exceeded'
            }
         */
        /*
        if (isset($user->plan_id)) {
            $plan = Plan::findorFail($user->plan_id);
            if (strcmp($plan->name, "Free") == 0) {
                $Event_Author = $this->EventbyAuthor($user->_id);
                if (isset($Event_Author->collection[0])) {
                    return response()->json(['message'=> 'Error events limit exceeded'], 401);
                };
            };
        }
        */
        if ($validator->fails()) {
            return response(
                $validator->errors(),
                422
            );
        };

        $data['organizer_type'] = "App\user";
        //$userProperties = $data['user_properties'];
        // $userProperties->save();

        $Properties = new UserProperties();

	// Days after the live landing event
	//if(isset($user->plan['availables']['later_days'])) {
	  //$data[ 'later_days' ] = $user->plan['availables']['later_days'];
	//}

        $result = new Event($data);

        if ($request->file('picture')) {
            $result->picture = $gfService->storeFile($request->file('picture'));
        }

        try {
            $result->author()->associate($user);
        } catch (Exception $e) {
            echo 'autor no se pudo asociar al evento, contacte el administrador, error: ', $e->getMessage(), "\n";
        }


        /* Organizer:
        It could be "me"(current user) or a organization Id
        the relationship is polymorpic.
         */
        EventService::assingOrganizer($data, $result);

        /*Events Type*/

        if (isset($data['event_type_id'])) {
            $event_type = EventType::find($data['event_type_id']);
            if ($event_type) {
                $result->eventType()->associate($event_type);
                if (!is_string($result->author_id)) {
                    $result->author_id = [];
                }
            }
        }
        $styles = $data['styles'];
        EventService::AddDefaultStyles($styles,$result);
        
        //Persist the model to database
        $result->save();
        
        /*categories*/
        if (isset($data['category_ids'])) {
            $result->categories()->sync($data['category_ids']);
        }

        if (isset($dataUserProperties)) {
            $event = Event::find($result->_id);
            for ($i = 0; $i < count($dataUserProperties['user_properties']); $i++) {

                $model = new UserProperties($dataUserProperties['user_properties'][$i]);
                $event->user_properties()->save($model);
            }
        }
        
        //Configuracione spor defecto de todos los eventos
        // EventService::addEventMenu($result);
        EventService::addOwnerAsAdminColaborator($user, $result);
        EventService::createDefaultUserProperties($result->id);


        return $result;
    }


        

    /**
     * _show_: display information about a specific event.
     * 
     * @authenticated
     * @urlParam event required id of the event you want to consult. Example: 61a687713bbf847b3f59d117
     * @response{
     *   "_id": "61a687713bbf847b3f59d117",
     *   "name": "Demo",
     *   "address": null,
     *   "type_event": "onlineEvent",
     *   "datetime_from": "2021-11-30 15:18:00",
     *   "datetime_to": "2021-11-30 16:18:00",
     *   "picture": null,
     *   "venue": null,
     *   "location": null,
     *   "visibility": "PUBLIC",
     *   "description": null,
     *   "allow_register": true,
     *   "styles": {
     *    "buttonColor": "#FFF",
     *    "banner_color": "#FFF",
     *    "menu_color": "#FFF",
     *    "event_image": null,
     *    "banner_image": null,
     *    "menu_image": null,
     *    "banner_image_email": null,
     *    "footer_image_email": "",
     *    "brandPrimary": "#FFFFFF",
     *    "brandSuccess": "#FFFFFF",
     *    "brandInfo": "#FFFFFF",
     *    "brandDanger": "#FFFFFF",
     *    "containerBgColor": "#ffffff",
     *    "brandWarning": "#FFFFFF",
     *    "toolbarDefaultBg": "#FFFFFF",
     *    "brandDark": "#FFFFFF",
     *    "brandLight": "#FFFFFF",
     *    "textMenu": "#555352",
     *    "activeText": "#FFFFFF",
     *    "bgButtonsEvent": "#FFFFFF",
     *    "BackgroundImage": null,
     *    "FooterImage": null,
     *    "banner_footer": null,
     *    "mobile_banner": null,
     *    "banner_footer_email": null,
     *    "show_banner": "true",
     *    "show_card_banner": false,
     *    "show_inscription": false,
     *    "hideDatesAgenda": true,
     *    "hideDatesAgendaItem": false,
     *    "hideHoursAgenda": false,
     *    "hideBtnDetailAgenda": true,
     *    "loader_page": "no",
     *    "data_loader_page": null
     *   },
     *    "author_id": "61a685292e66fd61921378f2",
     *    "organizer_id": "61a687203bbf847b3f59d113",
     *    "event_type_id": "5bf47203754e2317e4300b68",
     *    "updated_at": "2021-11-30 20:20:03",
     *    "created_at": "2021-11-30 20:20:01",
     *    "user_properties": [
     *     {
     *      "name": "email",
     *      "label": "Correo",
     *      "unique": false,
     *      "mandatory": false,
     *      "type": "email",
     *      "updated_at": {
     *       "$date": {
     *        "$numberLong": "1638303602342"
     *       }
     *      }
     *     }
     *    ]
     * }
     */
    public static function show(String $id)
    {
        $event = Event::with('positions')->findOrFail($id);
        return $event;
    }

    /**
     * _test_:simply testing service providers
     *
     * @param GoogleFiles $gfService
     * @return void
     */
    public function test(GoogleFiles $gfService)
    {
        echo $gfService->doSomethingUseful();
    }
    /**
     * _update_: update information on a specific event.
     * 
     * @authenticated
     * @urlParam event required id of the event to be updated
     * 
     * @bodyParam name string required name to event Example: Demo 
     * @bodyParam adress string adress when is the event. Example: Avenida siempre viva
     * @bodyParam datetime_from datetime required date and time of start of the event Example: 2020-10-16 18:00:00
     * @bodyParam datetime_to datetime  date and time of the end of the event Example: 2020-10-16 21:00:00
     * @bodyParam type_event string required This parameter has two options: onlineEvent or PhysicalEvent, when onlineEvent the event emails will have the link to log in to the event page and physialEvent will send a QR code to enter the event at the physical point.     
     * @bodyParam picture string image of the event
     * @bodyParam venue string Event venue. Example: Venue B
     * @bodyParam location object This parameter specific all information of event location.
     * @bodyParam visibility string required restricts access for registered users or any unregistered user Example: PUBLIC
     * @bodyParam user_properties array user registration properties.    
     * @bodyParam description string Explanation about  event. Example: Evento para mostrel funcionamiento de la plataforma.
     * @bodyParam event_type_id string required App\EventType This a event Example: 5bf47226754e2317e4300b6a
     * @bodyParam organizer_id string required Id Event's organization Example: 5e9caaa1d74d5c2f6a02a3c3
     * @bodyParam category_ids array App\Category
     * @bodyParam styles object required This is the event's appearance
     * 
     */
    public function update(Request $request, string $id, GoogleFiles $gfService)
    {
        $user = Auth::user();
        $data = $request->json()->all();
        $event = Event::findOrFail($id);

        /* Organizer:
        It could be "me"(current user) or an organization Id
        the relationship is polymorpic.
         */

        if (empty($data['itemsMenu']) && !empty($event->itemsMenu)) {
            $data['itemsMenu'] = $event->itemsMenu;
        }

        if (!empty($data['styles'])) {
            $data['styles'] = EventService::AddAppConfiguration($data['styles']);
        }

        if (!isset($data['app_configuration']) && !empty($event->app_configuration)) {
            $data['app_configuration'] = $event->app_configuration;
        }

        /*Events Type*/
        if (isset($data['event_type_id'])) {
            $event_type = EventType::findOrFail($data['event_type_id']);
            $event->eventType()->associate($event_type);
        }

        /*categories*/
        if (isset($data['category_ids'])) {
            $event->categories()->sync($data['category_ids']);
        }

        if (isset($data['position_ids'])) {
            $event->positions()->sync($data['position_ids']);
        }

        //si el evento se actualiza y no se envia el organizer_id suponemos que se conserva el mismo organizador
        if (!isset($data["organizer_id"]) && !empty($event->organizer_id)) {
            $data["organizer_id"] = $event->organizer_id;
        } elseif (empty($event->organizer_id) || !empty($event->organizer_id) && !empty($data['organizer_id'])) {
            EventService::assingOrganizer($data, $event);
        }

        //Convertir el id de string a ObjectId al hacer cambio con drag and drop
        if (isset($data["user_properties"])) {
            foreach ($data['user_properties'] as $key => $value) {
                $data['user_properties'][$key]['_id']  = new \MongoDB\BSON\ObjectId();
            }
        }


        $event->fill($data);
        $event->save();

        return new EventResource($event);
    }

    public function updatePositions(Request $request, string $event_id)
    {
        $validatedData = $request->validate([
            'position_ids' => 'array',
            'position_ids.*' => 'string',
        ]);
        $data = $request->json()->all();
        Log::debug(">>> " . serialize($data));
        $position_ids = $data['position_ids'];
        Log::debug("will set positions " . serialize($position_ids) . " to event " . $event_id);

        $event = Event::with('positions')->findOrFail($event_id);

        $event->positions()->sync($position_ids);
        Log::debug("position ids updated");

        // Update organization user for this position
        foreach ($position_ids as $position_id) {
            $organization_users = OrganizationUser::where('organization_id', $event['organizer_id'])->get();
            Log::debug("found " . count($organization_users) . " organization_users");
            foreach ($organization_users as $organization_user) {
                Log::debug("register to position the user: ".$organization_user['account_id']);
                OrganizationServices::createMembers($organization_user);
                // $attendee = Attendee::where('account_id', $organization_user['account_id'])
                //     ->where('event_id', $event['_id']);
                // if (!$attendee) {
                //     // Then create it
                //     $attendee = Attendee::updateOrCreate(
                //         [
                //             "account_id" => $organization_user['account_id'],
                //             "event_id" => $event["_id"],  // I added this because each event has its owned attendee, right?
                //         ],
                //         [
                //             "properties" => $organization_user->properties,
                //             "rol_id" => $organization_user->rol_id,
                //             "event_id" => $event["_id"]
                //         ]
                //     );
                //     Log::debug('Users added to this new event: '.$attendee);
                // }
            }
        }

        return response()->json($event);
    }

    
    /**
     * _destroy_: delete event and related data.
     * @authenticated
     * @urlParam event required id of the event to be eliminated
     * 
     */
    public function destroy(String $id)
    {
	// borrar evento
	Event::findOrFail($id)->delete();

	// borrar documentos que posean referencia al evento
	$models = ["App\Attendee", "App\Activities", "App\Host", "App\Space", "App\Message", "App\ModelHasRole", "App\Order"];
	foreach ($models as $model) {
	  $model::where('event_id', $id)->delete();
	}

	return response()->json([], 204);
    }

    /**
     * _restore_: restore event and related data.
     * @authenticated
     * @urlParam event required id of the event to be restore
     * 
     */
    public function restore(String $event_id)
    {
	Event::withTrashed()->findOrFail($event_id)->restore();

	// restaurar documentos que posean referencia al evento
	$models = ["App\Attendee", "App\Activities", "App\Host", "App\Space", "App\Message", "App\ModelHasRole", "App\Order"];
	foreach ($models as $model) {
	  $model::withTrashed()->where('event_id', $event_id)->restore();
	}

	return response()->json(['msg' => 'restored'], 200);
    }

    public function showUserProperties(String $id)
    {
        $Event = Event::findOrFail($id);
        return (string) $Event->delete();
    }

    /**
     * _addUserProperty_: adding dynamic user property to the event
     * 
     *
     * Once the properties of the dynamic user events have been created, they can be obtained directly from $evento->propiedades from user.
     * The dynamic properties are returned within each UserEvent as the normal properties.
     * 
     * @urlParam id required id del evento
     * 
     * @bodyParam name string required field name in database 
     * @bodyParam label string required 
     * @bodyParam mandatory boolean required indicates if the field is mandatory or optional
     * @bodyPram type string required indicates the data type of the field 
     * @bodyParam visibleByAdmin boolean required
     * @bodyParam visibleByContacts boolean required
     * @bodyParm order_weight string order of the fields in the form
     * @bodyParam description string 
     * 
     * @param Event $event
     * @param array $properties
     * @return void
     */
    public function addUserProperty(Request $request, $event_id)
    {

        $event = Event::find($event_id);
        $event_properties = $event->user_properties;
        $count = count($event_properties);
        $fields = [$count => ["name" => $request->name, "unique" => false, "mandatory" => false, "type" => "text"]];
        $event->user_properties += $fields;
        $event->save();
        return $event->user_properties;
    }

    /**
     * _showCreateEvent_ : show the 'Create Event' Modal
     * 
     * @bodyParam modal_id strng required
     * @bodyParam organiser_id strng required
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showCreateEvent(Request $request)
    {
        $data = [
            'modal_id' => $request->get('modal_id'),
            'organisers' => Organization::scope()->pluck('name', 'id'),
            'organiser_id' => $request->get('organiser_id') ? $request->get('organiser_id') : false,
        ];

        return view('ManageOrganiser.Modals.CreateEvent', $data);
    }

    /**
     * _postCreateEvent_: Create a new event.
     *
     * @bodyParam name string name to event Example: "Programming course" 
     * @bodyParam datetime_from datetime date and time of start of the event Example: 2020-10-16 18:00:00
     * @bodyParam datetime_to datetime date and time of the end of the event Example: 2020-10-16 21:00:00
     * @bodyParam picture string image of the event
     * @bodyParam visibility string restricts access for registered users or any unregistered user Example: PUBLIC
     * @bodyParam user_properties array user registration properties
     * @bodyParam author_id string Example: 5e9caaa1d74d5c2f6a02a3c3
     * @bodyParam event_type_id string Example: 5bf47226754e2317e4300b6a  
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateEvent(Request $request)
    {
        $event = Event::createNew();

        if (!$event->validate($request->all())) {
            return response()->json([
                'status' => 'error',
                'messages' => $event->errors(),
            ]);
        }

        $event->title = $request->get('title');
        $event->description = strip_tags($request->get('description'));
        $event->start_date = $request->get('start_date');

        /*
         * Venue location info (Usually auto-filled from google maps)
         */

        $is_auto_address = (trim($request->get('place_id')) !== '');

        if ($is_auto_address) { /* Google auto filled */
            $event->venue_name = $request->get('name');
            $event->venue_name_full = $request->get('venue_name_full');
            $event->location_lat = $request->get('lat');
            $event->location_long = $request->get('lng');
            $event->location_address = $request->get('formatted_address');
            $event->location_country = $request->get('country');
            $event->location_country_code = $request->get('country_short');
            $event->location_state = $request->get('administrative_area_level_1');
            $event->location_address_line_1 = $request->get('route');
            $event->location_address_line_2 = $request->get('locality');
            $event->location_post_code = $request->get('postal_code');
            $event->location_street_number = $request->get('street_number');
            $event->location_google_place_id = $request->get('place_id');
            $event->location_is_manual = 0;
        } else { /* Manually entered */
            $event->venue_name = $request->get('location_venue_name');
            $event->location_address_line_1 = $request->get('location_address_line_1');
            $event->location_address_line_2 = $request->get('location_address_line_2');
            $event->location_state = $request->get('location_state');
            $event->location_post_code = $request->get('location_post_code');
            $event->location_is_manual = 1;
        }

        $event->end_date = $request->get('end_date');

        $event->currency_id = Auth::user()->currency_id;
        //$event->timezone_id = Auth::user()->timezone_id;
        /*
         * Set a default background for the event
         */
        $event->bg_type = 'image';
        $event->bg_image_path = config('attendize.event_default_bg_image');

        if ($request->get('organiser_name')) {
            $organiser = Organization::createNew(false, false, true);

            $rules = [
                'organiser_name' => ['required'],
                'organiser_email' => ['required', 'email'],
            ];
            $messages = [
                'organiser_name.required' => trans("Controllers.no_organiser_name_error"),
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $validator->messages()->toArray(),
                ]);
            }

            $organiser->name = $request->get('organiser_name');
            $organiser->about = $request->get('organiser_about');
            $organiser->email = $request->get('organiser_email');
            $organiser->facebook = $request->get('organiser_facebook');
            $organiser->twitter = $request->get('organiser_twitter');
            $organiser->save();
            $event->organiser_id = $organiser->id;
        } elseif ($request->get('organiser_id')) {
            $event->organiser_id = $request->get('organiser_id');
        } else { /* Somethings gone horribly wrong */
            return response()->json([
                'status' => 'error',
                'messages' => trans("Controllers.organiser_other_error"),
            ]);
        }

        /*
         * Set the event defaults.
         * @todo these could do mass assigned
         */
        //$defaults = $event->organiser->event_defaults;
        if (isset($defaults)) {
            $event->organiser_fee_fixed = $defaults->organiser_fee_fixed;
            $event->organiser_fee_percentage = $defaults->organiser_fee_percentage;
            $event->pre_order_display_message = $defaults->pre_order_display_message;
            $event->post_order_display_message = $defaults->post_order_display_message;
            $event->offline_payment_instructions = $defaults->offline_payment_instructions;
            $event->enable_offline_payments = $defaults->enable_offline_payments;
            $event->social_show_facebook = $defaults->social_show_facebook;
            $event->social_show_linkedin = $defaults->social_show_linkedin;
            $event->social_show_twitter = $defaults->social_show_twitter;
            $event->social_show_email = $defaults->social_show_email;
            $event->social_show_googleplus = $defaults->social_show_googleplus;
            $event->social_show_whatsapp = $defaults->social_show_whatsapp;
            $event->is_1d_barcode_enabled = $defaults->is_1d_barcode_enabled;
            $event->ticket_border_color = $defaults->ticket_border_color;
            $event->ticket_bg_color = $defaults->ticket_bg_color;
            $event->ticket_text_color = $defaults->ticket_text_color;
            $event->ticket_sub_text_color = $defaults->ticket_sub_text_color;
        }

        try {
            $event->save();
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json([
                'status' => 'error',
                'messages' => trans("Controllers.event_create_exception"),
            ]);
        }

        /*
        if ($request->hasFile('event_image')) {
        $path = public_path() . '/' . config('attendize.event_images_path');
        $filename = 'event_image-' . md5(time() . $event->id) . '.' . strtolower($request->file('event_image')->getClientOriginalExtension());

        $file_full_path = $path . '/' . $filename;

        $request->file('event_image')->move($path, $filename);

        $img = Image::make($file_full_path);

        $img->resize(800, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
        });

        $img->save($file_full_path);

        // Upload to s3
        \Storage::put(config('attendize.event_images_path') . '/' . $filename, file_get_contents($file_full_path));

        $eventImage = EventImage::createNew();
        $eventImage->image_path = config('attendize.event_images_path') . '/' . $filename;
        $eventImage->event_id = $event->id;
        $eventImage->save();

        }*/

        return response()->json([
            'status' => 'success',
            'id' => $event->id,
            'redirectUrl' => route('showEventTickets', [
                'event_id' => $event->id,
                'first_run' => 'yup',
            ]),
        ]);
    }

    // FUNCTIONS SPECIFICS

    /**
     * _stagesStatusActive_: put the state of the stage depends on the day
     * 
     * @urlParam id required event_Id
     * @param $id  event Id
     * @return  $stages
     *
     */
    public function stagesStatusActive($id)
    {

        //"start_sale_date": "2019-02-24 18:00",
        //"end_sale_date": "2019-05-16 05:59",

        //2019-04-11
        $date = new \DateTime();
        $event = Event::findOrFail($id);
        $now = $date->format('Y-m-d H:i:s');
        $stages = $event->event_stages;
        $codes_discounts = $event->codes_discount;

        if (isset($stages)) {
            if (!isset($event->is_experience)) {
                foreach ($stages as $key => $stage) {
                    if ($stage["end_sale_date"] < $now) {
                        $status = "ended";
                    } else if ($stage["start_sale_date"] > $now) {
                        $status = "notstarted";
                    } else {
                        $status = "active";
                    }

                    $stages[$key] += ['status' => $status];
                }
            } else {
                foreach ($stages as $key => $stage) {
                    $status = "active";
                    $stages[$key] += ['status' => $status];
                }
            }
        }
        return $stages;
    }


    /**
     * _changeStatusEvent_: approve or reject the events **'draft'**, and send mail of the change of status of the event to the user who created it
     * 
     * @authenticated
     * @urlParam event_id required id of the event to be rejected or approved Example: 
     * @bodyParam status string required the status update allows for two possible statuses **approved** or **rejected** Example: approved
     * 
     * @response {
     *  "_id": "5fb2eef214b93f11165dd1a0",
     *  "category": "d35319efaf194af191b8dc7c149a01bc",
     *  "datetime_from": null,
     *  "datetime_to": null,
     *  "description": "dddd",
     *  "name": "curso 1",
     *  "picture": "https://picsum.photos/400/800",
     *  "visibility": "PUBLIC",
     *  "extra_config": {
     *      "price": "0"
     *  },
     *  "author_id": "5fb1f6fb7bf68702e345b5d2",
     *  "organizer_id": "5f7e33ba3abc2119442e83e8",
     *  "event_type_id": "5bf47203754e2317e4300b68",
     *  "status" : "approved",
     *  "updated_at": "2021-01-20 21:07:50",
     *  "created_at": "2020-11-16 21:28:18"
     * }
     * 
     * @response  403 {
     *  "Error": "The user does not have the permissions to execute this action"
     * }
     * 
     */
    public function changeStatusEvent(Request $request, $event_id)
    {
        $data = $request->json()->all();

        //Get authenticated user
        $user = Auth::user();
        $userRol =  isset($user) ? $user->others_properties['role'] :  null;

        //Validate that the authenticated user is an administrator
        if (isset($userRol) && $userRol == 'admin') {

            $event = Event::find($event_id);
            $event->status = $data['status'];
            $event->save();

            //Organization in which the event has been created
            $organization = Organization::find($event->organizer_id);
            $organization = Account::find($organization->author);

            //User who created the Event
            $author = Account::find($event->author_id);

            //Mail that informs the creator of the event, about the update of the status of the event
            Mail::to($author->email)
                ->queue(
                    new \App\Mail\ConfirmationCourseEmail($event, $author, $organization)
                );

            return $event;
        }

        return response()->json([
            'Error' => 'The user does not have the permissions to execute this action'
        ], 403);
    }

    /**
     * _addDocumentUserToEvent_: adds the default settings to events that have user documents.
     * @authenticated
     * 
     * @urlParam event required event id
     * @bodyParam quantity number required Indicates how many documents will assigned to a user.
     * @bodyParam auto_assign boolean required This parameter indicates if the document are assigned to the user automatically or if the user selects them when registering. 
     * @response {
     *  all data event...,
     *  "extra_config": {
     *      "document_user": {
     *          "quantity": 2,
     *          "auto_assign": true
     *      }
     *  }
     * }
     */
    public function addDocumentUserToEvent(Request $request, $event_id)
    {      
        $data = $request->json()->all();

        $request->validate([
            'quantity' => 'required|integer',
            'auto_assign' => 'required|boolean'
        ]);

        $event = Event::findOrFail($event_id);
        $documetUser = ["document_user" => $data];
        $event->extra_config = $documetUser;
        $event->save();

        return $event;
    }
}


