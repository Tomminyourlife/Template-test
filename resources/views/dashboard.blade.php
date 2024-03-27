@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Benvenuto</h1>
    @if(isset($message))
        <p class="message">{!! $message !!}</p>
    @endif
@endsection

@section('content')
    <form action="{{ route('customer.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-link"><h5>Logout</h5></button>
    </form>
@endsection

<style>
    .message {
        color: #212529; /* Colore del testo nero */
        padding: 10px; /* Spazio interno */
        font-size: 18px; /* Dimensione del testo più grande */
        border-radius: 5px; /* Bordo arrotondato */
    }
</style>