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
                                <div v-for="message in chatHistory" :class="message.sender + '-message'" v-html="message.text">@{{ message.text }}</div>
                            </div>
                            <div v-if="isVatValid">
                            @foreach($categories as $cat)
                                <button @click="selectCategory('{{ $cat }}')">{{ $cat }}</button>
                            @endforeach
                            </div>
                            <div v-if="selectedCategory">
                                <p>Hai selezionato la categoria: @{{ selectedCategory }}</p>
                                <p v-if="categorySaved">Categoria salvata con successo!</p>
                                <p v-if="ticketCreated"><b>Ticket creato con successo!</b></p>
                            </div>
                            <div id="chat-input-container">
                                <input type="text" v-model="chatInput" @keyup.enter="sendMessage" placeholder="Inserisci un messaggio...">
                                <button @click="sendMessage">Invia</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
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
