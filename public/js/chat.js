new Vue({
    el: '#app',
    data: {
        chatHistory: [],
        chatInput: '',
    },
    mounted() {
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
                        return response.data.message; // Puoi gestire la risposta come desideri
                    })
                    .catch(error => {
                        console.error('Errore durante il controllo della partita IVA:', error);
                    });
            } else {
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

                // Aggiungi un form per la scelta della categoria
                const categories = ['Assistenza Tecnica', 'Richieste di Rimborso', 'Altro'];
                const formOptions = categories.map(category => `<button @click="selectCategory('${category}')">${category}</button>`).join('');
                this.addBotMessage(formOptions);
            }

            return null; // Nessun messaggio successivo da inviare
        },

        selectCategory(category) {
            // Nascondi il form per la scelta della categoria
            this.isCategoryFormVisible = false;

            // Aggiungi il messaggio della categoria selezionata alla chatHistory
            this.addBotMessage(`Hai selezionato la categoria: ${category}`);

            // Puoi fare ulteriori operazioni qui in base alla categoria selezionata
            // Ad esempio, puoi procedere con la creazione del ticket per quella categoria.

            // Chiedi ulteriori informazioni o invia ulteriori messaggi, se necessario
        },
    },
});
