<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// models
use App\Bingo;
use App\BingoCard;
use App\Event;
use App\Http\Resources\BingoResource;
use App\evaLib\Services\UserEventService;

/**
 * @group Bingo
 *
 */

class BingoController extends Controller
{
    /**
     * _index_: It returns all the bingos in the database
     * It creates a new Bingo object and saves it to the database
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * 
     * @bodyParam name string required The name of the bingo.
     * @bodyParam dimensions.format string required The format of the bingo. Example: 3x3, 4x4, 5x5
     * @bodyParam dimensions.amount int required The amount of cells in the bingo. Example: 9, 16, 25
     * @bodyParam dimensions.minimun_values int required The minimun amount of values in the bingo. Example: 5, 7, 9
     * 
     * @return A JSON object with the bingo created.
     */
    public function store(Request $request, Event $event)
    {
      $request->validate([
	      'name' => 'required|string|max:250',
	      'dimensions.format' => 'required|string|in:3x3,4x4,5x5',
	      'dimensions.amount' => 'required|numeric|in:9,16,25',
	      'dimensions.minimun_values' => 'required|numeric',
      ]);

      $data = $request->json()->all();
      $data[ 'event_id' ] = $event->_id;
      $bingo = Bingo::create($data);

      //Nuevo atributo para el bingo creado. $event->dynamics.
      if(isset($event->dynamics)){
          $dynamics = $event->dynamics;
          $dynamics["bingo"] = true;
      }else{
          $dynamics["bingo"] = true;
      }
      $event->dynamics = $dynamics;

      // estado para determinar si el evento cuenta con bingo creado
      $event->bingo = true;
      $event->save();

      return response()->json($bingo, 201);
    }

    /**
     * BingobyEvent_: search of Bingo by event.
     *
     * @urlParam event required  event_id
     *
     */

    public function BingobyEvent(string $event_id)
    {
      $bingo =  Bingo::where('event_id', $event_id)->first();
      return $bingo;
    }

    /**
     * _update_: It takes a request, validates it, and then updates it to the database
     * It takes a request, an event, and a bingo, and updates the bingo with the data from the request
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * @urlParam bingo_id required The id of the bingo to update.
     * 
     * @bodyParam name string required The name of the bingo.
     * @bodyParam event_id string required The id of the event to add the bingo to.
     * @bodyParam bingo_appearance string required The appearance of the bingo.
     * @bodyParam amount_of_bingo int required The amount of bingos.
     * @bodyParam regulation string required The regulation of the bingo.
     * @bodyParam bingo_values array required The values of the bingo.
     * @bodyParam random_bingo_values array required The random values of the bingo.
     * @bodyParam dimensions array required The dimensions of the bingo.
     * 
     * @return The updated bingo object.
     */
    public function update(Request $request, $event, Bingo $bingo)
    {
	    $data = $request->json()->all();
      $bingo->fill($data);
      $bingo->save();

      if ($request->query('reset_bingo') === "yes") {
          UserEventService::resetBingoCardsForAttendees($bingo);
      }

      return response()->json($bingo);
    }

    /**
     * _destroy_: It takes a bingo and deletes it from the database
     * It deletes a bingo and all its cards
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * @urlParam bingo_id required The id of the bingo to delete.
     * 
     * @return 204 No Content
     */
    public function destroy(Event $event, Bingo $bingo)
    {
      $bingoCards = BingoCard::where('event_id', $event->_id)
        ->where('bingo_id', $bingo->_id)
        ->get();
      if (isset($bingoCards)) {
        foreach ($bingoCards as $bingoCard) {
          $bingoCard->delete();
        }
      }

      if(isset($event->dynamics)){
        $dynamics = $event->dynamics;
        $dynamics["bingo"] = false;
      }else{
        $dynamics["bingo"] = false;
      }
      $event->dynamics = $dynamics;
      $bingo->delete();

      //Cambiar estado del bingo en el evento
      $event->bingo = null;
      $event->save();

      return response()->json([], 204);
    }

