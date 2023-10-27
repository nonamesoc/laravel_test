@extends('main')

@section('content')
    <div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label>
                <input type="email" name="email" placeholder="Email" required />
            </label>
            @error('email')
                <span><strong>{{ $message }}</strong></span>
            @enderror
            <label>
                <input type="text" name="name" placeholder="Логин" required />
            </label>
            @error('name')
                <span><strong>{{ $message }}</strong></span>
            @enderror
            <label>
                <input type="password" name="password" placeholder="Пароль" required />
            </label>
            @error('password')
                <span><strong>{{ $message }}</strong></span>
            @enderror

            <button type="submit" >Зарегистрироваться</button>
        </form>
    </div>
    <a href="{{ route('login') }}">Уже зарегистированы?</a>
@endsection
