<?php

namespace App\services;

use App\Models\AccessCode;
use App\Models\Purchase;
use Illuminate\Support\Str;

class AccessCodeService 
{   
    // This is where we generate the codes
    public function generate(Purchase $purchase){
        $codes  =[];
        for($i = 0;$i< $purchase->quantity;$i++){
            do{
                $code = strtoupper(Str::random(10));
            } while(
                AccessCode::where('code',$code)->exists()
            );

            $accessCode  = AccessCode::create([
                'purchase_id' => $purchase->id,
                'code' => $code,
                'is_used' => false,
            ]);

            $codes[] = $accessCode;
        }
        return $codes;
    }
}