<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller{

    public function getBotResponse(Request $request){
        $userMessage = $request->input('message');
        
        $botResponse = $this->getCustomBotResponse($userMessage);
       
        return response()->json(['message' => $botResponse]);
    }

    private function getCustomBotResponse($userMessage){
        // Implementa la tua logica di chatbot qui
        $responses = [
            'Ciao' => 'Ciao! Come posso aiutarti?',
            'Come stai?' => 'Io sono solo un chatbot, ma grazie per chiedere!',
        ];

        // Controlla se c'è una risposta predefinita per il messaggio dell'utente
        return $responses[$userMessage] ?? 'Non ho capito la tua domanda.';

    }
}
