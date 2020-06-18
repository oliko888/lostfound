@switch($selector)
    @case("found")
        <p><b># {{ $item->id }}</b></p>
        <div style="text-align: center;">
            <img src="images/600x400/{{ $item->image }}" alt="{{ $item->name }}" class="modal-img">
        </div>
        <p><b>{{ __('Nimetus:') }} </b>{{ $item->name }}</p>
        @php $dateTime = explode(" ", $item->created_at); @endphp
        <p><b>{{ __('Lisamise aeg:') }} </b> {{ $dateTime[0]. ', '. $dateTime[1] }}</p>
        <p><b>{{ __('E-mail:') }} </b>{{ $item->email }}</p>
        <p><b>{{ __('Kirjeldus:') }} </b>{{ $item->description }}</p>
        @break

    @case("lost")
        <p><b># {{ $item->id }}</b></p>
        <div style="text-align: center;">
            <img src="images/600x400/{{ $item->image }}" alt="{{ $item->name }}" class="modal-img">
        </div>
        <p><b>{{ __('Nimetus:') }} </b>{{ $item->name }}</p>
        @php $dateTime = explode(" ", $item->created_at); @endphp
        <p><b>{{ __('Lisamise aeg:') }} </b> {{ $dateTime[0]. ', '. $dateTime[1] }}</p>
        {{-- <p><b>{{ __('Kogumispunkt:') }} </b>{{ $locations[$item->location] }}</p> --}}
        <p><b>{{ __('Kirjeldus:') }} </b>{{ $item->description }}</p>
        @break
    
    @case("auction")
        <p><b># {{ $item->id }}</b></p>
        <div style="text-align: center;">
            <img src="images/600x400/{{ $item->image }}" alt="{{ $item->name }}" class="modal-img">
        </div>
        <p><b>{{ __('Nimetus:') }} </b>{{ $item->name }}</p>
        @php $dateTime = explode(" ", $item->created_at); @endphp
        <p><b>{{ __('Aega jäänud:') }} </b> {{ $dateTime[0]. ', '. $dateTime[1] }}</p>
        <p><b>{{ __('Kogumispunkt:') }} </b>{{ $locations[$item->location] }}</p>
        <p><b>{{ __('Kirjeldus:') }} </b>{{ $item->description }}</p>
        <p><b>{{ __('Suurim panustaja:') }} </b>{{ $item->email ? $item->email : "-"}}</p>
        <p><b>{{ __('Suurim panus:') }} </b>{{ $item->bet ? $item->bet : "0.10 €" }}</p>
        @break

    @case("editFound")
        <form method="post" action="{{ route('updateFoundPost', ['id' => $item->id]) }}" enctype="multipart/form-data">
			<div class="row gtr-uniform">
                @method('PATCH')
                @csrf

				<!-- Break -->
				<div class="col-12">
                    <input type="text" name="itemName" placeholder="{{ __('Eseme nimetus') }}" value="{{ $item->name }}" autocomplete="off"/>
				</div>
				
				<!-- Break -->
				<div class="col-12">
					<select name="category" id="demo-category">
						<option selected disabled>{{ __('Kategooria') }}</option>

						@foreach ($categories as $key=>$val)
							<option {{ $item->categories_id == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
						@endforeach

					</select>
                </div>
                
                <!-- Break -->
                <div class="col-12">
                    <div style="text-align: center; position: relative;">
                        <img src="images/600x400/{{ $item->image }}" alt="{{ $item->name }}" class="modal-img" id="edit-img">
                        <div class="modal-img-close-btn" id="imgCloseBtn">✖</div>
                    </div>
                </div>
                
				<!-- Break -->
				<div class="actions fit small">
					<p class="button fit upload" id="uploadFileBtn" style="display: none;">{{ __('Laadi pilt') }}</p>
					<input style="display: none;" type="file" id="fileUpload" name="fileUpload">
				</div>
				
				<!-- Break -->
				<div class="col-12">
					<textarea name="description" id="demo-message" placeholder="{{ __('Eseme kirjeldus') }}" rows="3">{{ $item->description }}</textarea>
				</div>
							
				<!-- Break -->
				<div class="col-12" id="location">
					<select name="location">
						<option selected disabled>{{ __('Kogumispunkt') }}</option>
						@foreach ($locations as $key=>$val)
							<option {{ $item->location == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div>

				<!-- Break -->
				<div class="col-12">
					<ul class="actions">
						<li><input type="submit" value="{{ __('Muuda') }}" class="primary" name="savePost" /></li>
					</ul>
                </div>
                <input type="hidden" id="hiddenInput" name="hiddenInput" value=1>

			</div>
        </form>
    
        @break

    @case("editLost")
        <form method="post" action="{{ route('updateLostPost', ['id' => $item->id]) }}" enctype="multipart/form-data">
			<div class="row gtr-uniform">
                @method('PATCH')
                @csrf

				<!-- Break -->
				<div class="col-12">
                    <input type="text" name="itemName" placeholder="{{ __('Eseme nimetus') }}" value="{{ $item->name }}" autocomplete="off"/>
				</div>
				
				<!-- Break -->
				<div class="col-12">
					<select name="category" id="demo-category">
						<option selected disabled>{{ __('Kategooria') }}</option>

						@foreach ($categories as $key=>$val)
							<option {{ $item->categories_id == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
						@endforeach

					</select>
                </div>
                
                <!-- Break -->
                <div class="col-12">
                    <div style="text-align: center; position: relative;">
                        <img src="images/600x400/{{ $item->image }}" alt="{{ $item->name }}" class="modal-img" id="edit-img">
                        <div class="modal-img-close-btn" id="imgCloseBtn">✖</div>
                    </div>
                </div>
                
				<!-- Break -->
				<div class="actions fit small">
					<p class="button fit upload" id="uploadFileBtn" style="display: none;">{{ __('Laadi pilt') }}</p>
					<input style="display: none;" type="file" id="fileUpload" name="fileUpload">
				</div>
				
				<!-- Break -->
				<div class="col-12">
					<textarea name="description" id="demo-message" placeholder="{{ __('Eseme kirjeldus') }}" rows="3">{{ $item->description }}</textarea>
				</div>
							
				<!-- Break -->
				{{-- <div class="col-12" id="location">
					<select name="location">
						<option selected disabled>{{ __('Kogumispunkt') }}</option>
						@foreach ($locations as $key=>$val)
							<option {{ $item->location == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div> --}}

				<!-- Break -->
				<div class="col-12">
					<ul class="actions">
						<li><input type="submit" value="{{ __('Muuda') }}" class="primary" name="savePost" /></li>
					</ul>
                </div>
                <input type="hidden" id="hiddenInput" name="hiddenInput" value=1>

			</div>
        </form>
    
        @break

    @case("auctionFound")
        <form method="post" action="{{ route('storeAuctionPost', ['id' => $item->id]) }}" enctype="multipart/form-data">
			<div class="row gtr-uniform">
                @csrf

				<!-- Break -->
				<div class="col-12">
                    <input type="text" name="itemName" placeholder="{{ __('Eseme nimetus') }}" value="{{ $item->name }}" autocomplete="off"/>
				</div>
				
				<!-- Break -->
				<div class="col-12">
					<select name="category" id="demo-category">
						<option selected disabled>{{ __('Kategooria') }}</option>

						@foreach ($categories as $key=>$val)
							<option {{ $item->categories_id == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
						@endforeach

					</select>
                </div>
                
                <!-- Break -->
                <div class="col-12">
                    <div style="text-align: center; position: relative;">
                        <img src="images/600x400/{{ $item->image }}" alt="{{ $item->name }}" class="modal-img" id="edit-img">
                        <div class="modal-img-close-btn" id="imgCloseBtn">✖</div>
                    </div>
                </div>
                
				<!-- Break -->
				<div class="actions fit small">
					<p class="button fit upload" id="uploadFileBtn" style="display: none;">{{ __('Laadi pilt') }}</p>
					<input style="display: none;" type="file" id="fileUpload" name="fileUpload">
				</div>
				
				<!-- Break -->
				<div class="col-12">
					<textarea name="description" id="demo-message" placeholder="{{ __('Eseme kirjeldus') }}" rows="3">{{ $item->description }}</textarea>
				</div>
							
				<!-- Break -->
				<div class="col-12" id="location">
					<select name="location">
						<option selected disabled>{{ __('Kogumispunkt') }}</option>
						@foreach ($locations as $key=>$val)
							<option {{ $item->location == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div>

				<!-- Break -->
				<div class="col-12">
					<ul class="actions">
						<li><input type="submit" value="{{ __('Muuda') }}" class="primary" name="savePost" /></li>
					</ul>
                </div>
                <input type="hidden" id="hiddenInput" name="hiddenInput" value=1>

			</div>
        </form>
    
        @break

    @case("deleteAuction")
        <form action="{{ route('deleteAuctionPost', ['id' => $id] ) }}" method="POST" style="margin: 5px; display: inline;">
            @method('DELETE')
            @csrf
            <h4>{{ __('Oled kindel, et soovid postitust kustutada?') }}</h4>
        <button type="submit">{{-- <i class="fas fa-trash-alt"></i> --}}KUSTUTA</button>
    </form>
        @break

    @case("deleteFound")
        <form action="{{ route('deleteFoundPost', ['id' => $id] ) }}" method="POST" style="margin: 5px; display: inline;">
            @method('DELETE')
            @csrf
            <h4>{{ __('Oled kindel, et soovid postitust kustutada?') }}</h4>
        <button type="submit">{{-- <i class="fas fa-trash-alt"></i> --}}KUSTUTA</button>
    </form>
        @break

    @case("deleteLost")
        <form action="{{ route('deleteLostPost', ['id' => $id] ) }}" method="POST" style="margin: 5px; display: inline;">
            @method('DELETE')
            @csrf
            <h4>{{ __('Oled kindel, et soovid postitust kustutada?') }}</h4>
        <button type="submit">{{-- <i class="fas fa-trash-alt"></i> --}}KUSTUTA</button>
    </form>
        @break
@endswitch