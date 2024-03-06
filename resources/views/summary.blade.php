@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Riepilogo del Ticket</h2>
        <ul>
            <li><strong>Categoria:</strong> {{ $ticket->category->name }}</li>
            <li><strong>Descrizione:</strong> {{ $ticket->description }}</li>
            @if($attachments && count($attachments) > 0)
                <!-- Visualizzazione degli allegati -->
                <li><strong>Allegati:</strong>
                    <ul>
                        @foreach($attachments as $attachment)
                            <li><a href="{{ asset('storage/' . $attachment->path) }}" target="_blank">{{ $attachment->path }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </div>
@endsection
