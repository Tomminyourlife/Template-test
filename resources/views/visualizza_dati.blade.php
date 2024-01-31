@extends('adminlte::page')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Visualizza Dati</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Età</th>
                                        <th>Numero Domicilio</th>
                                        <!-- Aggiungi altri campi se necessario -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{ $record->id }}</td>
                                            <td>{{ $record->campo1 }}</td>
                                            <td>{{ $record->campo2 }}</td>
                                            <!-- Aggiungi altri campi se necessario -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