    /**
     * _createRandomBingoValues_: It takes a bingo and creates random values for it
     * It generates a random array of values from the original array of values
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * @urlParam bingo_id required The id of the bingo to generate the random values for.
     * 
     * @return A JSON object with the Bingo object.
     */
    public function createRandomBingoValues($event, Bingo $bingo)
    {
      $bingoValues = $bingo->bingo_values;
      $randomBingoValues = [];

      // generar valores aleatoreos para bingo ganador
      while(count($randomBingoValues) < count($bingoValues)) {
	      $randomValue = $bingoValues[rand(0, count($bingoValues) - 1)];
	      !in_array($randomValue, $randomBingoValues, true)
	        && array_push($randomBingoValues, $randomValue);
      }
      $bingo->random_bingo_values = $randomBingoValues;
      $bingo->save();

      return response()->json($bingo);
    }

    /**
     * _resetBingoCards_: It takes a bingo and resets all the cards for it
     * > Reset all bingo cards for all attendees of a bingo event
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * @urlParam bingo_id required The id of the bingo to reset the cards for.
     * 
     * @return A JSON response with a message and a 200 status code.
     */
    public function resetBingoCards($event, Bingo $bingo)
    {
	    UserEventService::resetBingoCardsForAttendees($bingo);
	    return response()->json(['message' => 'New bingo cards generated for all attendees'], 200);
    }

    /**
     * _importBingoValues_: It takes a request, validates it, and then imports the values to the database
     * It takes a JSON array of objects, each object containing a `carton_value` and a `ballot_value`
     * property, and saves them to the database
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * @urlParam bingo_id required The id of the bingo to add the bingo cards to.
     * 
     * @bodyParam replace_data boolean required Whether to replace the existing data or not.
     * @bodyParam data array required The array of objects to save.
     * 
     * @return The response is a json object with the following structure:
     * ```
     * {
     *   "success": [{}]
     *   "count_success": 2,
     *   "fail": [{}],
     *   "count_fail": 2
     */
    public function importBingoValues(Request $request, $event, Bingo $bingo)
    {
      $request->validate([
        'replace_data' => 'required|boolean',
        'data' => 'required'
      ]);
      $valuesToImport = $request->json()->all();
      //dd($valuesToImport['data']);
      //eliminar la data de momento y a futuro un flag para identificar si se añaden a la data existente
      if($valuesToImport['replace_data']){ //flag
        $bingo->bingo_values = [];
        $bingo->save();
      }

      $bingoValues = $bingo->bingo_values;
      $success = [];
      $bingoValues_fail = [];


      foreach($valuesToImport['data'] as $value) {
        $count_fail = count($bingoValues_fail);
        if(!isset($value['carton_value']) || !isset($value['ballot_value'])) {
          array_push($bingoValues_fail, $value);
        }
        if(!isset($value['carton_value']['type']) || !isset($value['ballot_value']['type'])) {
          array_push($bingoValues_fail, $value);
        }
        if(!isset($value['carton_value']['value']) || !isset($value['ballot_value']['value'])) {
          array_push($bingoValues_fail, $value);
        }
        // validar que el type/value sea el correcto en carton_value y ballot_value => text, image.
        if($value['carton_value']['type'] != 'text' && $value['carton_value']['type'] != 'image'
          || $value['ballot_value']['type'] != 'text' && $value['ballot_value']['type'] != 'image') {
          array_push($bingoValues_fail, $value);
        }

        if($count_fail == count($bingoValues_fail)) {
          $value[ 'id' ] = uniqid('', true);
          array_push($bingoValues, $value);
          array_push($success, $value);
        }
      }

      $bingo->bingo_values = $bingoValues;
      $bingo->save();

      return response()->json(
        [
          'success' => $success,
          'count_success' => count($success),
          'fail' => $bingoValues_fail,
          'count_fail' => count($bingoValues_fail)
        ], 201
      );
    }

