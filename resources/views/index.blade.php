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
                        <th>ID</th>
                        <th>Titolo</th>
                        <th>Descrizione</th>
                        <th>Stato</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
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

