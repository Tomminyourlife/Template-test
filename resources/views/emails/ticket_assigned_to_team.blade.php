<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assegnazione di un Ticket al Team</title>
</head>
<body>
    <h2>Assegnazione di un Ticket al Team</h2>
    <p>Salve,</p>
    <p>È stato assegnato un nuovo ticket al tuo team. Di seguito sono riportati i dettagli del ticket:</p>
    <ul>
        <li>ID Ticket: {{ $ticket->id }}</li>
        <li>Categoria: {{ $ticket->category->name }}</li>
        <li>Descrizione: {{ $ticket->description }}</li>
    </ul>
    <p>Si prega di prendere in carico questo ticket e di risolvere la richiesta del cliente al più presto possibile.</p>
    <p>Grazie,</p>
    <p>Il Team di Supporto</p>
</body>
</html>
