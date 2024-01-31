@extends('adminlte::page')

@section('content')
    <div class="container">
        <form method="post" action="/inserimento-dati">
            @csrf
            <label for="campo1">Età:</label>
            <input type="text" name="campo1" required>
            <label for="campo2">Numero Domicilio:</label>
            <input type="text" name="campo2" required>
            <!-- Aggiungi altri campi se necessario -->
            <button type="submit">Inserisci Dati</button>
            @if($record)
               <a href="{{ route('mostra-modifica', ['id' => $record->id]) }}" class="btn btn-primary">Modifica</a>
            @endif
            <a href="#" class="btn btn-danger delete-record" data-record-id="{{ $record->id }}">Elimina</a>
        </form>
    </div>
@endsection
