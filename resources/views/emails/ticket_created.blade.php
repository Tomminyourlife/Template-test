<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo Ticket Creato</title>
</head>
<body>
    <h2>Nuovo Ticket Creato</h2>
    <p>Gentile Cliente,</p>
    <p>È stato creato un nuovo ticket con successo. Di seguito sono riportati i dettagli del ticket:</p>
    <ul>
        <li>ID Ticket: {{ $ticket->id }}</li>
        <li>Categoria: {{ $ticket->title }}</li>
        <li>Descrizione: {{ $ticket->description }}</li>
    </ul>
    <p>Ringraziamo per la tua richiesta e ci mettiamo subito al lavoro per risolvere il problema.</p>
    <p>Grazie,</p>
    <p>Il Team di Supporto</p>
</body>
</html>
