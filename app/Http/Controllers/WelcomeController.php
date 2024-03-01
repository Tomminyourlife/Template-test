<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
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

    public function index(){

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
        ]);
    }

    public function __construct(){
    $this->isVatValid = false;
    $this->addBotMessage("Inserisci la tua partita IVA");
    }

    /*public function isVatNumber($input){
        return preg_match('/^\d{11}$/', $input);
    }*/

    /*public function getBotResponse($userInput){
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
    }*/

    public function addBotMessage($message){
        $this->chatHistory[] = ['sender' => 'Bot', 'text' => $message];
    }

    public function sendMessage(Request $request){
        $chatHistory = [];
        $categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];
        $isVatValid = false;
        $selectedCategory = '';
        $message = $request->input('chatInput');

        $pi = $message;
        // Aggiorna la chat history
        $chatHistory[] = ['sender' => 'Utente', 'text' => $message];
        $isVatValid = false;
        if (strlen($pi) === 11) {
            
            $isVatValid = true; 

            if ($isVatValid) {
                // Ottieni il nome associato alla partita IVA dal database
                $customer = Customer::where('pi', $pi)->first();

                if ($customer) {
                    $botResponse = "Benvenuto " . $customer->nome . "! Come posso aiutarti?";
                } else {
                    $isVatValid = false;
                    $botResponse = "Partita IVA valida, ma nessun cliente trovato.";
                }
            } else {
                $botResponse = "Mi dispiace, la partita IVA non è valida. Per favore, fornisci una partita IVA corretta.";
            }
        } else {
            $botResponse = "La partita IVA deve essere composta da 11 cifre. Per favore, inserisci una partita IVA corretta.";
        }

        // Aggiorna la chat history con la risposta del bot
        $chatHistory[] = ['sender' => 'Bot', 'text' => $botResponse];


        // Ritorna alla vista con la chat history aggiornata
        return view('welcome')->with(['chatHistory' => $chatHistory, 'isVatValid' => $isVatValid, 'selectedCategory' => $selectedCategory, 'categories' => $categories,]);
    }


    /*public function getNextBotMessage($previousBotResponse){
        if (strpos($previousBotResponse, 'Ciao') !== false && strpos($previousBotResponse, 'Di cosa ha bisogno?') !== false) {
            // Se l'utente è riconosciuto, mostra il form per la scelta della categoria del ticket
            $this->isCategoryFormVisible = true;
            error_log('isCategoryFormVisible: ' . $this->isCategoryFormVisible);

            // Invia un messaggio per chiedere la categoria del ticket
            $formMessage = "Per favore, seleziona la categoria del ticket:";
            $this->addBotMessage($formMessage);
        }

        return null; // Nessun messaggio successivo da inviare
    }*/

    /*public function selectCategory($category){
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
    }*/

    public function saveCategory(Request $request){
        $request->validate([
            'selectedCategory' => 'required',
            'description' => 'required',
        ]);
    
        // Ottenere i dati dal form
        $selectedCategory = $request->input('selectedCategory');
        $description = $request->input('description');
    
        // Salvare i dati nel database utilizzando il tuo modello
        Category::create([                       // mettere $category = ... per collegare ticket alla categoria
            'name' => $selectedCategory,
            'description' => $description,
            // Altri campi del tuo modello, se presenti
        ]);

        // Trovare il team associato alla categoria (potrebbe essere implementato diversamente a seconda delle tue esigenze)
        //$team = Team::where('name', 'like', "%$selectedCategory%")->first();

        /*Ticket::create([
            'category_id' => $category->id,   
            'description' => $description,
            // Altri campi del tuo modello Ticket, se presenti
        ]);*/

        return redirect()->back()->with('success', 'Dati salvati con successo!');
    }
}
