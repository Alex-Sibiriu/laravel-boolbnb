<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.payment.index');
    }

    public function create(Request $request)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.env'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        $nonce = $request->input('payment_method_nonce');
        $result = $gateway->transaction()->sale([
            'amount' => '10.00',

            // abbiamo cambiato $nonce che prende il value dall'input del pagamento e lo abbiamo sostituito con "fake-valid-nonce" che serve per la moalità sviluppo
            'paymentMethodNonce' => "fake-valid-nonce",
            'options' => ['submitForSettlement' => true],
        ]);

        if ($result->success) {
            return redirect()->route('admin.payment.index')->with('success', 'Payment successful!');
        } else {
            // Log the error details for debugging
            Log::error('Payment failed', ['errors' => $result->errors->deepAll()]);

            return back()->with('error', 'Payment failed. Please try again.');
        }
    }

    public function generateClientToken()
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.env'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return response()->json(['clientToken' => $clientToken]);
    }
}
