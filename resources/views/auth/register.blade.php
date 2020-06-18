@php
    $currentPage = '';
@endphp
@extends('layouts.main')

@section('content')
<!-- Register new user -->
<div class="register-form-wrap">
    <h3>Registreeri uus kasutaja:</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row gtr-uniform">
            <div class="col-12">
                <label for="name">{{ __('Nimi') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                        <strong>{{ $message }}</strong>
                @enderror
            </div>
            <div class="col-12">
                <label for="email">{{ __('E-posti aadress') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                        <strong>{{ $message }}</strong>
                @enderror
            </div>
            <div class="col-12">
                <label for="password">{{ __('Salasõna') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                        <strong>{{ $message }}</strong>
                @enderror
            </div>
            <div class="col-12">
                <label for="password-confirm">{{ __('Korda salasõna') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                @error('password')
                        <strong>{{ $message }}</strong>
                @enderror
            </div>

            <!-- Break -->
            <div class="col-12">
                <ul class="actions">
                    <li> <button type="submit" class="primary">{{ __('Registreeri') }}</button></li>
                    <li><input type="reset" value="{{ __('Puhasta') }}" /></li>
                </ul>
                <a href="{{ route('users.index') }}" style="border:none;float:right;">Mine tagasi</a>
            </div>
        </div>
    </form>
</div>
@endsection
