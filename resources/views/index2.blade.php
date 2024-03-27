@extends('adminlte::page')

@section('title', 'Elenco Ticket')

@section('content')
    <div class="container">
        <h1 class="mb-4">Elenco Ticket</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Stato</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td><a href="{{ route('ticket.comments', $ticket->id) }}" class="text-primary">{{ $ticket->title }}</a></td>
                            <td class="description-column">{{ $ticket->description }}</td>
                            <td>
                                <span class="badge badge-{{ $ticket->status === 'Aperto' ? 'success' : ($ticket->status === 'In Lavorazione' ? 'warning' : 'danger') }}">{{ $ticket->status }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


<style>
    .table th,
    .table td {
        vertical-align: middle;
    }

    .table thead th {
        text-align: center;
    }

    .table tbody td {
        vertical-align: top;
    }

    .table a {
        text-decoration: none;
    }

    .table a:hover {
        text-decoration: underline;
    }

    .description-column {
        max-width: 100px; 
        overflow-wrap: break-word; /* Fa andare a capo il testo quando raggiunge la larghezza massima */
        word-wrap: break-word;
    }
</style>


