@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Benvenuto</div>

                    <div class="card-body">
                        <div id="chat-container">
                            <div id="chat-header">ChatBot</div>
                            <div id="chat-messages"></div>
                            <div id="chat-input-container">
                                <input type="text" id="user-input" placeholder="Inserisci un messaggio...">
                                <button id="send-button" onclick="sendMessage()">Invia</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendMessage() {
            // Aggiungi qui la logica per inviare messaggi al chatbot
            var userInput = document.getElementById('user-input').value;
            var chatMessages = document.getElementById('chat-messages');

            // Aggiungi il messaggio dell'utente
            chatMessages.innerHTML += '<div class="user-message">' + userInput + '</div>';

            // Aggiungi qui la logica per la risposta del chatbot
            // ...

            // Pulisci l'input dell'utente
            document.getElementById('user-input').value = '';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <!-- Contenitore della tua app Vue -->
    <div id="app">
        <!-- Visualizza la cronologia della chat -->
        <div v-for="message in chatHistory" :class="message.sender + '-message'">{{ message.text }}</div>

        <!-- Input della chat e pulsante di invio -->
        <input v-model="chatInput" @keyup.enter="sendMessage" placeholder="Scrivi un messaggio..." />
        <button @click="sendMessage">Invia</button>
    </div>
    
    <script src="resources/js/chat.js"></script>

@endsection

