<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseSuccessMail;
use App\Models\Purchase;
use App\services\AccessCodeService;
use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('purchase.index');
    }

    /*
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

        

        $amountUsd = $amountKes / 130;

        $purchase = Purchase::create([
            'user_id' => auth()->id(),
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
    */

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
    =========================================================
    MOCK MODE (ACTIVE NOW - bypass PayPal)
    =========================================================
    */

    $purchase = Purchase::create([
        'user_id' => auth()->id(),
        'quantity' => $quantity,
        'amount' => $amountKes,
        'status' => 'paid' // simulate instant success
    ]);

    $codes = app(AccessCodeService::class)
        ->generate($purchase);

    Mail::to($purchase->user->email)
        ->send(new PurchaseSuccessMail($purchase, $codes));

    
    return view('purchase.success', [
        'purchase' => $purchase,
        'codes' => $codes
    ]);

    /*
    =========================================================
    PAYPAL MODE (DISABLED - DO NOT DELETE)
    =========================================================

    $amountUsd = $amountKes / 130;

    $purchase = Purchase::create([
        'user_id' => auth()->id(),
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
    */
}

    public function success(
    Request $request,
    PayPalService $paypal,
    AccessCodeService $codeService
) {

    $orderId = $request->token;
    $capture = $paypal->capturePayment($orderId);
    $purchase = Purchase::where('paypal_order_id', $orderId)
        ->firstOrFail();

    /*
    Prevent duplicate generation
    */

    if ($purchase->status === 'paid') {

        return view('purchase.success', [
            'purchase' => $purchase,
            'codes' => $purchase->accessCodes
        ]);
    }

    if (($capture['status'] ?? null) === 'COMPLETED') {

        $purchase->update([
            'status' => 'paid'
        ]);

        $codes = $codeService->generate($purchase);

        //Send email
        Mail::to($purchase->user->email)
            ->send(new PurchaseSuccessMail($purchase,$codes));

        return view('purchase.success', [
            'purchase' => $purchase,
            'codes' => $codes
        ]);
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