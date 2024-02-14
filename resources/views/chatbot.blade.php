@extends('adminlte::page')

@section('content_header')
    <h1>Chatbot</h1>
@stop

@section('content')
    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Chat</div>
                        <div class="card-body">
                            <div class="chat-container">
                                <div v-for="(msg, index) in messages" :key="index" class="message">
                                    <strong>Ciao, @{{ msg.user }}:</strong> @{{ msg.text }}
                                </div>
                            </div>

                            <div class="input-container">
                                <input v-model="message" @keyup.enter="sendMessage" type="text" class="form-control" placeholder="Scrivi un messaggio...">
                                <div class="input-group-append">
                                    <button @click="sendMessage" class="btn btn-primary">Invia</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                messages: [],
                message: '',
            },
            methods: {
                addMessage(user, text) {
                    this.messages.push({ user, text });
                    this.$nextTick(() => {
                        let chatContainer = this.$el.querySelector('.chat-container');
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    });
                },
                sendMessage() {
                    this.addMessage('You', this.message);

                    axios.post("{{ route('chat.handle') }}", { message: this.message })
                        .then(response => {
                            this.addMessage('Chatbot', response.data.botResponse);
                            this.message = '';
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
            },
        });
    </script>
@stop


