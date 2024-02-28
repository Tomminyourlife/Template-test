@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $ticket->title }}</h1>

        <p><strong>Descrizione:</strong> {{ $ticket->description }}</p>
        <p><strong>Priorità:</strong> {{ $ticket->priority }}</p>
        <p><strong>Stato:</strong> {{ $ticket->status }}</p>
        <p><strong>Assegnato a:</strong> {{ $ticket->assigned_to }}</p>
        <p><strong>Scadenza:</strong> {{ $ticket->due_date }}</p>

        <!-- Altri campi del ticket -->
    </div>
@endsection