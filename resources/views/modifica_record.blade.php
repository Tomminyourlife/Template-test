<form method="post" action="{{ route('salva-modifica', ['id' => $record->id]) }}">
    @csrf
    @method('PUT')

    <label for="campo1">Campo 1</label>
    <input type="text" name="campo1" value="{{ $record->campo1 }}" required>

    <label for="campo2">Campo 2</label>
    <input type="text" name="campo2" value="{{ $record->campo2 }}" required>

    <!-- Aggiungi altri campi se necessario -->

    <button type="submit">Salva Modifiche</button>
</form>
