@extends('adminlte::page')

@section('title', 'Ticket Comments')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <h1><b>Ticket:</b> {{ $ticket->title }}</h1>

                <div class="ticket-info mb-4">
                    <h4><b>Descrizione:</b></h4>
                    <p>{{ $ticket->description }}</p>
                </div>

        <h2 class="mb-4">Chat</h2>
            <ul class="list-group comment-list">
                @foreach ($ticket->comments as $comment)
                    <li class="list-group-item comment">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($comment->user)
                                    <strong>{{ $comment->user->name }} {{ $comment->user->cognome }} :</strong>
                                @elseif($comment->customer)
                                    <strong>{{ $comment->customer->nome }} :</strong>
                                @endif
                                <span>{{ $comment->content }}</span>
                            </div>
                            <span class="text-muted"><strong>Data:</strong> {{ $comment->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>

                <div class="add-comment mt-4">
                    <h3>Aggiungi Commento</h3>
                    <form action="{{ route('comment.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <textarea class="form-control comment-input" name="content" rows="5" placeholder="Inserisci il tuo commento qui"></textarea>
                        <button class="btn btn-primary mt-3" type="submit">Aggiungi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .card {
        background-color: #f8f9fa;
        border-color: #dee2e6; 
    }

    .list-group-item {
        background-color: #fff; 
        border-color: #dee2e6; 
    }

    .add-comment {
        background-color: #f0f0f0; 
        padding: 20px;
        border-radius: 5px;
    }

    .comment-input {
        border-color: #ccc; 
    }

    .btn-primary {
        background-color: #007bff; /* colore di sfondo del pulsante */
        border-color: #007bff; /* colore del bordo del pulsante */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* colore di sfondo del pulsante al passaggio del mouse */
        border-color: #0056b3; /* colore del bordo del pulsante al passaggio del mouse */
    }
</style>

