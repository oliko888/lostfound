@extends('layouts.main')

@section('content')
    @if ($auction)
        <h2>Aegunud kuulutused:</h2>
        <div class="posts">
            @if ($auction->count() > 0)
                @foreach ($auction as $item)
                    <article>
                        <h4 class="item-id">#{{ $item->id }}</h4>
                        <div style="text-align: center;">
                            <img src="{{ asset('/images/250x250/'. $item->image) }}" />
                        </div>
                        <h3>{{ $item->name }}</h3>
                        <div style="height: 70px;">
                            <p class="main">{{ $item->description}}</p>
                        </div>
                        @php $dateTime = explode(" ", $item->created_at); @endphp
                        <div class="item-data-wrap">
                            <div class="item-data" style="list-style: none;">
                                <p class="post-time"><i class="far fa-clock"></i>{{ $dateTime[1] }}</p>	
                                <p><i class="far fa-calendar-alt"></i>{{ $dateTime[0] }}</p>
                            </div>
                            <p><i class="fas fa-map-marker-alt"></i>{{ $item->location }}</p>
                        </div>
                        <div class="trigger"  data-id={{ $item->id }}></div>
                        <button>{{ __('Oksjonile') }}</button>
                        <button>{{ __('Muuda') }}</button>
                        <button>{{ __('Kustuta') }}</button>
                    </article>
                @endforeach
            @else 
            <div id="display-search">
                <h3>{{ __('Tulemusi ei leitud') }}</h3>
            </div>
            @endif
        </div>
    @endif
@endsection