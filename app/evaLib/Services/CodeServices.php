<?php

namespace App\evaLib\Services;
use App\DiscountCode;

class CodeServices 
{
    /**
     * 
     */
    public static function exchangeCode($data)
    {   
        $code = DiscountCode::where('event_id', $data['event_id'])->where("code" , $data['code'])->first();

        if($code){
           
            $group = $code->discount_code_template;
            if($code->number_uses < $group->use_limit  ){
                $code->number_uses =$code->number_uses + 1; 
                $code->save();
                return "Código canjeado";
            }
            
            return abort(403 , 'El código ya se usó');
        }
        
        return abort(404 , 'El código no existe');
    }
}