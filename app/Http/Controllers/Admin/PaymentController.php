<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $sponsor = Sponsor::where('slug',$request->query('sponsor'))->first();
        //  dd($sponsor);
        $house = House::where('slug',  $request->query('house'))->first();

        session(['sponsor_id' => $sponsor->id]);
        session(['house_id' => $house->id]);

        return view('admin.payment.index', compact('sponsor', 'house'));
    }

    public function create(Request $request)
    {
        $sponsorId = session('sponsor_id');
        $houseId = session('house_id');

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

            $house = House::find($houseId);
            // dump( $request->query('house'));

            $hasAnySponsor = $house->sponsors()->exists();
            if (!$hasAnySponsor) {
                // Se non ci sono sponsor precedenti per questa casa
                $start_date = Carbon::now();
            } else {
                // Se expiration_date < della data attuale allora la data di inizio sponsor inizia ora
                if($house->sponsors()->max('expiration_date') < Carbon::now()){
                    // La data inizia ora
                    $start_date = Carbon::now();
                }else{
                    // La data inizia quando finisce il sponsor precedente
                    $latest_expiration_date = $house->sponsors()->max('expiration_date');
                    $start_date = Carbon::parse($latest_expiration_date)->addSecond(); // Aggiungi 1 secondo dopo l'ultima scadenza
                }
            }

            $sponsor = Sponsor::find($sponsorId);
            $expiration_date = $start_date->copy()->addHours($sponsor->duration);


            $house->sponsors()->attach($sponsor->id, [
                'start_date' => $start_date,
                'expiration_date' => $expiration_date,
            ]);

            return redirect()->route('admin.houses.show', compact('house'))->with('success', 'Pagamento riuscito!');
        } else {
            // Log the error details for debugging
            Log::error('Payment failed', ['errors' => $result->errors->deepAll()]);

            return back()->with('error', 'Pagamento fallito. Prova ancora.');
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
