<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;
use QRCode;
// Models
use App\TicketCategory;
use App\Event;

class BurnedTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $burnedTicket;
    public $qr;
    public $lang;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($burnedTicket, $lang)
    {
	$this->burnedTicket = $burnedTicket;
	// Enviar correo dependiendo del idioma
	$this->lang = $lang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	$ticketCategory = TicketCategory::findOrFail($this->burnedTicket['ticket_category_id']);
	$event = Event::findOrFail($this->burnedTicket['event_id']);

	$burnedTicket = $this->burnedTicket;
	$lang = $this->lang;
	$burnedTicket['ticket_category'] = $ticketCategory;
	$burnedTicket['event'] = $event;

	// QR
        ob_start();
        $qr = QRCode::text($burnedTicket->_id)->setSize(6)->setMargin(2)->png();
        $page = ob_get_contents();
        ob_end_clean();
        $qr = base64_encode($page);
	$this->qr = $qr;

	// Mail config
        $mail = $this->from('alerts@evius.co', $event->name);
	$subject = $lang === 'es' ? 'Compra exitosa' : 'Successful purchase';
        $mail->subject($subject);

	// PDF
        $pdf = PDF::loadview('rsvp.pdfQR', compact('qr', 'burnedTicket', 'lang'));
        $pdf->setPaper([0.0, 0.0, 300, 150], 'portrait');
        $mail->attachData($pdf->download(), "ticket-{$burnedTicket->code}.pdf");

        return $mail->view('rsvp.burnedTicket');
    }
}
