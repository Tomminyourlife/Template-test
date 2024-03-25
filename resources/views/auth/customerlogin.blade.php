@extends('adminlte::auth.auth-page')

@section('auth_body')
    <form action="{{ route('customer.login.submit') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" >
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
@endsection