@extends('template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>{{ $address->formatted_address }}</h1>
                <hr>

                <p>
                    {{ $weather->hourly->summary }}
                </p>

                <ul>
                    <li>溫度(華氏)： {{ $weather->currently->temperature }}</li>
                    <li>體感溫度(華氏)： {{ $weather->currently->apparentTemperature }}</li>
                    <li>風速： {{ $weather->currently->windSpeed }}</li>
                </ul>
                
            </div>
        </div>
    </div>

    
@endsection