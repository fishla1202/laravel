@extends('template')
@section('content')
<div class="container">
    <h1>{{ $question->title }}</h1>
    <p class="lead">
        {{ $question->description }}
    </p>
    <hr>
    {{-- display answer --}}
    @if (count($question->answers) > 0)
        @foreach ($question->answers as $answer)
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        {{ $answer->content }}
                    </p>
                </div>
            </div>
        @endforeach
    @else
        <p>
            目前無答案
        </p>
        
    @endif
    <hr>
    {{-- display form for submit answer --}}
    
    <form action="{{ route('answers.store') }}" method="post">
        {{ csrf_field() }}
    
        <h4>提交你的答案：</h4>
        <textarea class="form-control" name="content" rows="4"></textarea>
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        <button class="btn btn-primary">提交</button>
    </form>
</div>
@endsection