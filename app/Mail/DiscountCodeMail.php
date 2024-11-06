<?php

namespace App\Mail;

use App\Event;
use App\DiscountCode;
use App\Order;
use App\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\IcalendarGenerator\Components\Calendar as iCalCalendar;
use Spatie\IcalendarGenerator\Components\Event as iCalEvent;

class DiscountCodeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $code;
    public $order;
    public $event;
    public $eventName;
    public $codeTemplate;
    public $organization;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $order, $codeTemplate)
    {


        $event = isset($code->event_id) ? Event::findOrFail($code->event_id) : "";
        $organization = isset($event->organizer_id) ?
            Organization::findOrFail($event->organizer_id) :
            Organization::findOrFail($code->organization_id);

        $this->code = $code;
        $this->order = $order;
        $this->event = $event;
        $this->codeTemplate = $codeTemplate;
        $this->organization = $organization;
    }


    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $organization = $this->organization;

        if (isset($this->event->name)) {
            return $this
                ->from(array_merge(config('mail.from'), ['name' => $organization->name]))
                ->subject($this->event->name)
                ->markdown('Mailers.DiscountCode');
        }

        return $this
            ->from(array_merge(config('mail.from'), ['name' => $organization->name]))
            ->subject('Código de descuento')
            ->markdown('Mailers.DiscountCode');
    }
}
