<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function showChat()
    {
        return view('chatbot');
    }

    public function handleChat(Request $request)
    {
        $userMessage = $request->input('message');

        // Qui puoi implementare la logica del tuo chatbot
        $botResponse = $this->getChatbotResponse($userMessage);

        return response()->json(['userMessage' => $userMessage, 'botResponse' => $botResponse]);
    }

    private function getChatbotResponse($userMessage)
    {
        // Qui implementi la logica del tuo chatbot.
        // Puoi avere un array associativo con domande e risposte.
        $responses = [
            'Ciao' => 'Ciao! Come posso aiutarti?',
            'Come stai?' => 'Sto bene, grazie!',
            'Altro' => 'Mi dispiace, non posso rispondere a questa domanda.'
            // Aggiungi altre domande e risposte secondo necessità
        ];

        // Controlla se c'è una risposta predefinita, altrimenti restituisci un messaggio di default.
        return $responses[strtolower($userMessage)] ?? 'Non ho capito. Puoi chiedere qualcos\'altro?';
    }
}


