<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ContactController extends Controller
{
    // Affiche le formulaire de contact
    public function index()
    {
        return view('contact');
    }

    // Traite l'envoi du formulaire via l'API Brevo
    public function send(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        // Création du client HTTP
        $client = new Client();

        // Envoi du mail via Brevo API
        $response = $client->post('https://api.brevo.com/v3/smtp/email', [
            'headers' => [
                'api-key' => env('BREVO_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'sender' => [
                    'name' => 'Ya&Bi',
                    'email' => 'yabishop2@gmail.com'
                ],
                'to' => [
                    ['email' => 'yabishop2@gmail.com']
                ],
                'subject' => 'Nouveau message de contact',
                'htmlContent' => "
                    <p>Nom : {$request->name}</p>
                    <p>Email : {$request->email}</p>
                    <p>Message : {$request->message}</p>
                ",
            ],
        ]);

        return back()->with('success', 'Votre message a bien été envoyé via Brevo !');
    }
}
