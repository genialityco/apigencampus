<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);
        // Si existe password la elimina de $result
        // $password = $result['properties']['password'];
        if (!empty($password)) {
            unset($result['properties']['password']);
        }
        return $result;
    //     return [
    //         '_id' => $this->_id,
    //         'state_id' => $this->state_id,
    //         'checked_in' => $this->checked_in,
    //         'rol_id' => $this->rol_id,
    //         'properties' => [
    //             'email' => $this->properties['email'],
    //             'names' => $this->properties['names'],
    //         ],
    //         'event_id' => $this->event_id,
    //         'account_id' => $this->account_id,
    //         'private_reference_number' => $this->private_reference_number,
    //         'updated_at' => $this->updated_at,
    //         'created_at' => $this->created_at,
    //         // 'user' => $this->user,
    //         'rol' => $this->rol,
    //         'state' => $this->state,
    //         'ticket' => $this->ticket
    //     ];
    }
}
