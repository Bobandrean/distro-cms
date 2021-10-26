@extends('layout')

@section('content')
    <style type="text/css" media="screen">
        #map{
            height: 600px;
            width: 100%;
            margin: auto auto;
            border: solid 2px #0d6b7a;
            -webkit-transform: translateZ(0);
            z-index: 10;
        }

        #map-canvas {
            height: 100%;
            width: 100%;
            margin: 0px;
            padding: 0px;
            z-index: 10;
        }
    </style>

    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/penetration-map.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="my-3">
                            <div class="mapper-css" style="width:100%;">
                                <div id="map">
                                    <div id="map-canvas"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZn3leVib0hkxw9yXvGDUq_cL27Dw7WHI&libraries=places"></script>
    <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>
    <script>
        var url = {
            maps: "{{ url('/map') }}"
        }
    </script>
    <script src="{{ asset('/js/Google-Maps.js') }}"></script>
@endsection
