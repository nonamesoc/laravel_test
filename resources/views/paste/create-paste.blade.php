@extends('main')

@section('content')
    <div>
        <form method="POST" action="{{ route('create-paste') }}">
            @csrf
            <div>
                <label for="title">Заголовок</label>
                <div>
                    <input id="title" type="text" name="title">
                </div>
            </div>
            <div>
                <label for="expire_date">Срок доступности пасты</label>
                <div>
                    <select id="expire_date" name="expire_date">
                        <option value="10m">10мин</option>
                        <option value="1h">1час</option>
                        <option value="3h">3часа</option>
                        <option value="1d">1день</option>
                        <option value="1m">1месяц</option>
                        <option value="n">без ограничения</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="access">Доступ</label>
                <div>
                    <select id="access" name="access">
                        <option value="public">Доступна всем</option>
                        <option value="unlisted">Только по ссылке</option>
                        <option value="private">Только автору</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="language">Язык</label>
                <div>
                    <select id="language" name="language">
                        <option value="none">-</option>
                        <option value="php">PHP</option>
                        <option value="javascript">Javascript</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="text">Паста</label>
                <textarea id="text" rows="5" name="text" style="width: 80%; min-width: 900px"></textarea>
            </div>
            <div>
                <button>Создать новую пасту</button>
            </div>
        </form>
    </div>
@endsection
