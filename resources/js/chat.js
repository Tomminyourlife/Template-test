new Vue({
    el: '#app',
    data: {
        chatInput: '',
        chatHistory: []
    },
    methods: {
        sendMessage: function () {
            // Verifica che il messaggio dell'utente non sia vuoto
            if (this.chatInput.trim() !== '') {
                // Aggiungi il messaggio dell'utente alla cronologia della chat
                this.chatHistory.push({ text: this.chatInput, sender: 'user' });

                // Ottieni la risposta del bot (da sostituire con la tua logica)
                var botResponse = this.getBotResponse(this.chatInput);

                // Aggiungi la risposta del bot alla cronologia della chat
                this.chatHistory.push({ text: botResponse, sender: 'bot' });

                // Pulisci l'input della chat
                this.chatInput = '';
            }
        },
        getBotResponse: function (userMessage) {
            // Implementa la logica del bot qui (puoi inviare richieste AJAX al server, ad esempio)
            // Restituisci una risposta fittizia per ora
            return "Grazie per il tuo messaggio!";
        }
    }
});
