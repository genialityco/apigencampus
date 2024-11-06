<?php

namespace App\Http\Controllers;

// models
use App\Event;
use App\Millionaire;
use Illuminate\Http\Request;

/**
 * @group Millionaire
 *
 */

class MillionaireController extends Controller
{
    /**
     * _store_: Creates a new Millionaire object and saves it to the database.
     * 
     * It creates a new Millionaire object and saves it to the database
     *
     * @urlParam event_id required The id of the event to add the millionaire to.
     * 
     * @bodyParam name string required The name of the millionaire. Example: John Doe
     * @bodyParam number_of_questions int required The number of questions the millionaire has. Example: 10
     *
     * @return A JSON object with the bingo created.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'number_of_stages' => 'required|numeric',
        ]);

        $data = $request->json()->all();
        $data['event_id'] = $event->_id;
        //crear numero de etapas 
        $data['stages'] = [];
        $score_base = 100;
        for ($i = 0; $i < $data['number_of_stages']; $i++) {
            $data['stages'][$i] = [
                'id' => uniqid(),
                'number' => ($i + 1),
                'life_save' => false,
                'score' => $score_base * ($i + 1),
                'question' => null
            ];
        }
        $millionaire = Millionaire::create($data);

        //Nuevo atributo para el bingo creado. $event->dynamics.
        if (isset($event->dynamics)) {
            $dynamics = $event->dynamics;
            $dynamics["millionaire"] = true;
        } else {
            $dynamics["millionaire"] = true;
        }
        $event->dynamics = $dynamics;
        $event->save();

        return response()->json($millionaire, 201);
    }

    /**
     * _MillionairebyEvent_: search of Millionaire by event.
     *
     * @urlParam event required  event_id
     *
     */

    public function MillionairebyEvent(string $event_id)
    {
        $millionaire = Millionaire::where('event_id', $event_id)->first();
        return $millionaire;
    }

    /**
     * _update_: Updates a Millionaire object and saves it to the database.
     * It takes a request, an event, and a bingo, and updates the bingo with the data from the request
     *
     * @urlParam event_id required The id of the event to add the millionaire to.
     * @urlParam millionaire_id required The id of the millionaire to update.
     * 
     * @bodyParam name string optional The name of the millionaire. Example: John Doe
     * @bodyParam number_of_questions int optional The number of questions the millionaire has. Example: 10
     * @bodyParam time_per_question int optional The time per question the millionaire has. Example: 10
     * @bodyParam rules string optional The rules of the millionaire. Example: Rules
     * @bodyParam event_id string optional The event id. Example: 5f1f1f1f1f1f1f1f1f1f1f1f
     * @bodyParam appearance string optional The appearance of the millionaire. Example: Appearance
     * @bodyParam stages array optional The stages of the millionaire. Example: Stages
     * @bodyParam questions array optional The questions of the millionaire. Example: Questions
     *
     * @return The updated bingo object.
     */
    public function update(Request $request, $event, Millionaire $millionaire)
    {
        $request->validate([
            'number_of_stages' => 'required|numeric',
        ]);
        $data = $request->json()->all();
        //comprobar si la cantidad de etapas es la misma
        switch ($data['number_of_stages']) {
            case $data['number_of_stages'] > $millionaire->number_of_stages:
                $score_base = 100;
                $stages = $millionaire->stages;
                for ($i = $millionaire->number_of_stages; $i < $data['number_of_stages']; $i++) {
                    $stages[$i] = [
                        'id' => uniqid(),
                        'number' => ($i + 1),
                        'life_save' => false,
                        'score' => $score_base * ($i + 1),
                        'question' => null
                    ];
                }
                $millionaire->stages = $stages;
                break;
            case $data['number_of_stages'] < $millionaire->number_of_stages:
                $stages = $millionaire->stages;
                for ($i = $millionaire->number_of_stages; $i > $data['number_of_stages']; $i--) {
                    unset($stages[$i - 1]);
                }
                $millionaire->stages = $stages;
            break;
        }
        
        $millionaire->fill($data);
        $millionaire->save();

        return response()->json($millionaire, 200);
    }

