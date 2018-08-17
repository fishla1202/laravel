@extends('template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>上傳個人頭貼</h1>
                <hr>

                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="file" name="picture" style="margin: 20px 0;">
                <input type="submit" value="Upload" class="btn btn-primary">
                
                </form>
            </div>
        </div>
    </div>

    
@endsection