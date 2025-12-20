<?php

namespace App\Http\Controllers;

use App\Models\FedaPayement;
use App\Models\Mission;
use App\Models\Payement;
use FedaPay\Customer;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Http\Request;

class FedaPayController extends Controller
{
    public function create(Request $request,Mission $mission)
    {
        $validation = $request->validate([
            // "amount" => "required|numeric",
            // "firstname" => "required",
            // "lastname" => "required",
            // "email" => "required|email",
            "phone" => "required|size:10",
            "network" => "required"
        ]);

        // dd($validation);

        // Configure FedaPay
        FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
        FedaPay::setEnvironment(env('FEDAPAY_ENV')); // sandbox ou live

        try {
            $transaction = Transaction::create([
                "description" => $mission->projet->titre,
                "amount" => 100,
                "currency" => ["iso" => "XOF"],
                "callback_url" => route('fedapay.callback',$mission),
                "customer" => [
                    "firstname" => $mission->user->nom,
                    "lastname" => $mission->user->prenom,
                    "email" => "ezechielcatraille@gmail.com",
                    "phone_number" => [
                        "number" => $validation['phone'],
                        "country" => "BJ"
                    ]
                ]
            ]);

            // dd($transaction);

            $token = $transaction->generateToken();

            return redirect($token->url);

        } catch (\Exception $e) {
            return back()->with('error', "Erreur API : " . $e->getMessage());
        }
    }
    
    public function callback(Request $request,Mission $mission)
    {
        try {
            // Vérifie si l'id est présent
            if (!$request->has('id')) {
                return redirect()->route('particulier.projet.index')->with('error', "ID de transaction non fourni.");
            }

            // Configure FedaPay
            FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
            FedaPay::setEnvironment(env('FEDAPAY_ENV')); // sandbox ou live

            // Récupère la transaction
            $transaction = Transaction::retrieve($request->id);
            $status = $transaction->status;
            // dd($transaction);

            $customer = Customer::retrieve($transaction->customer_id);
            // dd($customer);
            $data = [
                "numero_recu"=>$transaction->transaction_key, 
                "reference" => $transaction->reference,
                // "moyen_payement" => $transaction->payment_payment_method_id,
                "montant" => $transaction->amount,
                "status" => $transaction->status,
                "numero_payement" =>  $customer->phone_number_id, //Numéro de celui qui a initié le payement
                "date" => $transaction->created_at,
                'user_id'=>$mission->user->id,
                'mission_id'=>$mission->id
            ];

            // Redirection avec un flash message
            if ($status === 'approved') {
                // $mission->update(["status"=>3]); // 3 pour validé
                $payement = FedaPayement::create($data);
                return redirect()->route('particulier.projet.index')->with('succes', "Paiement réussi !");
            } else {
                $mission->update(["status"=>2]); // 2 pour échec
                // $mission->save();
                return redirect()->back()->with('error', "Échec du paiement. Statut : $status");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Erreur : " . $e->getMessage());
        }
    }
}
