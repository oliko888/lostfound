<!-- Sidebar -->
<div id="sidebar">
    <div class="inner">

        @if ($currentPage == 'found')
            <livewire:search-dropdown-found>
        @elseif ($currentPage == 'lost')
            <livewire:search-dropdown-lost>
        @endif
        <!-- Menu -->
        <nav id="menu">
            <header class="major major-heading">
                <h2>{{ __('Kategooriad') }}</h2>
            </header>
            <ul>
                @foreach ($categories as $cat)
                    @if ($currentPage == 'found')
                        <li><a href="{{ route('found', ['category' => $cat->id]) }}">{{ $cat->name. ' ' }}<div class="cat-count-parenthesis">(<div class="cat-count">{{ $cat->countFound }}</div>)</div></a></li>
                    @elseif ($currentPage == 'lost')
                        <li><a href="{{ route('lost', ['category' => $cat->id]) }}">{{ $cat->name. ' ' }}<div class="cat-count-parenthesis">(<div class="cat-count">{{ $cat->countLost }}</div>)</div></a></li>
                    @endif
                @endforeach
                @if ($currentPage == 'found')
                    <li><a href="{{ route('found') }}">{{ __('Kõik') }}</a></li>
                @elseif ($currentPage == 'lost')
                    <li><a href="{{ route('lost') }}">{{ __('Kõik') }}</a></li>
                @endif
            </ul>
        </nav>
        <livewire:styles>
        <livewire:scripts>
    </div>
</div>
