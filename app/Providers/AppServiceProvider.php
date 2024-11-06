<?php

namespace App\Providers;

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use App\Services\SocialUserResolver;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;

//use Kreait\Firebase\Auth;

class AppServiceProvider extends ServiceProvider implements ShouldQueue
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public $bindings = [
        SocialUserResolverInterface::class => SocialUserResolver::class,
    ];
    
    public function boot()
    {

        setlocale(LC_ALL, "es_ES.utf8");
        \Carbon\Carbon::setLocale(config('app.locale'));
        
        Resource::withoutWrapping();

        //Esta duplicando los eventos aún no entiendo porque
        //\App\Attendee::observe(\App\Observers\EventUserObserver::class);

        /*\App\Attendee::saved(function ($eventUser) {
        Log::debug("\App\Attendee::saved boot");
        });
         */
        \App\Attendee::deleted(function ($eventUser) {
            self::deleteFirestore($eventUser->event_id . '_event_attendees', $eventUser->_id);
        });

        \App\Attendee::saved(
            function ($eventUser) {
                Log::debug("\App\Attendee::saved boot: " . json_encode($eventUser, JSON_PRETTY_PRINT));
                //se puso aqui esto porque algunos usuarios se borraron es para que las pruebas no fallen
                $email = (isset($eventUser->user->email)) ? $eventUser->user->email : "apps@mocionsoft.com";
                /**
                 * Guardar en firestore
                 * Debes enviar:
                 *      1. la COLLECCIÓN que deseas guardar,
                 *      2. El id del DOCUMENTO
                 *      3. La información que desear guardar en el documento COLLECCIÓN.
                 */
                self::saveFirestore($eventUser->event_id . '_event_attendees', $eventUser->_id, $eventUser);
                /**
                 * Guardar en firebase Real Data Time
                 * Debes enviar:
                 *      1. la COLLECCIÓN que deseas guardar,
                 *      2. El id del DOCUMENTO
                 *      3. La información que desear guardar en el documento COLLECCIÓN.
                 */
                //self::saveFirebase('users', $eventUser->_id, $eventUser->properties);

                /* Esto se uso cuando un usuario estaba con reserva y luego compraba el tickete
            $original = $eventUser->getOriginal();

            if ($eventUser->state_id == Attendee::STATE_BOOKED && isset($original['state_id']) && $original['state_id'] != Attendee::STATE_BOOKED) {
            // Mail::to($email)
            //     ->queue(
            //         new BookingConfirmed($eventUser)
            //     );
            }*/
            }
        );

        \App\Survey::saved(function ($surveyData) {
            \Log::debug("saved survey from this: " . json_encode($surveyData));
            self::saveFirestoreBase(
                "surveys",
                $surveyData->_id,
                $surveyData,
            );
        });
        setlocale(LC_ALL, "es_ES.UTF-8");
        \Carbon\Carbon::setLocale(config('app.locale'));

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /*  $this->app->bind(
        'App\evaLib\Services\FilterQuery', function ($app) {
        return new FilterQuery();
        }
        );*/

        $this->app->singleton(
            'Kreait\Firebase\Auth', function ($app) {
                $fireauth = (new Factory)
                    ->withServiceAccount(config('filesystems.disks.gcs.key_file'))
                    ->createAuth();

                return $fireauth;
            }
        );

        $this->app->singleton(
            'Kreait\Firebase\Firestore', function ($app) {
                $firebase = (new Factory)
                    ->withServiceAccount(config('filesystems.disks.gcs.key_file'))
                    ->createFirestore();

                return $firebase;
            }
        );
        // $serviceAccount = ServiceAccount::fromJsonFile(config('filesystems.disks.gcs.key_file'));
        // $firestore = (new Factory)->withServiceAccount($serviceAccount)->createFirestore();

        $this->app->bind(
            'App\evaLib\Services\UserEventService', function ($app) {
                return new UserEventService();
            }
        );

    }

    /**
     * Save Firestore
     *
     * Este controlador fue diseñado para exportar un event_user que se encuentran en mongo
     * Realizando una migración por medio del id,
     *
     * para mas información acerca del funcionamiento de firestore con php sigue el siguiente link
     * https://github.com/morrislaptop/firestore-php
     *
     * El controlador sigue los siguientes pasos:
     *      1. Se abre el servicio de firestore
     *      2. Captura toda la información del event_users
     *      3. Se diríge a la collección, el cual es el mismo nombre "event_users"
     *      4. Recorre todos los usuarios encontrados anteriormente pero.
     *          4.1. Si los datos del usuario existen entonces.
     *          4.2. Guarda un nuevo documento con el id del event_user.
     *          4.3. Convertimos los datos del usuario en un array para poder guardarlo.
     *          4.4. Dentro del documento guardamos los datos del usuario.
     *      5. Al finalizar retornamos un mensaje sobre la culminación del trabajo
     *
     * @return \Illuminate\Http\Response
     */
    public function saveFirestore($collectionpath, $document, $data)
    {
        $firebase = new FirestoreClient([
            'keyFilePath' => config('filesystems.disks.gcs.key_file'),
        ]);

        if ($data) {
            Log::debug($collectionpath);
            $collection = $firebase->collection($collectionpath);
            $user = $collection->document($document);
            $dataUser = json_decode($data, true);
            $dataUser['updated_at'] = date_create();
            $dataUser['updated_at'] = date_create();

            $dataUser['created_at'] = (isset($dataUser['created_at'])) ? date_create($dataUser['created_at']) : date_create();
            if (isset($dataUser['checkedin_at'])) {
                $dataUser['checkedin_at'] = (isset($dataUser['checkedin_at'])) ? date_create($dataUser['checkedin_at']) : null;
            }

            // var_dump($dataUser);
            $user->set($dataUser);

        }
    }

    /**
     * Do thing like saveFirestore, but this is of general purpose :)
     */
    public function saveFirestoreBase($collection_path, $document_id, $data)
    {
        $firebase = new FirestoreClient([
            'keyFilePath' => config('filesystems.disks.gcs.key_file'),
        ]);

        if ($data) {
            Log::debug("will save to Firebase path: " . $collection_path);
            Log::debug("document_id =" . $document_id);

            $collection = $firebase->collection($collection_path);
            $firebase_document = $collection->document($document_id);

            $exportable_data = json_decode($data, true);
            $exportable_data['updated_at'] = date_create();

            $exportable_data['created_at'] = (isset($exportable_data['created_at'])) ? date_create($exportable_data['created_at']) : date_create();

            $firebase_document->set($exportable_data);
        }
    }

    public function deleteFirestore($collectionpath, $document)
    {
        $firebase = new FirestoreClient([
            'keyFilePath' => config('filesystems.disks.gcs.key_file'),
        ]);

        $collection = $firebase->collection($collectionpath);
        $doc = $collection->document($document);
        $doc->delete();

    }
}