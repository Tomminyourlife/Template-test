@extends('layouts.app')

@section('content')
    <div class="text-center">
            <!-- Aggiungi il bottone per accedere come cliente -->
            <form action="{{ route('customer.login') }}" method="get">
                <button type="submit" class="btn btn-primary">Accedi come cliente</button>
            </form>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2><b>Benvenuto! Crea qua il tuo ticket</b></h2></div>

                    <div class="card-body">
                        <div id="chat-container">
                            <div id="chat-header" ><h4><b>Ciao!</b></h4></div>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($isVatValid && !$selectedCategory && !$isEmailCompleted)
                                <form id="category-form" method="post" action="{{ route('save-category') }}" enctype="multipart/form-data" class="dropzone">
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
                                    <div id="attachments-container">
                                        <label for="attachments"><b>Allegati:</b></label>
                                        <input type="file" name="attachments[]" class="attachment-input" multiple style="display: none;">
                                    </div>
                                    <br> 
                                    <button type="button" id="add-attachment-btn">Aggiungi Allegato</button>
                                    <br><br>
                                    <button type="submit" class="btn-primary">Crea Ticket</button>
                                </form>
                            @endif

                            @if($isFormVisible)
                                <form method="post" action="{{ route('sendMessage') }}" >
                                    @csrf
                                    <div id="chat-input-container">
                                        <input type="text" name="chatInput" placeholder="Partita IVA" required>
                                        <button type="submit">Invia</button>
                                    </div>
                                </form>
                            @endif

                           @if($isVatValid && !$selectedCategory && $isEmailValid)
                                <form method="post" action="{{ route('completeEmail') }}" >
                                    @csrf
                                    <div id="complete-email-container">
                                        <label for="emailCompletion"><b>Completa l'indirizzo email:</b></label>
                                        <input type="text" name="emailCompletion" id="emailCompletion" placeholder="Inserisci soltanto le lettere mancanti" required>
                                        <button type="submit">Continua</button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addAttachmentBtn = document.getElementById('add-attachment-btn');
        const attachmentsContainer = document.getElementById('attachments-container');

        addAttachmentBtn.addEventListener('click', function () {
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'attachments[]';
            input.className = 'attachment-input';
            input.multiple = true;
            attachmentsContainer.appendChild(input);
        });
    });
</script>

<style scoped>
    #chat-container {
        height: 400px;
        overflow-y: scroll;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    #chat-header {
        background-color: #40E0D0;
        color: black;
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
        font-size: 17px;
    }

    .user-message {
        background-color: #f0f0f0;
        align-self: flex-end;
    }

    .bot-message {
        background-color: #40E0D0;
        color: black;
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
        background-color: #0000CD;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    #chat-input-container button:hover {
        background-color: #0000CD;
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

    .btn-primary {
        background-color: #0000CD; 
        color: white; 
        padding: 10px 15px; 
        font-size: 18px; 
        border: solid; 
        cursor: pointer; /* Cambia il cursore al passaggio del mouse sul pulsante */
    }

    .btn-primary:hover {
        background-color: #0000CD; 
    }
    
    #complete-email-container {
    text-align: center;
    max-width: 400px;
    margin: 0 auto;
    }

    #complete-email-container label {
        display: block;
        margin-bottom: 10px;
    }

    #emailCompletion {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #4169E1;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #4169E1;
    }
</style>
