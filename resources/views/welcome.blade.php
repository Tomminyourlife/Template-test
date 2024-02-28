@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2><b>Benvenuto</b></h2></div>

                    <div class="card-body">
                        <div id="chat-container">
                            <div id="chat-header"><h4>Ciao!</h4></div>
                            <div id="chat-messages">
                                <!-- Loop per mostrare i messaggi della chat -->
                                @foreach($chatHistory as $message)
                                    <div class="{{ $message['sender'] }}-message">{!! $message['text'] !!}</div>
                                @endforeach
                            </div>

                            @if($isVatValid && !$selectedCategory)
                                <form method="post" action="{{ route('save-category') }}">
                                    @csrf
                                    <label for="category">Seleziona la categoria:</label>
                                    <select name="selectedCategory" id="category" required>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}">{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label for="description">Descrizione:</label>
                                    <textarea name="description" id="description" rows="4" required></textarea>
                                    <br>
                                    <button type="submit">Invia</button>
                                </form>
                            @endif

                            @if ($selectedCategory)
                                <p>Hai selezionato la categoria: {{ $selectedCategory }}</p>
                                @if ($categorySaved)
                                    <p>Categoria salvata con successo!</p>
                                @endif
                                @if ($ticketCreated)
                                    <p><b>Ticket creato con successo!</b></p>
                                @endif
                            @endif

                            <form method="post" action="{{ route('sendMessage') }}" >
                                @csrf
                                <div id="chat-input-container">
                                    <input type="text" name="chatInput" placeholder="Inserisci un messaggio...">
                                    <button type="submit">Invia</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<style scoped>
    #chat-container {
        height: 400px;
        overflow-y: scroll;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    #chat-header {
        background-color: #8A2BE2;
        color: #fff;
        padding: 10px;
        text-align: center;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    #chat-messages {
        padding: 10px;
    }

    .user-message,
    .bot-message {
        margin: 5px;
        padding: 10px;
        border-radius: 8px;
        max-width: 70%;
        word-wrap: break-word;
    }

    .user-message {
        background-color: #f0f0f0;
        align-self: flex-end;
    }

    .bot-message {
        background-color: #8A2BE2;
        color: #fff;
    }

    #chat-input-container {
        display: flex;
        align-items: center;
        padding: 10px;
        border-top: 1px solid #ddd;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    #chat-input-container input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-right: 10px;
    }

    #chat-input-container button {
        background-color: green;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    #chat-input-container button:hover {
        background-color: green;
    }
</style>
