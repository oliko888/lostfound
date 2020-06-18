@php
    $currentPage = '';
@endphp
@extends('layouts.main')

@section('content')
    <div class="register-form-wrap" style="margin-top: 30px;">
        <h3>{{ __('Taasta parool:') }}</h3>

        @if (session('status'))
            {{ session('status') }}
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="row gtr-uniform">

                <div class="col-12">
                    <input id="email" placeholder="E-mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Saada link') }}
                    </button>
                </div>
                <a href="{{ route('login') }}" style="border: none;">Mine tagasi</a>

            </div>
        </form>
    </div> 
@endsection
