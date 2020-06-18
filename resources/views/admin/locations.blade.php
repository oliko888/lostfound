@extends('layouts.main')

@section('content')
<div class="form-wrap">
    <div class="col-12">
        <h3>Kogumispunktid:</h3>
        <div class="table-wrapper">
            <table class="alt">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nimi</th>
                        <th>L</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $loc)
                        <tr>
                            <td>{{'# '. $loc->id }}</td>
                            <td>{{ $loc->name }}</td>
                            <!-- COUNTER -->
                            <td>{{ $locations[$loop->index]->countLocFound}}</td>
                            <td style="text-align: center;">
                                <span class="edit-buttons">
                                    <form action="{{ route('locations.destroy', ['location' => $loc->id] ) }}" method="POST" style="margin: 5px; display: inline;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Oled kindel?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </span>
                                <span class="edit-buttons">
                                    <button type="button" onclick="openModal({{$loc->id}})"><i class="fas fa-edit"></i></button>
                                </span>
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
                @foreach ($locations as $loc)
                    <div id="form-modal-{{ $loc->id }}" style="display: none;" class="form-modal">
                        <div class="form-close" onclick="closeAllModals()">✖</div>
                        <form action="{{ route('locations.update', ['location' => $loc->id] ) }}" method="POST" style="margin: 5px; width: 100%;">
                            @method('PATCH')
                            @csrf
                            <h4>Praegune nimi: "{{ $loc->name }}"</h4>
                            <input name="newLocName" type="text" placeholder="Uus nimi:" style="margin-bottom: 10px;">
                            <button type="submit">Muuda</button>
                        </form>
                    </div>
                @endforeach
        </div>

        <form action="{{ route('locations.store') }}" method="post" style="margin-bottom: 60px;">
                <div class="col-12">
                    @csrf
                    <input type="text" name="newLoc" class="col-12" placeholder="Uus kogumispunkt">
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
