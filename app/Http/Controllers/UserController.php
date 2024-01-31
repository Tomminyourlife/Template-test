<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showSettings()
    {
        // Recupera l'elenco degli utenti
        $users = User::all();

        return view('admin_settings', compact('users'));
    }

    public function editUser($id)
    {
        // Recupera l'utente per la modifica
        $user = User::find($id);

        return view('edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Validazione dei dati e aggiornamento dell'utente
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Aggiungi altri campi se necessario
        $user->save();

        return redirect()->route('admin_settings')->with('success', 'Utente aggiornato con successo.');
    }
}
