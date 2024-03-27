@extends('adminlte::page')

@section('title', 'Lista dei Ticket')

@section('content_header')
    <h1>Elenco dei Ticket</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-folder-open"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Aperti</span>
                            <span class="info-box-number">{{ $statusCounts['Aperto'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Chiusi</span>
                            <span class="info-box-number">{{ $statusCounts['Chiuso'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-cogs"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">In Lavorazione</span>
                            <span class="info-box-number">{{ $statusCounts['In Lavorazione'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                @foreach($titleCounts as $title => $count)
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-gray"><i class="fa fa-file"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ $title }}</span>
                                <span class="info-box-number">{{ $count }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID ticket</th>
                        <th>Cliente</th>
                        <th>Titolo</th>
                        <th>Stato</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->customer->nome }}</td>
                            <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->title }}</a></td>
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

