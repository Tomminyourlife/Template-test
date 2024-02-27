new Vue({
    el: '#app',
    data: {
        chatHistory: [],
        chatInput: '',
        isVatValid: false,
    },
    mounted() {
        this.isVatValid= false;
        this.addBotMessage("Inserisci la tua partita IVA");
    },
    methods: {
        isVatNumber(input) {
            return /^\d{11}$/.test(input);
        },
        getBotResponse(userInput) {
            if (this.isVatNumber(userInput)) {
                // Effettua una richiesta al server per controllare la partita IVA nel database
                return axios.post('/check-vat', { vat_number: userInput })
                    .then(response => {
                        this.isVatValid= true;
                        return response.data.message; // Puoi gestire la risposta come desideri
                    })
                    .catch(error => {
                        this.isVatValid= false;
                        console.error('Errore durante il controllo della partita IVA:', error);
                    });
            } else {
                this.isVatValid= false;
                return "Mi dispiace, non sembra essere una partita IVA valida. Per favore, fornisci una partita IVA corretta.";
            }
        },
        addBotMessage(message) {
            this.chatHistory.push({ sender: 'Bot', text: message });
        },
        sendMessage() {
            if (this.chatInput.trim() !== '') {
                // Aggiungi il messaggio dell'utente alla chatHistory
                this.chatHistory.push({ sender: 'Utente', text: this.chatInput });

                // Ottieni la risposta del chatbot in base all'input dell'utente
                this.getBotResponse(this.chatInput)
                    .then(botResponse => {
                        this.addBotMessage(botResponse);

                        const nextBotMessage = this.getNextBotMessage(botResponse);
                        if (nextBotMessage) {
                            this.addBotMessage(nextBotMessage);
                        }

                    })
                    .catch(error => {
                        console.error('Errore durante la gestione della risposta del chatbot:', error);
                    });

                // Resetta il campo di input
                this.chatInput = '';
            }
        },

        getNextBotMessage(previousBotResponse) {    
            if (previousBotResponse.includes('Ciao') && previousBotResponse.includes('Di cosa ha bisogno?')) {
                // Se l'utente è riconosciuto, mostra il form per la scelta della categoria del ticket
                this.isCategoryFormVisible = true;

                // Invia un messaggio per chiedere la categoria del ticket
                const formMessage = "Per favore, seleziona la categoria del ticket:";
                this.addBotMessage(formMessage);
            }

            return null; // Nessun messaggio successivo da inviare
        },

        selectCategory(category) {
            // Nascondi il form per la scelta della categoria
            if (category) {
                this.isVatValid= false;
                console.log(category);
              }
            this.isCategoryFormVisible = false;

            // Aggiungi il messaggio della categoria selezionata alla chatHistory
            this.addBotMessage(`Hai selezionato la categoria: ${category}`);

            // Puoi fare ulteriori operazioni qui in base alla categoria selezionata
            // Ad esempio, puoi procedere con la creazione del ticket per quella categoria.

            // Chiedi ulteriori informazioni o invia ulteriori messaggi, se necessario
        },
    },
});
