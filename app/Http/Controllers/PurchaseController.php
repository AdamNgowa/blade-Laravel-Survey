<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(){
        return view('purchase.index');
    }

    public function checkout(Request $request){
        $request->validate([
            'quantity'=>'required|integer|min:1|max:100'
        ]);

        $quantity = $request->quantity;

        if($quantity <= 5){
            $price = 2000;
        } elseif ($quantity <= 20){
            $price = 1500;
        } else {
            $price = 1000;
        }

        $amount =  $quantity * $price;

        // Paypal comes in here
        return redirect()->route('purchase.success',$purchase);


    }

    public function success(Purchase $purchase){
        return view('purchase.success',compact($purchase));

    }
}
