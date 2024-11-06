<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\PaymentPlan;
use App\OrganizationUser;

use Illuminate\Http\Request;

class PaymentPlanController extends Controller
{
    //
    public function store(Request $request, $organization_user_id)
    {
        $request->validate([
            'price' => 'required',
            'days' => 'required',
        ]);
        $data = $request->json()->all();
        $price = $data['price'];
        $days = $data['days'];

        $userOrganization = OrganizationUser::findOrFail($organization_user_id);
        if (isset($data['date_from'])) {
            $date_from = $data['date_from'];
            $today  = Carbon::parse($date_from);
        } else {
            $today = Carbon::now();
        }
        

        $payment_plan = new PaymentPlan([
            "days" => $days,
            "date_until" => $today->addDays($days)->toIso8601String(),
            "price" => $price,
        ]);

        $userOrganization->payment_plan()->save($payment_plan);

        return $userOrganization;
    }

    public function destroy(Request $request, String $organization_user_id) {
        $payment_plan = PaymentPlan::where('organization_user_id', $organization_user_id)->first();

        if (!$payment_plan) {
            return response()->json(["error" => "the organization user $organization_user_id has no payment plan"], 404);
        }
        
        \Log::debug("will delete the payment plan of " . $organization_user_id);
        $payment_plan->delete();
    }
}
