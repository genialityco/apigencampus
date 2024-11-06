<?php

namespace App\Models;
use Moloquent;
    /*
      Attendize.com   - Event Management & Ticketing
     */

/**
 * Description of TicketStatuses.
 *
 * @author Dave
 */
class TicketStatus extends MyBaseModel
{
    public $timestamps = false;
    protected $table = 'ticket_statuses';
}
