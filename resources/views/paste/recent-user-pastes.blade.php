@auth
    <div>
        <h2>Блок с последними вашими пастами:</h2>
        <ol style="list-style: decimal">
            @foreach ($pastes as $paste)
                <li>
                    <a href="{{ url($paste->uri) }}">
                        <h2>{{ $paste->title }}</h2>
                        <div>
                            {{ \Illuminate\Support\Str::limit($paste->text, 20) }}
                        </div>
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
@endauth
