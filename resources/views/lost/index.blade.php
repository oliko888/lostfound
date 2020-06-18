@extends('layouts.main')

@section('content')
	@if ($search)
	<div id="display-search">
		<h4>{{ 'Otsing: "'. $search. '"' }} <span id="delete-search"><a href="{{ route('lost') }}">⨯</a></span></h4>
	</div>
	@endif

	<div class="posts">
		@if ($lost->count() > 0)
			@foreach ($lost as $item)
				<article>
					<h4 class="item-id">#{{ $item->id }}</h4>
					<div style="text-align: center;">
						<img src="images/250x250/{{ $item->image }}" />
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
						<p><i class="far fa-envelope"></i>{{ $item->email }}</p>
					</div>
					<div class="trigger" data-id={{ $item->id }}></div>
					@if (Auth::check())
						<div class="post-buttons grid-2">
							<button type="button" onclick="editLostPost({{ $item->id }})"><i class="fas fa-edit"></i></button>
							<button type="button" onclick="deleteLostPost({{ $item->id }})"><i class="fas fa-trash-alt"></i></button>
							{{-- <button type="button" onclick="auctionFoundPost({{ $item->id }})"><i class="fas fa-gavel"></i></button> --}}
						</div>
					@endif
				</article>
			@endforeach
		@else
			<div id="display-search">
				<h3>Tulemusi ei leitud</h3>
			</div>
		@endif
	</div>
	<div>
		{{ $lost->withQueryString()->links() }}
	</div>
	<script src="{{ asset('js/lostAjax.js') }}" type="text/javascript" defer></script>
	<script>
	/* Post description shortener */
	let element = document.getElementsByClassName('main');
	for (let i = 0; i < element.length; i++) {
		if (element[i].innerText.length > 80) {
			element[i].innerText = element[i].innerText.slice(0, 80) + "...";
		}
	}
	</script>
@endsection
