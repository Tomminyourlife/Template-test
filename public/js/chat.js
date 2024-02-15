new Vue({
    el: '#chat-container',
    data: {
        chatInput: '',
        chatHistory: []
    },
    methods: {
        sendMessage: function () {
            const userInput = this.chatInput;

            // Invia il messaggio al backend usando Axios
            axios.post('/', { message: userInput })
                .then(response => {
                    // Aggiorna la cronologia della chat con la risposta del chatbot
                    this.chatHistory.push({ text: response.data.message, sender: 'bot' });
                })
                .catch(error => {
                    console.error('Errore nella richiesta al backend:', error);
                });

            // Pulisci l'input della chat
            this.chatInput = '';
        },
    },
});

