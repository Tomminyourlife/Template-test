@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2>Chatbot</h2>

        <div id="chat-container">
            Partita IVA
            <strong>{{ message.sender }}:</strong> {{ message.text }}
        </div>

        <!-- Risposta del cliente -->
        <div class="input-group mb-3">
            <input type="text" id="userInput" class="form-control" placeholder="Inserisci la tua risposta">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="sendUserResponse()">Invia</button>
            </div>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       function sendUserResponse() {
          var userInput = document.getElementById('userInput').value;

          // Aggiungi il messaggio dell'utente alla chat
          appendMessage('Utente', userInput);

          // Esegui l'elaborazione del messaggio (puoi inviarlo al backend per l'elaborazione)
          processUserMessage(userInput);

          // Pulisci l'input dell'utente
          document.getElementById('userInput').value = '';
       }

       new Vue({
         el: '#chat-app',
         data: {
            chatMessages: [],
            userInput: '',
         },
         methods: {
             sendUserResponse() {
                // Logica per inviare la risposta dell'utente al server
                // ...

                // Aggiorna la chat con la risposta del bot (sostituisci con la tua logica effettiva)
                this.chatMessages.push({ sender: 'Utente', text: this.userInput });
            
                // Pulisci l'input dell'utente
                this.userInput = '';

                // Simula la risposta del bot (sostituisci con la tua logica effettiva)
                this.chatMessages.push({ sender: 'Bot', text: 'Posso avere la tua partita IVA, per favore?' });
             },
             // Altri metodi e logica...
         },
       });

    </script>
@endsection

