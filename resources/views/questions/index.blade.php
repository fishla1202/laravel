@extends('template')

@section('content')
    <div class="container">
        <h1>問題：</h1>
        <hr>

    @foreach ($questions as $question)
        <div class="well">
            <h3>{{ $question->id }}.{{ $question->title }}</h3>
            <p>
                {{ $question->description }}
            </p>
            <a href="{{ route('questions.show', $question->id) }}" class= "btn btn-primary btn-sm">詳細資訊</a>
        </div>
    @endforeach
    {{ $questions->links() }}
    </div>
@endsection