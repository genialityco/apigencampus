<?php

namespace App;

use Moloquent;

class PaymentPlan extends Moloquent
{
    protected $table = 'payment_plans';

    // Fields
    protected $fillable = [
        "price", // 0 whether free
        "date_until", // this value SHOULD BE set by controller - DON'T the front
        "days", // With this value, the `date_until` is set
        // created_at (automatic) is used by reporting
        // updated_at (automatic) is used by reporting
    ];

    public function organization_user()
    {
        return $this->hasOne('App\OrganizationUser', 'payment_plan_id');
    }

}
