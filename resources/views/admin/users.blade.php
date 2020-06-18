@extends('layouts.main')

@section('content')
<!-- List of users -->
<div class="table-wrapper">
    <h3>Kõik kasutajad:</h3>
    <p style="color: red;">{{ $error ?? '' }}</p>
    <p style="color: green;">{{ $success ?? '' }}</p>
    <table class="alt">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nimi</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{'# '. $user->id }}</td>
                    <td>{{ $user->name }}{{ $user->name == $currentUser->name ? '(Teie)' : '' }}</td>
                    <td>{{ $user->email }}</td>
                    <td style="text-align: center;">
                        <span class="edit-buttons">
                            <form action="{{ route('users.destroy', ['user' => $user->id] ) }}" method="POST" style="margin: 5px; display: inline;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" onclick="return confirm('Oled kindel?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </span>
                        <span class="edit-buttons">
                            <button type="button" onclick="openModal({{$user->id}})"><i class="fas fa-edit"></i></button>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @foreach ($users as $user)
        <div id="form-modal-{{ $user->id }}" style="display: none;" class="form-modal">
            <div class="form-close" onclick="closeAllModals()">✖</div>
            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" style="margin: 5px; width: 100%;">
                @method('PATCH')
                @csrf
                <h4 style="margin-top:15px;">Kasutaja: {{ $user->name }}</h4>
                <input type="password" name="pw1" placeholder="Uus parool">
                <input type="password" name="pw2" style="margin: 15px 0;" placeholder="Korda parooli">
                <button type="submit">Muuda</button>
            </form>
        </div>
    @endforeach

    <a href="{{ route('register') }}" style="border:none;"><button>Loo uus kasutaja</button></a>
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