    /**
     * _delete_: Deletes a Millionaire object from the database.
     * It deletes a bingo and all its cards
     *
     * @urlParam event_id required The id of the event to add the millionaire to.
     * @urlParam millionaire_id required The id of the millionaire to delete.
     *
     * @return 204 No Content
     */
    public function destroy(Event $event, Millionaire $millionaire)
    {
        if (isset($event->dynamics)) {
            $dynamics = $event->dynamics;
            $dynamics["millionaire"] = false;
        } else {
            $dynamics["millionaire"] = false;
        }
        $event->dynamics = $dynamics;
        $millionaire->delete();
        $event->save();
        return response()->json([], 204);
    }

    /**
     * _addStage_: Adds a stage to a Millionaire object.
     * It adds a new stage to the stages array of a millionaire
     * 
     * @urlParam millionaire_id required The id of the millionaire to add the stage to.
     * 
     * @bodyParam number int required The number of the stage. Example: 1
     * @bodyParam life_save boolean required If the stage has a life save. Example: true
     * @bodyParam score int required The score of the stage. Example: 100
     * 
     * @return The millionaire object with the new stage added.
     */
    public function addStage(Request $request, Millionaire $millionaire)
    {
        $request->validate([
            'number' => 'required|numeric',
            'life_save' => 'required|boolean',
            'score' => 'required|numeric',
        ]);
        $data = $request->json()->all();
        $data['id'] = uniqid();
        $stages = $millionaire->stages ? $millionaire->stages : [];
        array_push($stages, $data);
        $millionaire->stages = $stages;
        $millionaire->save();
        return response()->json($millionaire, 201);
    }

    /**
     * _updateStage_: Updates a stage of a Millionaire object.
     * It takes a request, a millionaire model, and a stage id, validates the request, gets the data
     * from the request, gets the stages from the millionaire model, finds the index of the stage id in
     * the stages array, merges the data with the stage at the index, saves the millionaire model, and
     * returns the millionaire model
     * 
     * @urlParam millionaire_id required The id of the millionaire to update the stage of.
     * @urlParam stage_id required The id of the stage to update.
     * 
     * @bodyParam number int required The number of the stage. Example: 1
     * @bodyParam life_save boolean required If the stage has a life save. Example: true
     * @bodyParam score int required The score of the stage. Example: 100
     * 
     * @return The updated millionaire object.
     */
    public function updateStage(Request $request, Millionaire $millionaire, $stage_id)
    {
        $request->validate([
            'number' => 'required|numeric',
            'life_save' => 'required|boolean',
            'score' => 'required|numeric',
        ]);
        $data = $request->json()->all();
        $stages = $millionaire->stages;
        $index = array_search($stage_id, array_column($stages, 'id'));
        $merge = array_merge($stages[$index], $data);
        $stages[$index] = $merge;
        $millionaire->stages = $stages;
        $millionaire->save();
        return response()->json($millionaire);
    }

    /**
     * _deleteStage_: Deletes a stage from a Millionaire object.
     * > Remove a stage from a millionaire's stages array
     * 
     * @urlParam millionaire_id required The id of the millionaire to remove the stage from.
     * @urlParam stage_id required The id of the stage to remove.
     * 
     * @return The millionaire object is being returned.
     */
    public function removeStage(Millionaire $millionaire, $stage_id)
    {
        $stages = $millionaire->stages;
        $new_stages = [];
        foreach ($stages as $stage) {
            if ($stage['id'] != $stage_id) {
                array_push($new_stages, $stage);
            }
        }
        $millionaire->stages = $new_stages;
        $millionaire->save();
        return response()->json($millionaire);
    }

