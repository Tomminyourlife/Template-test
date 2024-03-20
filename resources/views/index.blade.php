@extends('adminlte::page')

@section('title', 'Lista dei Ticket')

@section('content_header')
    <h1>Elenco dei Ticket</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID ticket</th>
                        <th>Cliente</th>
                        <th>Titolo</th>
                        <th>Descrizione</th>
                        <th>Stato</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->customer->nome }}</td>
                            <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->title }}</a></td>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

<style>
   .table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }

    /* Stile per l'intestazione della tabella */
    .table th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
        text-align: left;
        padding: 10px;
        border-bottom: 2px solid #ddd;
    }

    /* Stile per le celle della tabella */
    .table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    /* Stile per le righe alternate della tabella */
    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Stile per i link nella tabella */
    .table a {
        color: #007bff;
        text-decoration: none;
    }

    /* Stile per i link quando vengono passati sopra */
    .table a:hover {
        text-decoration: underline;
    } 
</style>

