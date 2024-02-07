<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

class ChatbotController extends Controller
{
    public function handle(){
        // Configura il driver del chatbot (puoi aggiungere altri driver come Telegram, Facebook, ecc.)
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        // Configura il tuo chatbot
        $config = [
            'web' => [
                'matchingData' => [
                    'driver' => 'web',
                ],
            ],
        ];

        // Crea il BotMan
        $botman = BotManFactory::create($config);

        // Gestisci le domande e risposte
        $botman->hears('.*partita IVA.*', function (BotMan $bot) {
            $bot->reply('Posso avere la tua partita IVA, per favore?');
        });

        // Aggiungi altre interazioni e domande necessarie

        // Avvia il chatbot
        $botman->listen();
        return view('chatbot');
    }
}
