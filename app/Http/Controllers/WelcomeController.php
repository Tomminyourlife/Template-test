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

    public function addBotMessage($message){
        $this->chatHistory[] = ['sender' => 'Bot', 'text' => $message];
    }

    public function sendMessage(Request $request){
        $chatHistory = [];
        $categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];
        $isVatValid = false;
        $selectedCategory = '';
        $message = $request->input('chatInput');
        $description = '';

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
        //return view('welcome')->with(['chatHistory' => $chatHistory, 'isVatValid' => $isVatValid, 'selectedCategory' => $selectedCategory, 'categories' => $categories,]);
        
        if ($isVatValid && $selectedCategory && $description) {
            // Imposta le variabili di stato per indicare la creazione del ticket
            $this->isCategoryFormVisible = false;
            $this->categorySaved = true;
            $this->ticketCreated = true;
    
            // Aggiorna la chat history con un messaggio di conferma
            $botResponse = "La categoria è stata selezionata e la descrizione è stata fornita. Ora puoi creare il ticket.";
            $chatHistory[] = ['sender' => 'Bot', 'text' => $botResponse];


        }
    
        // Ritorna alla vista con la chat history aggiornata
        return view('welcome')->with([
            'chatHistory' => $chatHistory,
            'isVatValid' => $isVatValid,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories,
            'isCategoryFormVisible' => $this->isCategoryFormVisible,
            'categorySaved' => $this->categorySaved,
            'ticketCreated' => $this->ticketCreated,
            'description' => $this->description,
        ]);
    }
    
    public function saveCategory(Request $request){
        //dd($request->all());
        $request->validate([
            'selectedCategory' => 'required',
            'description' => 'required',
        ]);
    
        // Ottenere i dati dal form
        $categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];
        $isVatValid = true;
        $selectedCategory = $request->input('selectedCategory');
        $description = $request->input('description');
    
        // Salvare i dati nel database utilizzando il tuo modello
        Category::create([                       // mettere $category = ... per collegare ticket alla categoria
            'name' => $selectedCategory,
            'description' => $description,
            // Altri campi del tuo modello, se presenti
        ]);

        $chatHistory = $this->chatHistory;

        if ($isVatValid && $selectedCategory && $description) {
            // Imposta le variabili di stato per indicare la creazione del ticket
            $this->isCategoryFormVisible = false;
            $this->categorySaved = true;
            $this->ticketCreated = true;
    
            // Aggiorna la chat history con un messaggio di conferma
            $botResponse = "La categoria è stata selezionata. Ora puoi creare il ticket aggiungendo se vuoi degli allegati.";
            $chatHistory[] = ['sender' => 'Bot', 'text' => $botResponse];
            
            $this->categorySaved = true;
            $this->ticketCreated = false;
            $this->description = $description;
        }
    
        // Aggiorna la chat history con la risposta del bot
        // Ritorna alla vista con la chat history aggiornata
        return view('welcome')->with([
            'chatHistory' => $chatHistory,
            'isVatValid' => $isVatValid,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories,
            'isCategoryFormVisible' => $this->isCategoryFormVisible,
            'categorySaved' => $this->categorySaved,
            'ticketCreated' => $this->ticketCreated,
            'description' => $this->description,
        ]);
        //return redirect()->back()->with('success', 'Dati salvati con successo!');
    }

    public function saveTicket(Request $request){
        //dd($request->all());
        $request->validate([
            'selectedCategory' => 'required',
            'description' => 'required',
            'attachments.*' => 'mimes:jpeg,png,pdf,docx|max:2048',
            // Altri campi del form per il ticket, ad esempio allegati
        ]);
        // Ottenere i dati dal form
        $selectedCategory = $request->input('selectedCategory');
        $description = $request->input('description');
        // Altri campi del form per il ticket, ad esempio allegati
        //$message = $request->input('chatInput');
        

        //$pi = $message;
        //$customer = Customer::where('pi', $pi)->first();
        // Salvare il ticket nel database utilizzando il tuo modello
        $ticket = Ticket::create([
            'category' => $selectedCategory,
            'description' => $description,
            //'user_id' => $customer->id,
            // Altri campi del tuo modello, se presenti
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                // Salva l'allegato sul disco
                $path = $attachment->store('attachments', 'public');
    
                // Crea una relazione tra il ticket e l'allegato
                $ticket->attachments()->create([
                    'path' => $path,
                    // Altri campi del modello dell'allegato, se necessario
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Ticket creato con successo!');
    }
}
