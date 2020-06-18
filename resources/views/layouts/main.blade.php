<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" >
		<link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>

        <title>TLÜ Lost & Found</title>
        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    </head>



	<body class="is-preload">
        <!-- Wrapper -->
        <div id="wrapper">
            <!-- Main -->
            <div id="main">
                <div class="inner">
                    
                    <!-- Header -->
                    <header id="header">
                        <img src="{{ asset('/images/logo.png') }}" alt="logo">
                        <div class='language-switch'>
                            <a href="{{  route('locale.setting', 'est') }}" ><img src="{{ asset('/images/est.jpg') }}" alt="EST"></a>
                            <a href="{{  route('locale.setting', 'en') }}" ><img src="{{ asset('/images/eng.png') }}" alt="ENG"></a>
                        </div>
                    </header>
                    @if(Auth::check())
                        <div class="admin-menu">
                            <form action="{{ route('logout') }}" method="post" style="margin-top: 20px;">
                                @csrf
                                <input type="submit" value="Logi välja">
                            </form>
                        </div>
                    @endif

                    <!-- Section -->
                    @if(Auth::check())
                        <section style="padding: 0 0 1em 0;">
                        @else
                        <section style="padding: 3em 0 1em 0;">
                    @endif
                        <x-nav-component :currentPage="$currentPage" />

                        @yield('content')

                    </section>

                    <!-- Section -->
                    <section>
                        <header class="major major-heading">
                            <h2>{{ __('Kontakt') }}</h2>
                        </header>
                        <div class="footer-wrap">
                            <p style="margin-bottom: 35px;">{{ __('Tallinna Ülikool, Narva mnt 25, 10120 Tallinn') }}</p>
                            <ul class="contact">
                                <li class="icon solid fa-envelope"><a href="mailto:tlu@tlu.ee">tlu@tlu.ee</a></li>
                                <li class="icon solid fa-phone"><a href="tel:+3726409101">+372 640 9101</a></li>
                            </ul>
                        </div>
                    </section>

                    <!-- Footer -->
                    <footer id="footer">
                        <p class="copyright">&copy;{{ date('Y') }} All rights reserved. </p>
                    </footer>

                </div>
            </div>
            <!-- Sidebar -->
            @if ($currentPage =='found' || $currentPage == 'lost')
                <x-sidebar-component :categories="$categories" :currentPage="$currentPage" />               
            @endif

        </div>

        <div id="overlay" class="overlay"></div>
        <div id="modal" class="modal">
            <p class="close-button" id="close-button">✖</p>
            <div class="show-post" id="show-post"></div>
        </div>
        <div class="small-modal" id="small-modal">
            <p class="close-button" id="close-button2">✖</p>
            <div class="show-post" id="show-post2"></div>
        </div>
			<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
			<script src="{{ asset('js/browser.min.js') }}" type="text/javascript"></script>
			<script src="{{ asset('js/breakpoints.min.js') }}" type="text/javascript"></script>
			<script src="{{ asset('js/util.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
	</body>
</html>
