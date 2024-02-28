<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller{
    /*
     * Display the welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public $chatHistory = [];
    public $chatInput = '';
    public $isVatValid = false;
    public $selectedCategory = '';
    public $categorySaved = false;
    public $ticketCreated = false;
    public $description = '';
    public $isCategoryFormVisible = false;
    public $categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];

    public function index()
    {
        // Altri codici del metodo index...

        return view('welcome', [
            'categories' => $this->categories,
            'chatHistory' => $this->chatHistory,
            'chatInput' => $this->chatInput,
            'isVatValid' => $this->isVatValid,
            'selectedCategory' => $this->selectedCategory,
            'categorySaved' => $this->categorySaved,
            'ticketCreated' => $this->ticketCreated,
            'description' => $this->description,
            'isCategoryFormVisible' => $this->isCategoryFormVisible,
            // Altre variabili...
        ]);
    }

    public function __construct(){
    $this->isVatValid = false;
    $this->addBotMessage("Inserisci la tua partita IVA");
    }

    public function isVatNumber($input){
        return preg_match('/^\d{11}$/', $input);
    }

    public function getBotResponse($userInput){
        if ($this->isVatNumber($userInput)) {
            try {
                // Effettua una richiesta al server per controllare la partita IVA nel database
                $response = Customer::post('/check-vat', ['vat_number' => $userInput]);

                $data = json_decode($response, true);

                $this->isVatValid = true;

                return $data['message']; // Puoi gestire la risposta come desideri
            } catch (\Exception $error) {
                $this->isVatValid = false;
                error_log('Errore durante il controllo della partita IVA: ' . $error->getMessage());
            }
        } else {
            $this->isVatValid = false;
            return "Mi dispiace, non sembra essere una partita IVA valida. Per favore, fornisci una partita IVA corretta.";
        }
    }

    public function addBotMessage($message){
        $this->chatHistory[] = ['sender' => 'Bot', 'text' => $message];
    }

    public function sendMessage(){
        if (trim($this->chatInput) !== '') {
            // Aggiungi il messaggio dell'utente alla chatHistory
            $this->chatHistory[] = ['sender' => 'Utente', 'text' => $this->chatInput];

            // Ottieni la risposta del chatbot in base all'input dell'utente
            try {
                $botResponse = $this->getBotResponse($this->chatInput);

                $this->addBotMessage($botResponse);

                $nextBotMessage = $this->getNextBotMessage($botResponse);
                if ($nextBotMessage) {
                    $this->addBotMessage($nextBotMessage);
                }
            } catch (\Exception $error) {
                error_log('Errore durante la gestione della risposta del chatbot: ' . $error->getMessage());
            }

            // Resetta il campo di input
            $this->chatInput = '';
        }
    }

    public function getNextBotMessage($previousBotResponse){
    if (strpos($previousBotResponse, 'Ciao') !== false && strpos($previousBotResponse, 'Di cosa ha bisogno?') !== false) {
        // Se l'utente è riconosciuto, mostra il form per la scelta della categoria del ticket
        $this->isCategoryFormVisible = true;
        error_log('isCategoryFormVisible: ' . $this->isCategoryFormVisible);

        // Invia un messaggio per chiedere la categoria del ticket
        $formMessage = "Per favore, seleziona la categoria del ticket:";
        $this->addBotMessage($formMessage);
    }

    return null; // Nessun messaggio successivo da inviare
    }

    public function selectCategory($category)
    {
        // Nascondi il form per la scelta della categoria
        if ($category) {
            $this->isVatValid = false;
            error_log($category);
        }

        $this->isCategoryFormVisible = false;
        $this->selectedCategory = $category;

        // Invia la categoria al server (puoi usare Axios o un'altra libreria)
        try {
            $response = Http::post('/save-category', [
                'category' => $this->selectedCategory,
                'description' => $this->description,
            ]);

            error_log('Categoria salvata con successo: ' . $response['data']);
            $this->categorySaved = true;

            $ticketResponse = Http::post('/create-ticket', [
                'category' => $this->selectedCategory,
                'description' => $this->description,
            ]);

            error_log('Ticket creato con successo: ' . $ticketResponse['data']);
            $this->ticketCreated = true;
        } catch (\Exception $error) {
            error_log('Errore durante il salvataggio della categoria o la creazione del ticket: ' . $error->getMessage());
        }

        $this->addBotMessage("Hai selezionato la categoria: $category");

        // Puoi fare ulteriori operazioni qui in base alla categoria selezionata
        // Ad esempio, puoi procedere con la creazione del ticket per quella categoria.

        // Chiedi ulteriori informazioni o invia ulteriori messaggi, se necessario
    }

    public function checkVat(Request $request){
        $inputVat = $request->input('vat_number');

        // Esegui il controllo nel database
        $user = Customer::where('pi', $inputVat)->first();

        if ($user) {
            $message = "Ciao $user->nome! Di cosa ha bisogno?";
            return response()->json(['message' => $message]);
        } else {
            return response()->json(['message' => 'Siamo spiacenti, la partita IVA non è corretta o non fa parte dei nostri clienti']);
        }
    }

    public function saveCategory(Request $request){
        // Esegui il salvataggio della categoria (puoi sostituire questa logica con la tua)
        // Ad esempio, puoi salvarlo nel database o nella sessione
        $selectedCategory = $request->input('category');
        
        // Puoi fare ulteriori operazioni se necessario

        return response()->json(['message' => 'Categoria salvata con successo']);
    }
}
