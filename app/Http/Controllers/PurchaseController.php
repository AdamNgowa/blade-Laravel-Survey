<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Services\PayPalService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('purchase.index');
    }

    public function checkout(Request $request, PayPalService $paypal)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $quantity = $request->quantity;

        if ($quantity <= 5) {
            $price = 2000;
        } elseif ($quantity <= 20) {
            $price = 1500;
        } else {
            $price = 1000;
        }

        $amountKes = $quantity * $price;

        /*
        Temporary USD conversion
        Replace later with forex API
        */

        $amountUsd = $amountKes / 130;

        $purchase = Purchase::create([
            'user_id' => auth()->id,
            'quantity' => $quantity,
            'amount' => $amountKes,
            'status' => 'pending'
        ]);

        $paypalOrder = $paypal->createOrder($amountUsd);

        $purchase->update([
            'paypal_order_id' => $paypalOrder['id']
        ]);

        foreach ($paypalOrder['links'] as $link) {

            if ($link['rel'] === 'approve') {

                return redirect($link['href']);
            }
        }

        return back()->withErrors([
            'paypal' => 'Unable to connect to PayPal.'
        ]);
    }

    public function success(Request $request, PayPalService $paypal)
    {
        $orderId = $request->token;

        $capture = $paypal->capturePayment($orderId);

        $purchase = Purchase::where('paypal_order_id', $orderId)
            ->firstOrFail();

        if (($capture['status'] ?? null) === 'COMPLETED') {

            $purchase->update([
                'status' => 'paid'
            ]);

            /*
            NEXT:
            Generate access codes
            */

            return view('purchase.success', compact('purchase'));
        }

        $purchase->update([
            'status' => 'failed'
        ]);

        return redirect()->route('purchase.index')
            ->withErrors([
                'payment' => 'Payment failed.'
            ]);
    }

    public function cancel()
    {
        return redirect()->route('purchase.index')
            ->withErrors([
                'payment' => 'Payment cancelled.'
            ]);
    }
}