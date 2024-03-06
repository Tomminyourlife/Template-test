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
                            @if(session('success'))
                                <div class="success-message">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($isVatValid && !$selectedCategory)
                                <form id="category-form" method="post" action="{{ route('save-category') }}" enctype="multipart/form-data">
                                    @csrf
                                    <label for="category"><b>Seleziona la categoria:</b></label>
                                    <select name="selectedCategory" id="category" required>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}">{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label for="description"><b>Descrizione:</b></label>
                                    <textarea name="description" id="description" rows="4" required>{{ $description }}</textarea>
                                    <br>
                                    <label for="attachments"><b>Allegati:</b></label>
                                    <input type="file" name="attachments" multiple>
                                    <button type="submit">Crea Ticket</button>
                                </form>
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

    #category-form {
        width: 60%; /* Larghezza del form */
        margin: 0 auto; /* Centra il form nella pagina */
        font-size: 16px; 
    }

    #category-form label {
        display: block; 
        margin-bottom: 8px; 
    }

    #category-form select,
    #category-form textarea {
        width: 100%; /* Riempi l'intera larghezza del contenitore */
        padding: 8px; /* Spaziatura interna dei campi */
        margin-bottom: 16px; 
    }

    #category-form button {
        background-color: #4caf50; 
        color: white; 
        padding: 10px 15px; 
        font-size: 18px; 
        border: solid; 
        cursor: pointer; /* Cambia il cursore al passaggio del mouse sul pulsante */
    }

    #category-form button:hover {
        background-color: green; 
    }
    
    /* Stile generale del form del ticket */
    #ticket-form {
        margin-top: 20px;
        margin-left: 70px;
        margin-right: auto;
        max-width: 400px;
    }

    /* Stile del label */
    #ticket-form label {
        display: block;
        margin-bottom: 8px;
    }

    /* Stile dell'input di tipo file */
    #ticket-form input[type="file"] {
        margin-bottom: 12px;
    }

    /* Stile del bottone di invio */
    #ticket-form button {
        background-color: #4caf50;
        color: #ffffff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Hover del bottone di invio */
    #ticket-form button:hover {
        background-color: green;
    }

</style>
