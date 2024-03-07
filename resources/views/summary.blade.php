@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Riepilogo del Ticket</h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Categoria:</strong> {{ $ticket->category->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Descrizione:</strong> {{ $ticket->description }}
                    </li>
                    @if($attachments && count($attachments) > 0)
                        <!-- Visualizzazione degli allegati -->
                        <li class="list-group-item">
                            <strong>Allegati:</strong>
                            <ul class="attachment-list">
                                @foreach($attachments as $attachment)
                                    <li>
                                        <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank" class="attachment-link">
                                            <i class="fas fa-paperclip"></i> {{ $attachment->path }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <style>
        .attachment-list {
            list-style-type: none;
            padding-left: 0;
        }

        .attachment-link {
            text-decoration: none;
            color: #007bff; /* Colore del link */
        }

        .attachment-link:hover {
            text-decoration: underline;
        }
    </style>
@endsection
