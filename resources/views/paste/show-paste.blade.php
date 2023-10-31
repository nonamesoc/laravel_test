@extends('main')

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
    <script>hljs.highlightAll();</script>
@endpush

@section('content')
    <div>
        <h2>{{ $paste->title }}</h2>
        <div>
            @if ($paste->language === 'none')
                {{ $paste->text }}
            @else
                <pre><code class="language-{{ $paste->language }}">{{ $paste->text }}</code></pre>
            @endif
        </div>
    </div>
    <div><a href="{{route('complaint', ['paste_uri' => $paste->uri])}}" style="border: solid;">Пожаловаться</a></div>
@endsection
