<section id="search" class="alt">
    <form method="get" action="{{ route('lost') }}" class="search-form-found" id="search-form">
        <input wire:model="searchLost" type="text" name="search" id="search" class="search-input" placeholder="O{{ __('Otsing') }}" autocomplete="off" />
        <div class="submit-search" id="submit-search"></div>
        <div wire:loading class="sk-chase" id="spinner1" style="display: none;">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </form>
    @if (strlen($searchLost) >= 2)
        <ul class="search-dropdown">
            @if ($searchResultsLost->count() > 0)
                @foreach ($searchResultsLost as $searchItem)
                    @if ($loop->iteration < 11)
                        <li class="search-dropdown-item">
                            <a href="{{ route('lost', ['search' => $searchItem->id]) }}">
                            {{--  @if ($searchItem->image != "1.jpg")
                                    <img class="search-dropdown-item-image" src="images/250x250/{{ $searchItem->image }}" alt="Item image">
                                @endif --}}
                                <div class="search-dropdown-item-grid">
                                    <div class="search-dropdown-item-id">{{ '#'. $searchItem->id }}</div>
                                    <div class="search-dropdown-item-name">{{ $searchItem->name }}</div>
                                </div>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                <ul class="search-dropdown">
                    <li class="no-results">{{ __('Tulemusi ei leitud') }}</li>
                </ul>
            @endif
        </ul>
    @endif
</section>
<script>
    var form = document.getElementById("search-form");

        document.getElementById("submit-search").addEventListener("click", function () {
            form.submit();
    });
</script>
