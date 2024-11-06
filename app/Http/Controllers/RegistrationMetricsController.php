<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationMetrics;
use App\evaLib\Services\FilterQuery;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @group RegistrationMetrics
 * 
 * The categories are a facility for classification of events
 */
class RegistrationMetricsController extends Controller
{

    /**
     * _index_: List of registration metrics of event specific
     * Format filters dinamic: **filtered=[{"field":"date","value":["2021-01-01"]}]**
     * 
     * @authenticated
     * 
     * @urlParam event_id required 
     *       
     * @queryParam filtered optional filter parameters Example: [{"field":"date","value":["2021-01-01"]}]
     * 
     * @response {
     *    "data": [
     *        {
     *            "_id": "609167e40a57106dc62abf42",
     *            "quantity": 2,
     *            "event_id": "60254f049619c7059a0fc03a",
     *            "date": "2021-05-04",
     *            "updated_at": "2021-05-04 15:28:04",
     *            "created_at": "2021-05-04 15:27:32"
     *        }
     *    ],
     *    "links": {
     *        "first": "https://api.evius.co/api/events/60254f049619c7059a0fc03a/registrationmetrics?page=1",
     *        "last": "https://api.evius.co/api/events/60254f049619c7059a0fc03a/registrationmetrics?page=1",
     *        "prev": null,
     *        "next": null
     *    },
     *    "meta": {
     *        "current_page": 1,
     *        "from": 1,
     *        "last_page": 1,
     *        "path": "https://api.evius.co/api/events/60254f049619c7059a0fc03a/registrationmetrics",
     *        "per_page": 2500,
     *        "to": 1,
     *        "total": 1
     *    }
     *}
     *
     */
    public function index(Request $request,$event_id, FilterQuery $filterQuery)
    {   
        
        $input = $request->all();
        $query  = RegistrationMetrics::where("event_id", $event_id);
              
        $results = $filterQuery::addDynamicQueryFiltersFromUrl($query, $input);
        return JsonResource::collection($results);

    }

    /**
     * _store_: create new metrics
     * 
     * @authenticated
     * 
     * @urlParam event_id required 
     * 
     * @bodyParam quantity  number required Example: 1 
     * @bodyParam date      string required Example: 2021-01-01
     * 
     * @response {
     *       "_id": "609167e40a57106dc62abf42",
     *       "quantity": 2,
     *       "event_id": "60254f049619c7059a0fc03a",
     *       "date": "2021-05-04",
     *       "updated_at": "2021-05-04 15:28:04",
     *       "created_at": "2021-05-04 15:27:32"
     * }
     * 
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $result = new RegistrationMetrics($data);
        $result->save();

        return $result;

    }

    /**
     * _show_: consult information on a specific registration metrics
     * 
     * @authenticated
     * 
     * @urlParam id registration metrics id required Example: 609167e40a57106dc62abf42
     * 
     * @response {
     *       "_id": "609167e40a57106dc62abf42",
     *       "quantity": 2,
     *       "event_id": "60254f049619c7059a0fc03a",
     *       "date": "2021-05-04",
     *       "updated_at": "2021-05-04 15:28:04",
     *       "created_at": "2021-05-04 15:27:32"
     * }
     * 
     */
    public function show(String $id)
    {
        $metrics = RegistrationMetrics::find($id);        
        return $response;
    }
    /**
     * _update_: update registration metrics
     * 
     * @authenticated
     * 
     * @urlParam id registration metrics id required Example: 609167e40a57106dc62abf42
     * 
     * @bodyParam quantity  number  Example: 1 
     * @bodyParam date      string  Example: 2021-01-01
     * 
     * @response {
     *       "_id": "609167e40a57106dc62abf42",
     *       "quantity": 2,
     *       "event_id": "60254f049619c7059a0fc03a",
     *       "date": "2021-05-04",
     *       "updated_at": "2021-05-04 15:28:04",
     *       "created_at": "2021-05-04 15:27:32"
     * }
     * 
     */
    public function update(Request $request, string $id)
    {
        $data = $request->json()->all();
        $metrics = RegistrationMetrics::find($id);
        $metrics->fill($data);
        $metrics->save();
        // ResponseCache::clear();
        return $data;
    }

    /**
     * _destroy_: Remove the specified resource from storage.
     * 
     * @authenticated
     * 
     * @urlParam id registration metrics id required Example: 609167e40a57106dc62abf42
     * 
     */
    public function destroy($id)
    {   
        $metrics = RegistrationMetrics::findOrFail($id);
        return  (string) $metrics->delete();

    }

    /**
     * _createByDay_ : create metrics 
     * 
     */
    public function createByDay($date, $event_id)
    {           
        $metrics = RegistrationMetrics::where("date" , $date)->first();
        if(isset($metrics))
        {   
            $metrics->quantity = $metrics->quantity + 1;
            $metrics->save();
        }else{
            $data['quantity'] = 1;
            $data['event_id'] = $event_id;
            $data['date'] = $date;
            $metrics = new RegistrationMetrics($data);
            $metrics->save();
            
        }
        return $metrics;
    }
}