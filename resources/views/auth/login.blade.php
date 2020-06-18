@php
    $currentPage = '';
@endphp
@extends('layouts.main')

@section('content')
    <div class="register-form-wrap" style="margin-top: 30px;">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row gtr-uniform">

                <div class="col-12">
                    <input id="email" type="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="col-12">
                    <input id="password" type="password" placeholder="Parool" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="col-12">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Hoia mind meeles') }}
                    </label>
                </div>
                            
                <div class="col-12">
                    <button type="submit">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="border: none; float: right;">
                            {{ __('Unustasid parooli?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
