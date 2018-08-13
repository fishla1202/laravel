@extends('template')
@section('content')
<div class="container">
    <h1>{{ $question->title }}</h1>
    <p class="lead">
        {{ $question->description }}
    </p>
    <p>
        {{-- diffForhumans 設定時間格式 --}}
        由：{{ $question->user->name }} 在 {{ $question->created_at->diffForHumans() }} 提交
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
                    <h6>由 {{ $answer->user->name }} 在 {{ $answer->created_at->diffForHumans() }} 提交</h6>
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