    /**
     * _addQuestion_: Adds a question to a Millionaire object.
     * It takes a request, validates it, adds a unique id to the question and answers, adds the
     * question to the questions array, and saves the millionaire
     * 
     * @urlParam millionaire_id required The id of the millionaire to add the question to.
     * 
     * @bodyParam question string required The question. Example: What is the capital of France?
     * @bodyParam time_limit int required The time limit of the question in seconds. Example: 10
     * @bodyParam type string required The type of the question. Example: text || image
     * @bodyParam answers array required The answers of the question. Example: [{"answer": "Paris", "is_correct": true, "is_true_or_false": true, "type": "text"}, {"answer": "London", "is_correct": false, "is_true_or_false": true, "type": "text"}]
     * 
     * @return The response is a JSON object containing the updated millionaire object.
     */
    public function addOneQuestion(Request $request, Millionaire $millionaire)
    {
        $request->validate([
            'question' => 'required|string',
            'time_limit' => 'required|numeric',
            'type' => 'required|string',
            'answers' => 'required|array',
        ]);

        $data = $request->json()->all();
        $data['id'] = uniqid();
        $new_answers = [];
        foreach($data['answers'] as $answer) {
            $answer['id'] = uniqid();
            array_push($new_answers, $answer);
        }

        $data['answers'] = $new_answers;
        $questions = $millionaire->questions ? $millionaire->questions : [];
        array_push($questions, $data);
        $millionaire->questions = $questions;
        $millionaire->save();
        return response()->json($millionaire, 201);
    }

    /**
     * _updateQuestion_: Updates a question of a Millionaire object.
     * It takes a request, a millionaire object, and a question id, validates the request, gets the
     * data from the request, gets the questions from the millionaire object, finds the index of the
     * question id in the questions array, merges the data with the question at the index, saves the
     * millionaire object, and returns the millionaire object
     * 
     * @urlParam millionaire_id required The id of the millionaire to update the question of.
     * @urlParam question_id required The id of the question to update.
     * 
     * @bodyParam question string required The question. Example: What is the capital of France?
     * @bodyParam time_limit int required The time limit of the question in seconds. Example: 10
     * @bodyParam type string required The type of the question. Example: text || image
     * 
     * @return The updated millionaire object.
     */
    public function updateQuestion(Request $request, Millionaire $millionaire, $question_id)
    {
        $request->validate([
            'question' => 'required|string',
            'time_limit' => 'required|numeric',
            'type' => 'required|string',
        ]);
        $data = $request->json()->all();
        $questions = $millionaire->questions;
        $index = array_search($question_id, array_column($questions, 'id'));
        $merge = array_merge($questions[$index], $data);
        $questions[$index] = $merge;
        $millionaire->questions = $questions;
        $millionaire->save();
        return response()->json($millionaire);
    }

    /**
     * _removeQuestion_: Removes a question from a Millionaire object.
     * > Remove a question from the questions array of a millionaire object
     * 
     * @urlParam millionaire_id required The id of the millionaire to remove the question from.
     * @urlParam question_id required The id of the question to remove.
     * 
     * @return The millionaire object with the new questions array.
     */
    public function removeOneQuestion(Millionaire $millionaire, $question_id)
    {
        //comprobar si la pregunta esta asignada a una etapa
        foreach($millionaire->stages as $stage) {
            $stage_question = $stage['question'] ? $stage['question'] : null;
            if($stage_question == $question_id) {
                return response()->json(['error' => 'The question is assigned to a stage'], 400);
            }
        }

        $questions = $millionaire->questions;
        $new_questions = [];
        foreach ($questions as $question) {
            if ($question['id'] != $question_id) {
                array_push($new_questions, $question);
            }
        }
        $millionaire->questions = $new_questions;
        $millionaire->save();
        
        return response()->json($millionaire);
    }

