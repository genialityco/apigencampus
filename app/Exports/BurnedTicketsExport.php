<?php

namespace App\Exports;

use App\BurnedTicket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BurnedTicketsExport implements FromView
{
    private $event;

    public function properties(): array
    {
        return [
            'creator'        => 'Evius',
            'lastModifiedBy' => 'Evius',
            'title'          => 'BurnedTickets',
            'description'    => 'Boleteria simposio sinchi',
            'subject'        => 'Simposio',
            'keywords'       => 'invoices,export,spreadsheet',
            'category'       => 'Invoices',
            'manager'        => 'Evius',
            'company'        => 'Evius',
        ];
    }

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function view(): View
    {
        $burnedTickets = BurnedTicket::where('event_id', $this->event->_id)->get();
        return view('exports.burnedTickets', compact('burnedTickets'));
    }
}