    /**
     * _addBingoValue_: It takes a request, validates it, and then adds the value to the database
     * It adds a value to the bingo values array
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * @urlParam bingo_id required The id of the bingo to add the bingo values to.
     * 
     * @bodyParam carton_value.type string required The type of the carton value.
     * @bodyParam carton_value.value string required The value of the carton value.
     * @bodyParam ballot_value.type string required The type of the ballot value.
     * @bodyParam ballot_value.value string required The value of the ballot value.
     * 
     * @bodyParam carton_value.type string required Carton value: Type Example: text | image
     * @bodyParam carton_value.value  string required Carton value: Value Example: 'Carton-Value' | 'https://image.png'
     * @bodyParam ballot_value.type  string required  Ballot value: Type Example: text | image
     * @bodyParam ballot_value.value  string required  Ballot value: Value Example: 'Ballot-Value' | 'https://image.png'
     * @return The bingo object is being returned.
     */
    public function addBingoValue(Request $request, $event, Bingo $bingo)
    {
      $request->validate([
	      'carton_value.type' => 'required|string|in:text,image',
	      'carton_value.value' => 'required|string',
	      'ballot_value.type' =>  'required|string|in:text,image',
	      'ballot_value.value' =>  'required|string',
      ]);

      $value = $request->json()->all();
      $value['id'] = uniqid('', true);
      $bingoValues = $bingo->bingo_values ?
	    $bingo->bingo_values : [];

      //if(in_array($value, $bingoValues, true)) {
	      //return response()->json(['message' => "Value ${value['carton_value']} already exists in bingo values "], 403);
      //}

      array_push($bingoValues, $value);
      $bingo->bingo_values = $bingoValues;
      $bingo->save();

      return response()->json($bingo);
    }

    /**
     * _editBingoValues_: It takes a request, validates it, and then edits the values in the database
     * 
     * This function updates a bingo value in a bingo game
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * @urlParam bingo_id required The id of the bingo to update the bingo values to.
     * @urlParam value_id required The id of the bingo value to update.
     * 
     * @bodyParam carton_value.type string required The type of the carton value. Example: text || image
     * @bodyParam carton_value.value string required The value of the carton value. Example: "value"
     * @bodyParam ballot_value.type string required The type of the ballot value. Example: text || image
     * @bodyParam ballot_value.value string required The value of the ballot value. Example: "value"
     * 
     * @return The bingo object is being returned.
     */
    public function editBingoValues(Request $request, $event, Bingo $bingo, $value_id)
    {
      $request->validate([
        'carton_value.type' => 'string|in:text,image',
        //'carton_value.value' => 'string',
        'ballot_value.type' =>  'string|in:text,image',
        //'ballot_value.value' =>  'string',
      ]);

      $value = $request->json()->all();
      $value['id'] = $value_id;
      //if(in_array($value, $bingo->bingo_values, true)) {
              //return response()->json(['message' => "Value ${value['carton_value']} already exists in bingo values "], 403);
      //}
	    UserEventService::updateBingoValues($bingo, $value);
      $bingoValues = [];
      foreach($bingo->bingo_values as $bingoValue) {
              if(isset($bingoValue['id']) && $bingoValue['id'] === $value_id) {
                $bingoValue = $value;
              }
              array_push($bingoValues, $bingoValue);
      }
      $bingo->bingo_values = $bingoValues;
      $bingo->save();
      return response()->json($bingo);
    }

    /**
     * _deleteBingoValues_: It takes a request, validates it, and then deletes the values in the database
     * It deletes a value from the Bingo model
     * 
     * @urlParam event_id required The id of the event to add the bingo to.
     * @urlParam bingo_id required The id of the bingo to delete the bingo values to.
     * @urlParam value_id required The id of the bingo value to delete.
     * 
     * @return The bingo object with the updated bingo_values array.
     */
    public function deleteBingoValue($event, Bingo $bingo, $value_id)
    {
      $bingoValues = $bingo->bingo_values;

      //se omite usar array_filter por la forma en que devuelve los datos, foreach como alternativa
      $newBingoValues = [];
      foreach($bingoValues as $value) {
	      $value['id'] !== $value_id && array_push($newBingoValues, $value);
      };

      $bingo->bingo_values = $newBingoValues;
      $bingo->save();

      return response()->json($bingo);
    }
}
