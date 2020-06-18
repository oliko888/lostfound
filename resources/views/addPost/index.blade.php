
@extends('layouts.main')

@section('content')
	<div class="form-wrap" style="margin-top: -30px;">

		<p style="color: green;">{{ $success ?? '' }}</p>

		@error('fileUpload')
			<p class="file-upload-error">{{ $message }}</p>
		@enderror

		<form method="post" action="{{ route('storePost') }}" enctype="multipart/form-data">
			<div class="row gtr-uniform">

				<!-- Break -->
				<div class="col-12">
					<input class="@error('itemName') input-error @enderror" type="text" name="itemName" placeholder="{{ __('Eseme nimetus') }}" value="{{ old('itemName') }}" autocomplete="off"/>
				</div>
				
				<!-- Break -->
				<div class="col-12">
					<select class="@error('category') input-error @enderror" name="category" id="demo-category">
						<option selected disabled>{{ __('Kategooria') }}</option>

						@foreach ($categories as $cat)
							<option {{ old('category') == $cat->id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
						@endforeach

					</select>
				</div>
				
				<!-- Break -->
				<div class="col-6">
					<input type="radio" id="demo-priority-low" name="role" value="1" checked>
					<label for="demo-priority-low" id="found">{{ __('Leidja') }}</label>
				</div>
				<div class="col-6">
					<input type="radio" id="demo-priority-normal" name="role" value="2" {{ old('role') == 2 ? 'checked' : '' }}>
					<label for="demo-priority-normal" id="lost">{{ __('Kaotaja') }}</label>
				</div>
				
				<!-- Break -->
				<div class="actions fit small">
					<p class="button fit upload" id="uploadFileBtn">{{ __('Laadi pilt') }}</p>
					<input style="display: none;" type="file" id="fileUpload" name="fileUpload">
				</div>
				
				<!-- Break -->
				<div class="col-12">
					<textarea name="description" id="demo-message" placeholder="{{ __('Eseme kirjeldus') }}" rows="3">{{ old('description') }}</textarea>
				</div>
				
				@csrf
				
				<!-- Break -->
				<div class="col-12" id="location">
					<select class="@error('location') input-error @enderror" name="location">
						<option selected disabled>{{ __('Kogumispunkt') }}</option>
						@foreach ($locations as $loc)
							<option {{ old('location') == $loc->id ? 'selected' : '' }} value="{{ $loc->id }}">{{ $loc->name }}</option>
						@endforeach
					</select>
				</div>

				<!-- Break -->
				<div class="col-12" id="email" style="display: none;">
					<input class="@error('email') input-error @enderror" type="email" name="email" placeholder="{{ __('E-mail') }}" value="{{ old('email') }}"/>
				</div>

				<!-- Break -->
				<div class="col-12">
					<ul class="actions">
						<li><input type="submit" value="{{ __('Saada') }}" class="primary" name="savePost" /></li>
					</ul>
				</div>

			</div>
		</form>
	</div>

<script>
    document.getElementById('uploadFileBtn').addEventListener('click', function(){document.getElementById('fileUpload').click()});
    document.getElementById('lost').addEventListener('click', function(){
		document.getElementById('email').style.display = "block";
		document.getElementById('location').style.display = "none";
		});
    document.getElementById('found').addEventListener('click', function(){
		document.getElementById('email').style.display = "none";
		document.getElementById('location').style.display = "block";
		});

	//Radio button checker
	if(document.getElementById('demo-priority-normal').checked) {
		document.getElementById('email').style.display = "block";
		document.getElementById('location').style.display = "none";
	}

    //Fileupload button text
    document.getElementById("fileUpload").onchange = function(){
      document.getElementById("uploadFileBtn").textContent = this.files[0].name;
    }
</script>
@endsection