@extends('main')

@section('content')
    <div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>
                <input type="text" name="name" placeholder="Логин" required />
            </label>
            <label>
                <input type="password" name="password" placeholder="Пароль" required />
            </label>
            @error('error')
                <span><strong>{{ $message }}</strong></span>
            @enderror
            <button type="submit" >Войти</button>
        </form>
    </div>
    <a href="{{ route('login.google') }}">Войти через Google</a>
@endsection
