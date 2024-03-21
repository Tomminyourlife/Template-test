@extends('adminlte::page')

@section('title', 'Dettaglio Ticket')

@section('content_header')
    <h1>Dettaglio Ticket</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <h2>{{ $ticket->title }}</h2>
            <p>{{ $ticket->description }}</p>
            <div class="ticket-status">
                <h3>Stato: <span class="badge badge-{{ $ticket->status === 'Aperto' ? 'success' : ($ticket->status === 'In Lavorazione' ? 'warning' : 'danger') }}">{{ $ticket->status }}</span></h3>
                <form action="{{ route('tickets.update', $ticket->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="Aperto" class="btn btn-success">Aperto</button>
                    <button type="submit" name="status" value="In Lavorazione" class="btn btn-warning">In lavorazione</button>
                    <button type="submit" name="status" value="Chiuso" class="btn btn-danger">Chiuso</button>
                </form>
            </div>
            <hr>
            <div class="ticket-comments">
                <h3>Commenti</h3>
                <ul>
                    @foreach($ticket->comments as $comment)
                        <strong>{{ $comment->user->name }} {{ $comment->user->cognome }}:</strong> {{ $comment->content }}
                    @endforeach
                </ul>
            </div>
            <hr>
            <div class="add-comment">
                <h3>Aggiungi Commento</h3>
                <form action="{{ route('tickets.addComment', $ticket->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3" placeholder="Inserisci il commento"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiungi Commento</button>
                </form>
            </div>
        </div>
    </div>
@stop


<style scoped>
        /* Stile per le badge */
    .badge-success {
        background-color: #28a745;
    }

    .badge-warning {
        background-color: yellow;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    /* Stile per i pulsanti */
    .btn-success, .btn-primary, .btn-danger {
        margin-right: 5px;
    }

    /* Stile per i commenti */
    .ticket-comments ul {
        list-style-type: none;
        padding-left: 0;
    }

    .ticket-comments li {
        margin-bottom: 10px;
        padding-left: 10px;
        border-left: 3px solid #007bff; /* Colore bordo commento */
    }

    /* Stile per il form di aggiunta commento */
    .add-comment textarea {
        resize: vertical; /* Permette la ridimensionamento verticale */
    }
</style>