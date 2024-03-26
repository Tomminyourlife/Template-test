@extends('adminlte::page')

@section('title', 'Ticket List')

@section('content')
    <div class="container">
        <h1>Ticket List</h1>

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
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td><a href="{{ route('ticket.comments', $ticket->id) }}">{{ $ticket->title }}</a></td>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ $ticket->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
