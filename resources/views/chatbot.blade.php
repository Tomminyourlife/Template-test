@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chatbot</div>

                    <div class="card-body">
                        <!-- Mostra il contenuto della chatbot -->
                        <div id="chatbot-container">
                           <!-- Mostriamo qui la conversazione con il chatbot -->
                           <div v-for="msg in messages" :key="msg.id" class="message" :class="{ 'user-message': msg.user === 'You', 'bot-message': msg.user === 'Chatbot' }">
                                <strong>{{ msg.user }}:</strong> {{ msg.message }}
                            </div>
                        </div>

                        <!-- Form per l'input del chatbot -->
                        <form id="chat-form" action="{{ url('/chatbot') }}" method="post">
                            @csrf
                            <div class="input-group mt-3">
                                <input type="text" name="message" id="message" class="form-control" placeholder="Scrivi un messaggio...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Invia</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    new Vue({
        el: '#app',
        data: {
            messages: [],
            message: '',
        },
        methods: {
            addMessage(user, message) {
                this.messages.push({ user, message });
            },
            sendMessage() {
                // Aggiungi il messaggio dell'utente alla finestra di chat
                this.addMessage('You', this.message);

                // Invia il messaggio al server (puoi personalizzare questa parte a seconda del tuo backend)
                axios.post('/chatbot', { message: this.message })
                    .then(response => {
                        // Aggiungi la risposta del chatbot alla finestra di chat
                        this.addMessage('Chatbot', response.data);

                        // Pulisci l'input
                        this.message = '';
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
        },
    });
</script>

@endsection