    /**
     * _addAnswer_: Adds an answer to a question of a Millionaire object.
     * It adds an answer to a question in a millionaire game
     * 
     * @urlParam millionaire_id required The id of the millionaire to add the answer to.
     * @urlParam question_id required The id of the question to add the answer to.
     * 
     * @bodyParam answer string required The answer. Example: Paris
     * @bodyParam is_correct boolean required The answer. Example: true
     * @bodyParam is_true_or_false boolean required The answer. Example: false
     * @bodyParam type string required The answer. Example: text || image
     * 
     * @return The millionaire object with the new answer added to the question.
     */
    public function addOneAnswer(Request $request, Millionaire $millionaire, $question_id)
    {
        $request->validate([
            'answer' => 'required|string',
            'is_correct' => 'required|boolean',
            'is_true_or_false' => 'required|boolean',
            'type' => 'required|string',
        ]);
        $data = $request->json()->all();
        $data['id'] = uniqid();
        $questions = $millionaire->questions;
        $index = array_search($question_id, array_column($questions, 'id'));
        $answers = $questions[$index]['answers'];
        array_push($answers, $data);
        $questions[$index]['answers'] = $answers;
        $millionaire->questions = $questions;
        $millionaire->save();
        // comprobar si la respuesta es de una pregunta que esta asignada a un stage y actualizar el stage
        foreach($millionaire->stages as $stage) {
            if($stage['question']['id'] == $question_id) {
                App('App\Http\Controllers\MillionaireController')->assignQuestionToStage($millionaire, $stage['id'], $question_id);
            }
        }
        return response()->json($millionaire);
    }

    /**
     * _updateAnswer_: Updates an answer of a question of a Millionaire object.
     * It updates an answer of a question of a millionaire
     * 
     * @urlParam millionaire_id required The id of the millionaire to update the answer of.
     * @urlParam question_id required The id of the question to update the answer of.
     * @urlParam answer_id required The id of the answer to update.
     * 
     * @bodyParam answer string required The answer. Example: Paris
     * @bodyParam is_correct boolean required The answer. Example: true
     * @bodyParam is_true_or_false boolean required The answer. Example: false
     * @bodyParam type string required The answer. Example: text || image
     * 
     * @return The millionaire object with the updated answer.
     */
    public function updateAnswer(Request $request, Millionaire $millionaire, $question_id, $answer_id)
    {
        $request->validate([
            'answer' => 'required|string',
            'is_correct' => 'required|boolean',
            'is_true_or_false' => 'required|boolean',
            'type' => 'required|string',
        ]);
        $data = $request->json()->all();
        $questions = $millionaire->questions;
        $index = array_search($question_id, array_column($questions, 'id'));
        $answers = $questions[$index]['answers'];
        $index_answer = array_search($answer_id, array_column($answers, 'id'));
        $merge = array_merge($answers[$index_answer], $data);
        $answers[$index_answer] = $merge;
        $questions[$index]['answers'] = $answers;
        $millionaire->questions = $questions;
        $millionaire->save();
        // comprobar si la respuesta es de una pregunta que esta asignada a un stage y actualizar el stage
        foreach($millionaire->stages as $stage) {
            if($stage['question']['id'] == $question_id) {
                App('App\Http\Controllers\MillionaireController')->assignQuestionToStage($millionaire, $stage['id'], $question_id);
            }
        }
        return response()->json($millionaire);
    }

    /**
     * _removeAnswer_: Removes an answer of a question of a Millionaire object.
     * It removes an answer from a question in a millionaire game
     * 
     * @urlParam millionaire_id required The id of the millionaire to remove the answer from.
     * @urlParam question_id required The id of the question to remove the answer from.
     * @urlParam answer_id required The id of the answer to remove.
     * 
     * @return The millionaire object with the updated questions.
     */
    public function removeOneAnswer(Millionaire $millionaire, $question_id, $answer_id)
    {
        $questions = $millionaire->questions;
        $index = array_search($question_id, array_column($questions, 'id'));
        $answers = $questions[$index]['answers'];
        $new_answers = [];
        foreach ($answers as $answer) {
            if ($answer['id'] != $answer_id) {
                array_push($new_answers, $answer);
            }
        }
        $questions[$index]['answers'] = $new_answers;
        $millionaire->questions = $questions;
        $millionaire->save();
        // comprobar si la respuesta es de una pregunta que esta asignada a un stage y actualizar el stage
        foreach($millionaire->stages as $stage) {
            if($stage['question']['id'] == $question_id) {
                App('App\Http\Controllers\MillionaireController')->assignQuestionToStage($millionaire, $stage['id'], $question_id);
            }
        }
        return response()->json($millionaire);
    }

