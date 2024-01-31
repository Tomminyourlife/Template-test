<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use Illuminate\Http\Request;
use App\Models\NomeModello; // Importa il modello


class DataController extends Controller
{
    public function mostraForm()
    {
        $record = Dato::first();
        return view('data', ['record' => $record]);
    }

    public function visualizzaDati(){
        
        $records = Dato::all(); // Recupera tutti i record dal database
        return view('visualizza_dati', compact('records'));
    }

    public function inserisciDati(Request $request)
    {
        // Validazione dei dati
        $request->validate([
            'campo1' => 'required',
            'campo2' => 'required',
            // Aggiungi altre regole di validazione
        ]);

        // Inserimento dei dati nel database
        Dato::create([
            'campo1' => $request->campo1,
            'campo2' => $request->campo2,
            // Aggiungi altri campi se necessario
        ]);

        // Redirect o altro dopo l'inserimento
        return redirect('/inserimento-dati')->with('success', 'Dati inseriti con successo!');
    }

    public function eliminaRecord($id){
    $record = Dato::find($id);

    if (!$record) {
        return redirect()->back()->with('error', 'Record non trovato.');
    }

    $record->delete();
    return redirect()->route('visualizza-dati')->with('success', 'Record eliminato con successo.');
    }

    public function mostraModifica($id){
        $record = Dato::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record non trovato.');
        }

        return view('modifica_record', compact('record'));
    }

    public function salvaModifica($id){
        $record = Dato::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record non trovato.');
        }

        // Aggiorna i campi con i nuovi valori
        $record->update([
            'campo1' => request('campo1'),
            'campo2' => request('campo2'),
            // Aggiungi altri campi se necessario
        ]);

        return redirect()->route('visualizza-dati')->with('success', 'Modifiche salvate con successo.');
    }

}
