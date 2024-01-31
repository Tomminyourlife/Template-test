@extends('adminlte::page')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Modifica Utente</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.update', ['id' => $user->id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                                <!-- Aggiungi altri campi se necessario -->
                                <button type="submit" class="btn btn-primary">Aggiorna Utente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
