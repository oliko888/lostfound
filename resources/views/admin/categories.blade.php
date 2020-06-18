@extends('layouts.main')

@section('content')
<div class="form-wrap">
    <div class="col-12 col-12-medium">
        <h3>{{ __('Kategooriad:') }}</h3>
        <div class="table-wrapper">
            <table class="alt">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Nimi') }}</th>
                        <th>{{ __('A') }}</th>
                        <th>{{ __('K') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $cat)
                        <tr>
                            <td>{{'# '. $cat->id }}</td>
                            <td>{{ $cat->name }}</td>
                            <!-- COUNTER -->
                            <td>{{ $categories[$loop->index]->countFound}}</td>
                            <td>{{ $categories[$loop->index]->countLost}}</td>
                            <td style="text-align: center;">
                                <span class="edit-buttons">
                                    <form action="{{ route('categories.destroy', ['category' => $cat->id] ) }}" method="POST" style="margin: 5px; display: inline;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Oled kindel? Kategooria kustutamisel pole ÜKSKI selle kategooria postitus enam kategooriate alt leitav!')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </span>
                                <span class="edit-buttons">
                                    <button type="button" onclick="openModal({{$cat->id}})"><i class="fas fa-edit"></i></button>
                                </span>
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
                @foreach ($categories as $cat)
                    <div id="form-modal-{{ $cat->id }}" style="display: none;" class="form-modal">
                        <div class="form-close" onclick="closeAllModals()">✖</div>
                        <form action="{{ route('categories.update', ['category' => $cat->id] ) }}" method="POST" style="margin: 5px; width: 100%;">
                            @method('PATCH')
                            @csrf
                            <h4>Praegune nimi: "{{ $cat->name }}"</h4>
                            <input name="newCatName" type="text" placeholder="Uus nimi:" style="margin-bottom: 10px;">
                            <button type="submit">Muuda</button>
                        </form>
                    </div>
                @endforeach
        </div>

        <form action="{{ route('categories.store') }}" method="post" style="margin-bottom: 60px;">
                <div class="col-12">
                    @csrf
                    <input type="text" name="newCat" class="col-12" placeholder="Uus kategooria">
                    <input type="submit" value="{{ __('Lisa uus') }}" style="float: left; margin-top: 10px;">
                </div>
        </form>
    </div>
</div>

<script>
    var allForms = document.getElementsByClassName('form-modal');
    function openModal(id) {
        var modalId = 'form-modal-' + id;
        if(document.getElementById(modalId).style.display == "flex") {
            document.getElementById(modalId).style.display = "none";
        } else {
            for (let i = 0; i < allForms.length; i++) {
                allForms[i].style.display = "none";
            }
            document.getElementById(modalId).style.display = "flex";
        }
    }
    function closeAllModals() {
        for (let i = 0; i < allForms.length; i++) {
            allForms[i].style.display = "none";
        }
    }
</script>
@endsection
