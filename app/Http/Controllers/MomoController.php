<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MomoController extends Controller
{
    private function getAccessToken()
    {
        $credentials = base64_encode(env('MOMO_USER_ID') . ':' . env('MOMO_API_KEY'));

        $response = Http::withHeaders([
            'Authorization' => "Basic {$credentials}",
            'Ocp-Apim-Subscription-Key' => env('MOMO_PRIMARY_KEY')
        ])->post("https://sandbox.momodeveloper.mtn.com/collection/token/");

        return $response->json()['access_token'];
    }

    public function pay(Request $request, Mission $mission)
    {
        $request->validate([
            "phone" => "required",
            "amount" => "required|numeric"
        ]);

        $referenceId = (string) Str::uuid();

        $token = $this->getAccessToken();

        $response = Http::withHeaders([
            "Authorization" => "Bearer {$token}",
            "X-Reference-Id" => $referenceId,
            "X-Target-Environment" => env("MOMO_ENV"),
            "Ocp-Apim-Subscription-Key" => env("MOMO_PRIMARY_KEY"),
            "Content-Type" => "application/json"
        ])->post("https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay", [
            "amount" => $request->amount,
            "currency" => "XOF",
            "externalId" => $mission->id,
            "payer" => [
                "partyIdType" => "MSISDN",
                "partyId" => $request->phone
            ],
            "payerMessage" => "Paiement mission",
            "payeeNote" => "Mission #{$mission->id}"
        ]);

        // Stocke l’ID de la transaction
        $mission->update([
            "payment_reference" => $referenceId
        ]);

        return back()->with("success", "Demande de paiement envoyée. Validez sur votre téléphone.");
    }

    public function checkStatus(Mission $mission)
    {
        $reference = $mission->payment_reference;
        $token = $this->getAccessToken();

        $response = Http::withHeaders([
            "Authorization" => "Bearer {$token}",
            "X-Target-Environment" => env("MOMO_ENV"),
            "Ocp-Apim-Subscription-Key" => env("MOMO_PRIMARY_KEY"),
        ])->get("https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay/{$reference}");

        $status = $response->json()['status'];

        if ($status == "SUCCESSFUL") {
            $mission->update(["status" => 3]); // Validée
            return back()->with("success", "Paiement validé !");
        } 
        
        if ($status == "FAILED") {
            $mission->update(["status" => 2]);
            return back()->with("error", "Paiement échoué.");
        }

        return back()->with("info", "Paiement en attente...");
    }


}
