@extends('template')

@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" v-if="step == 1">
                <h1>輸入地址</h1>
                <hr>

                <form>
                <input type="text" name="location" style="margin: 20px 0;" class="form-control" placeholder="輸入地址" required v-model="userInput" >
                <button class="btn btn-primary" style="weight:100%;" v-on:click.prevent="getWeather" v-show="userInput">查詢天氣</button>
                </form>
            </div>
            <div class="col-md-6 col-md-offset-3" v-if="step == 2">
                <h1>@{{ googleAddress.formatted }}</h1>
                <hr>

                <ul>
                    <li>Lat: @{{ googleAddress.lat }}</li>
                    <li>Lat: @{{ googleAddress.lng }}</li>
                </ul>

                <p>
                    @{{ darksky.summary }}
                </p>

                <ul>
                    <li>溫度(華氏)： @{{ darksky.temp }}</li>
                    <li>體感溫度(華氏)： @{{ darksky.feelsLikeTemp }}</li>
                    <li>風速：@{{ darksky.windSpeed }}</li>
                </ul>
                
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
<script>

const app = new Vue({
    el: '#app',
    data: {
        step: 1,
        userInput: '',
        googleAddress: {
            formatted: '',
            lat: '',
            lng: ''
        },
        darksky: {
            summary: '',
            temp: '',
            feelsLikeTemp: '',
            windSpeed: ''
        }
    },
    methods: {
        getWeather: function() {
            this.step = 2;
            let vm = this;
            axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                params: {
                    address: vm.userInput
                }
            }).then((res) => {
                let result = res.data.results[0];
                vm.googleAddress.formatted = result.formatted_address;
                vm.googleAddress.lat = result.geometry.location.lat;
                vm.googleAddress.lng = result.geometry.location.lng;

                const darkskyApi = '{{ env('DARKSKY_API') }}';
                const corsAnywhere = 'https://cors-anywhere.herokuapp.com/';
                const url = `${corsAnywhere}https://api.darksky.net/forecast/${darkskyApi}/${result.geometry.location.lat},${result.geometry.location.lng}`;

                return axios.get(url);
            }).then((res) => {
                let result2 = res.data;
                vm.darksky.summary = result2.hourly.summary;
                vm.darksky.temp = result2.currently.temperature;
                vm.darksky.feelsLikeTemp = result2.currently.apparentTemperature;
                vm.darksky.windSpeed = result2.currently.windSpeed;
            })
        }
    }
});

</script>
@endsection