    /**
     * _assignQuestionToStage_: Assigns a question to a stage of a Millionaire object.
     * It assigns a question to a stage.
     * 
     * @urlParam millionaire_id required The id of the millionaire to assign the question to.
     * @urlParam stage_id required The id of the stage to assign the question to.
     * @urlParam question_id required The id of the question to assign.
     * 
     * @return The question is being returned.
     */
    public function assignQuestionToStage(Millionaire $millionaire, $stage_id, $question_id)
    {
        $stages = $millionaire->stages;
        $new_stages = [];
        foreach ($stages as $stage) {
            if ($stage['id'] == $stage_id) {
                $stage['question'] = $question_id;
            }
            array_push($new_stages, $stage);
        }
        $millionaire->stages = $new_stages;
        $millionaire->save();
        return response()->json($millionaire);
    }

    /**
     * _importQuestions_: Imports questions from a Millionaire object.
     * It takes a request, validates it, and then adds the questions to the database
     * 
     * @urlParam millionaire_id required The id of the millionaire to add the questions to.
     * 
     * @bodyParam replace_questions boolean required If you want to replace the questions or not. Example: true
     * @bodyParam questions array required The questions to be imported. Example: [
     *  {"question":"¿Cuál es la capital de Francia?","answers":[
     *      {"answer":"Paris","is_correct":true,"is_true_or_false":false,"type":"text"},
     *      {"answer":"Madrid","is_correct":false,"is_true_or_false":false,"type":"text"},
     *      {"answer":"Londres","is_correct":false,"is_true_or_false":false,"type":"text"},
     *      {"answer":"Roma","is_correct":false,"is_true_or_false":false,"type":"text"}
     *  ]},
     * ]
     * 
     * @return The response is a JSON object with the following properties:
     * - success: an array of the questions that were successfully imported
     * - count_success: the number of questions that were successfully imported
     * - fail: an array of the questions that were not successfully imported
     * - count_fail: the number of questions that were not successfully imported
     */
    public function importQuestions(Request $request, Millionaire $millionaire)
    {
        $request->validate([
            'replace_questions' => 'required|boolean',
            'questions' => 'required|array',
        ]);
        $valuesToImport = $request->json()->all();

        if($valuesToImport['replace_questions']){ //flag
            $millionaire->questions = [];
            $millionaire->save();
        }

        $questions = $millionaire->questions ? $millionaire->questions : [];
        $success = [];
        $questions_fail = [];


        foreach($valuesToImport['questions'] as $value) {
            $count_fail = count($questions_fail);
            if(!isset($value['question']) || !isset($value['time_limit']) || !isset($value['type']) || !isset($value['answers'])) {
                array_push($questions_fail, $value);
            }
            if($value['type'] != 'text' && $value['type'] != 'image') {
                array_push($questions_fail, $value);
            }

            $new_answers = [];
            foreach($value['answers'] as $answer) {
                if(!isset($answer['answer']) || !isset($answer['is_correct']) || !isset($answer['is_true_or_false']) || !isset($answer['type'])) {
                    array_push($questions_fail, $value);
                }
                if($answer['type'] != 'text' && $answer['type'] != 'image') {
                    array_push($questions_fail, $value);
                }
                $answer['id'] = uniqid();
                array_push($new_answers, $answer);
            }

            if($count_fail == count($questions_fail)) {
                $value[ 'id' ] = uniqid();
                $value[ 'answers' ] = $new_answers;
                array_push($questions, $value);
                array_push($success, $value);
            }
        }

        $millionaire->questions = $questions;
        $millionaire->save();

        return response()->json(
            [
            'success' => $success,
            'count_success' => count($success),
            'fail' => $questions_fail,
            'count_fail' => count($questions_fail)
            ], 201
        );
    }
}
