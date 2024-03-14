<?php

namespace App\Http\Controllers;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\Customer;
use App\Models\CustomerEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller{
    /*
     * Display the welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public $chatHistory = [];
    public $isFormVisible = true;
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
            'isFormVisible' => $this->isFormVisible,
        ]);
    }

    public function __construct(){
        $this->isVatValid = false;
        $this->addBotMessage("Inserisci la tua Partita IVA");
    }

    public function addBotMessage($message){
        $this->chatHistory[] = ['sender' => 'Bot', 'text' => $message];
    }

    public function sendMessage(Request $request){
        $isFormVisible = true;
        $chatHistory = [];
        $categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];
        $isVatValid = false;
        $isEmailValid = false;
        $isEmailCompleted = session('isEmailCompleted', false);
        $selectedCategory = '';
        $message = $request->input('chatInput');
        $email = $request->input('emailInput');
        $description = '';

        $pi = $message;
        $chatHistory[] = ['sender' => 'Utente', 'text' => $message];
        $isVatValid = false;

        if (strlen($pi) === 11) {
            $isVatValid = true; 
            

            if ($isVatValid) {
                $customer = Customer::where('pi', $pi)->first();
                $isFormVisible = false;

                if ($customer) {
                    $customerEmail = CustomerEmail::where('customer_id', $customer->id)->first();

                    if ($customerEmail) {
                        $isEmailValid = true;
                        $prefix = substr($customerEmail->email, 0, 2);
                        $suffix = substr($customerEmail->email, -2);
                        $botResponse = "Benvenuto " . $customer->nome . "! Completa l'indirizzo email. Suggerimento: " . $prefix . "****@****" . $suffix;
                        $isEmailCompleted = true;
                        session(['customerId' => $customer->id, 'emailPrefix' => $prefix, 'emailSuffix' => $suffix, 'isEmailCompleted' => $isEmailCompleted]);
                    } else {
                        $isVatValid = false;
                        $botResponse = "Partita IVA valida, ma nessun indirizzo email trovato per questo cliente.";
                    }
                } else {
                    $isVatValid = false;
                    $isFormVisible = true;
                    $botResponse = "Partita IVA valida, ma nessun cliente trovato.";
                }
            } else {
                $botResponse = "Mi dispiace, la partita IVA non è valida. Per favore, fornisci una partita IVA corretta.";
            }
        } else {
            $botResponse = "La partita IVA deve essere composta da 11 cifre. Per favore, inserisci una partita IVA corretta.";
        }

        $chatHistory[] = ['sender' => 'Bot', 'text' => $botResponse];

        return view('welcome')->with([
            'chatHistory' => $chatHistory,
            'isVatValid' => $isVatValid,
            'isEmailValid' => $isEmailValid,
            'isEmailCompleted' => $isEmailCompleted,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories,
            'isCategoryFormVisible' => $this->isCategoryFormVisible,
            'categorySaved' => $this->categorySaved,
            'ticketCreated' => $this->ticketCreated,
            'description' => $this->description,
            'isFormVisible' => $isFormVisible,
        ]);
    }

    public function completeEmail(Request $request){
        $chatHistory = [];
        $isVatValid = false;
        $isFormVisible = true;
        $categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];

        $customerId = session('customerId');
        $emailPrefix = session('emailPrefix');
        $emailSuffix = session('emailSuffix');
    
        $emailCompletion = $request->input('emailCompletion');
        $completedEmail = $emailPrefix . $emailCompletion . $emailSuffix;

        $customerEmail = CustomerEmail::where('customer_id', $customerId)->first();
        $isEmailCompleted = session('isEmailCompleted', false);
        $selectedCategory = false;
        $isEmailValid = false; 

        if ($customerEmail && $customerEmail->email === $completedEmail) {

            $isVatValid = true;
            session(['isVatValid' => $isVatValid]);
            $isEmailCompleted = false; 
            $isFormVisible = false;

            return view('welcome')->with([
                'chatHistory' => $chatHistory,
                'isVatValid' => $isVatValid,
                'isEmailCompleted' => $isEmailCompleted,
                'selectedCategory' => $selectedCategory,
                'isEmailValid' => $isEmailValid,
                'categories' => $categories,
                'isCategoryFormVisible' => $this->isCategoryFormVisible,
                'categorySaved' => $this->categorySaved,
                'ticketCreated' => $this->ticketCreated,
                'description' => $this->description,
                'isFormVisible' => $isFormVisible,
            ]);
        } else {
            return redirect()->back()->withErrors(['emailCompletion' => 'L\'indirizzo email fornito non corrisponde a quello del cliente.']);
        }
    }
    
    public function saveCategory(Request $request){
        
        $request->validate([
            'selectedCategory' => 'required',
            'description' => 'required',
            'attachments.*' => 'mimes:jpeg,png,pdf,docx|max:2048',
        ]);

        $categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];
        $isVatValid = true;
        $selectedCategory = $request->input('selectedCategory');
        $description = $request->input('description');
        $customerId = session('customerId');

        $category = Category::create([
            'name' => $selectedCategory,
            'description' => $description,
        ]);
        
        $chatHistory = $this->chatHistory;
        $ticket = Ticket::create([
            'category_id' => $category->id,
            'description' => $description,
            'customer_id' => $customerId,
            'title' => $selectedCategory,
        ]);

         // Ottenere il team associato alla categoria
        $team = $category->teams;

        // Assegna il team al ticket
        $ticket->team()->associate($team)->save();

        if ($request->hasFile('attachments')) {
            $path = $request->file('attachments')->store('attachments', 'public');
            $ticketAttachment = new Attachment(['path' => $path]);
            $ticket->attachments()->save($ticketAttachment);
        }

        // Imposta le variabili di stato per indicare la creazione del ticket
        $this->isCategoryFormVisible = false;
        $this->categorySaved = true;
        $this->ticketCreated = true;
        $this->description = $description;

        $ticketId = $ticket->id;

        return redirect()->route('show-summary', ['ticketId' => $ticketId]);
    }

    public function showSummary($ticketId){

        $ticket = Ticket::findOrFail($ticketId);
        $attachments = $ticket->attachments()->get();
        
        return view('summary', compact('ticket', 'attachments' ));
    }
}
