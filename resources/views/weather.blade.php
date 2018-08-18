@extends('template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>輸入地址</h1>
                <hr>

                <form action="{{ route('weather') }}" method="post">
                @csrf

                <input type="text" name="location" style="margin: 20px 0;" class="form-control" placeholder="輸入地址" required>
                <input type="submit" value="查詢天氣" class="btn btn-primary" style="weight:100%;">
                
                </form>
            </div>
        </div>
    </div>

    
@endsection