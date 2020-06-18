<header class="sub-menu" style="margin-bottom: 6px;">
    <div>
        <h2 class="slash">/</h2>
        <h2 class="{{ $currentPage == 'found' ? 'active-menu-item' : '' }}"><a href="{{ route('found') }}">{{ __('Leitud asjad') }}</a></h2>
    </div>
    <div>
        <h2 class="slash">/</h2>
        <h2 class="{{ $currentPage == 'lost' ? 'active-menu-item' : '' }}"><a href="{{ route('lost') }}">{{ __('Kaotatud asjad') }}</a></h2>
    </div>
    <div>
        <h2 class="slash">/</h2>
        <h2 class="{{ $currentPage == 'auction' ? 'active-menu-item' : '' }}"><a href="{{ route('auction') }}">{{ __('Oksjon') }}</a></h2>
    </div>
    <div>
        <h2 class="slash">/</h2>
        <h2 class="{{ $currentPage == 'addPost' ? 'active-menu-item' : '' }}"><a href="{{ route('addPost') }}">{{ __('Lisa kuulutus') }}</a></h2>
        
    </div>
</header>


@if (Auth::check())
<hr style="border-top: 1px solid #ece9e9;">
    <header class="sub-menu">
        <div>
            <h2 class="slash">/</h2>
            <h2 class="{{ $currentPage == 'duePosts' ? 'active-menu-item' : '' }}"><a href="{{ route('duePosts') }}">{{ __('Aegunud kuulutused') }}</a></h2>
        </div>
        <div>
            <h2 class="slash">/</h2>
            <h2 class="{{ $currentPage == 'categories' ? 'active-menu-item' : '' }}"><a href="{{ route('categories.index') }}">{{ __('Kategooriad') }}</a></h2>
        </div>
        <div>
            <h2 class="slash">/</h2>
            <h2 class="{{ $currentPage == 'locations' ? 'active-menu-item' : '' }}"><a href="{{ route('locations.index') }}">{{ __('Kogumispunktid') }}</a></h2>
        </div>
        <div>
            <h2 class="slash">/</h2>
            <h2 class="{{ $currentPage == 'users' ? 'active-menu-item' : '' }}"><a href="{{ route('users.index') }}">{{ __('Kasutajad') }}</a></h2>
        </div>
    </header>
@endif
