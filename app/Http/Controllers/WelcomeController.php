<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class WelcomeController extends Controller{
    /*
     * Display the welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        //$giacomo = Customer::find(5519);
        $categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];
        return view('welcome')->with('categories', $categories);  //, compact('giacomo'));
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
