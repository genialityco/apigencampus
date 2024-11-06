<?php

namespace App\Models;
use Moloquent;
    /*
      Attendize.com   - Event Management & Ticketing
     */

/**
 * Description of Timezone.
 *
 * @author Dave
 */
class Timezone extends Moloquent
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * Indicates if the model should use soft deletes.
     *
     * @var bool $softDelete
     */
    protected $softDelete = false;
}
