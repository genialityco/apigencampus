<?php

namespace App\Http\Controllers;

use App\Attendee as AppAttendee;
use App\Certificate;
use App\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PDF;
use Storage;
use Auth;
use Mail;

/**
 * @group Certificate
 * En algunos eventos se dan certificados de asistencia, este api es el encargado de administrarlos.
*/
class CertificateController extends Controller
{

    /* por defecto el modelo es en singular y el nombre de la tabla en prural
    //protected $table = 'categories';
    $a = new Certificate();
    var_dump($a->getTable());
     */

    /**
     * _index_: Lista de certificados generados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, string $event_id)
    {   
        $query = Certificate::where('event_id' , $event_id)->paginate(config('app.page_size'));
        return JsonResource::collection($query);
        //$events = Event::where('visibility', $request->input('name'))->get();
    }

    /**
     * _store_:Creación de certificados.
     *
     * @bodyParam name string required nombre del certificado
     * @bodyParam content string required contenido del certificado
     * @bodyParam background string required imagen de fondo. 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $result = new Certificate($data);
        $result->save();
        return $result;

    }

    /**
     * _show_: Ver la información de un certificado específico.
     * 
     * @urlParam id required id del certificado a mostrar
     *
     * @param  \App\Certificate  $Certificate
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $Certificate = Certificate::find($id);
        $response = new JsonResource($Certificate);
        return $response;
    }
    /**
     * _update_: Actualizar información de un certificado específico. 
     *
     * @urlParam id required id del certificado a actualizar
     * 
     * @bodyParam name string required nombre del certificado
     * @bodyParam content string required contenido del certificado
     * @bodyParam background string required imagen de fondo 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificate  $Certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $data = $request->json()->all();
        $Certificate = Certificate::find($id);
        $Certificate->fill($data);
        $Certificate->save();
        return $data;
    }

    /**
     * _destroy_: Eliminar registro de un certificado.
     * 
     * @urlParam id required id del certificado a actualizar
     * 
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $Certificate = Certificate::find($id);
        return (string) $Certificate->delete();

    }

    /**
     *  _indexByEvent_: Listar los certificados por evento.
     * 
     * @urlParam event_id required
     * 
     * @param String $event_id
     * @return void
     */
    public function indexByEvent(String $event_id)
    {  
        $auth = Auth::user();

        $eventUser = Attendee::where("event_id", $event_id)->where('account_id' , $auth->_id)->first();


        $certificates = Certificate::where("event_id", $event_id)->where('rol_id' , $eventUser->rol_id )->first();
        
        if(isset($certificates) && !empty($certificates))
        {
            return $certificates; 
        }
        return JsonResource::collection(
            Certificate::where("event_id", $event_id)->paginate(config('app.page_size'))
        );
    }

