@extends('main')

@section('content')
    <div>
        <h2>Ваши пасты</h2>
        <ul>
            @foreach ($pastes as $paste)
                <li>
                    <h2>{{ $paste->title }}</h2>
                    <div>
                        {{ \Illuminate\Support\Str::limit($paste->text, 100) }}
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $pastes->links() }}
    </div>
@endsection
