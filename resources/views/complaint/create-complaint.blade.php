@extends('main')

@section('content')
    <div>
        <h1>Жалоба на пасту {{$paste->uri}}</h1>
        <form method="POST" action="{{ route('complaint', ['paste_uri' => $paste->uri]) }}">
            @csrf
            <div>
                <label for="text">Текст</label>
                <textarea id="text" rows="5" name="text" style="width: 80%; min-width: 900px"></textarea>
            </div>
            <div>
                <button>Отправить жалобу</button>
            </div>
        </form>
    </div>
@endsection