    /**
     * _certificatePdf_: Construcción de certificado PDF
     * 
     * @bodyParam name string required nombre del certificado
     * @bodyParam content string required contenido del certificado
     * @bodyParam background string required imagen de fondo 
     * 
     * @param Request $request
     * @return void
     */
    public function certificatePdf(Request $request)
    {
        $contentqry = Attendee::findOrFail("event_id", "5d2de182d74d5c28047d1f85")->get();
        echo var_dump($contentqry);
        die;
        $data = $request->json()->all();
        $data = $request->json()->all();
        //$content = Certificate::where("content");
        //$image=$request->input("image");
        // $content=$request->input("content");

        //$contentqry = Certificate::where("content", $id);
        //$backgroundqry = Certificate::where("background", $id)
        //$attendee = Attendee::scope()->backgrounddOrFid($attendee_id);

        //$content = '<p><br></p> <p> <h3>CERTIFICADO DE ASISTENCIA</h3> </p> </br> <p style="margin-top:-3%;" ><span style="font-weight: 400; font-size: 14pt;"> <br></span></p> <p style="">Certificamos que&nbsp;<span style="font-style: normal; font-weight: bold;" class="name">Pablo </span> , identificada con el No. de cédula<br> <span style="font-style: normal; font-weight: bold;" class="iden">[1033801141user.identificación]</span> participó con éxito en calidad de asistente&nbsp;<span style="font-style: normal; font-weight: bold;"><br class="eventName">[event.name]</span></p><br><p style="">BOGOTÁ, COLOMBIA</p> <div style="position:absolute;bottom: 420px;left:-1440px"><span style="font-style: normal; font-weight: bold;">DOMINICA MARTÍNEZ</span><p>presidente Congreso Internacional de<br>Gerencia de Proyectos</p></div> <div style=" position:absolute;bottom:490px;right:-1540px;"><span style="font-style:normal;font-weight: bold">CLAUDIA TRUJILLO</span><p>presidente PMI - 2019</p></div>';

        //$data = [
        //    'content'   => $content,
        //    'image'     => "ASDASD"
        //];

        //if(($cedula)){echo "cedula no encontrada";}
        //echo $contentqry;
        //echo gettype($contentqry);

        if ($request->get('download') == '1') {

            $pdf = PDF::loadview('Public.ViewEvent.Partials.certificate', $data);

            $pdf->setPaper(
                'letter', 'landscape'
            );

            //Busca en el content la identificacion, la separa con funciones de string y luego busca la cedula en la base de datos
            //cuando encuentra la cedula extrae el correo asociado a la cedula, cuando el usuario oprime descargar tambien se envia al correo
            /* $cedula = $data["content"];
            $nombreEvento = $data["content"];
            //para separar este evento de los demas se agrega una clase "iden" que permite saber que ese certificado es unico para ese evento y usara esta funcion
            if(strpos($cedula, 'class="iden"')){
            $cedula = $data["content"];
            $cedula = strstr($cedula,'"iden">');
            $cedula = strstr($cedula,'</span>',true) ;
            $cedula = (string) filter_var($cedula, FILTER_SANITIZE_NUMBER_INT);
            $contentqry = Attendee::where('identificacion', $cedula)->where("event_id" , "5d2de182d74d5c28047d1f85")->get();
            $cedula = json_decode(json_encode($contentqry));
            $cedula = $cedula[0]->email;
            $nombreEvento = strstr($nombreEvento,'"eventName">');
            $nombreEvento = strstr($nombreEvento,'>');
            $nombreEvento = substr($nombreEvento,1);
            $nombreEvento = strstr($nombreEvento,'</span>',true) ;

            //FUNCION DE ENVIAR CORREO

            Mail::send('Public.ViewEvent.Partials.certificate', $data, function ($message) use ($data,$pdf,$cedula,$nombreEvento){
            $message->to($cedula,"Evento PMI")
            ->subject("Tus certificados para el evento",$nombreEvento)
            ->attachData($pdf->download(),'Tickets.pdf');
            });
            }*/

            return $pdf->download('Tickets.pdf');
        }
        return view(
            'Public.ViewEvent.Partials.certificate', $data);
    }
    //return view('Public.ViewEvent.Partials.PDFTicket', $data);

    /**
     * _generateCertificate_: Generar certificado
     * 
     * @bodyParam name string required nombre del certificado
     * @bodyParam content string required contenido del certificado
     * @bodyParam background string required imagen de fondo
     * 
     * @param Request $request
     * @return void
     */
    public function generateCertificate(Request $request)
    {
        $data = $request->json()->all();

        if ($request->get('download') == '1') {
            //return view('Public.ViewEvent.Partials.PDFTicket', $data);
            //return view('Public.ViewEvent.Partials.certificate', $data);
            $pdf = PDF::loadview('Public.ViewEvent.Partials.certificate', $data);
            //$customPaper = array(0, 0, 460, 445);
            $pdf->setPaper('letter', 'landscape');
            //$pdf->setPaper($customPaper);
            return $pdf->download('Tickets.pdf');
        }
        return view('Public.ViewEvent.Partials.PDFTicket', $data);

    }

    public function sendCertificateForAll(Request $request, Event $event)
    {
	$attendees = Attendee::where('event_id', $event->id)->get();
        $data = $request->json()->all();

	for($i = 0; $i < count($attendees); $i++) {
	    // Customizar nombre
	    $data['content'] = "<p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><h2 class=\"ql-align-center\"><strong style=\"color: rgb(0, 41, 102);\">{$attendees[$i]->properties['names']}</strong></h2>";

	    // Generar pdf
	    $pdf = PDF::loadview('Public.ViewEvent.Partials.certificate', $data);
	    $pdf->setPaper('letter', 'landscape');

	    // Enviar correo
            Mail::to($attendees[$i]->properties['email'])
                ->queue(
                    new \App\Mail\NogalMail($pdf)
                );
	}

	return response()->json(['message' => count($attendees) . " correos enviados"], 200);
    }

}
