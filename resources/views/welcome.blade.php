@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Benvenuto</h3></div>

                    <div class="card-body">
                        <div id="chat-container">
                            <div id="chat-header"><h5>Ciao!</h5></div>
                            <div id="chat-messages">
                                <!-- Loop per mostrare i messaggi della chat -->
                                <div v-for="message in chatHistory" :class="message.sender + '-message'">@{{ message.text }}</div>
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

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection


