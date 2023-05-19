@extends(backpack_view('blank'))

@section('content')
    <div class="container h-100 w-100 bg-light" id="container">
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-outline-primary" id="fullscreen-button"><i class="la la-expand"></i> </button>
        </div>
        <div class="row">
            <div class="col-3">
{{--                <h3>Family Reunification Visa</h3>--}}
                @foreach($queued_items as $item)
                    @if($item->visa_type_id == \App\Models\VisaType::$FAMILY_REUNIFICATION)
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <div class="card-text">
                                    <h2>{{ get_visa_type_code($item->visa_type_id) }} - {{ $item->number }}</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-6">
                <div class="row">
                    @foreach($counters as $counter)
                    <div class="col-4">
                        <div class="card bg-primary text-white">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>{{ $counter->name }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-text">

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="col-3">
{{--                <h3>Humanitarian Visa</h3>--}}
                @foreach($queued_items as $item)
                    @if($item->visa_type_id == \App\Models\VisaType::$HUMANITARIAN)
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <div class="card-text">
                                    <h2>{{ get_visa_type_code($item->visa_type_id) }} - {{ $item->number }}</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        // jQuery Document Ready

        let container = document.getElementById('container');
        let reloadInterval = {{ $reload_interval }};
        let toggleFullscreenButton = $("#fullscreen-button");
        let toggleFullscreen = () => {
            if(!isFullScreen) {
                if (container.requestFullscreen) {
                    container.requestFullscreen();
                } else if (container.mozRequestFullScreen) { /* Firefox */
                    container.mozRequestFullScreen();
                } else if (container.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                    container.webkitRequestFullscreen();
                } else if (container.msRequestFullscreen) { /* IE/Edge */
                    container.msRequestFullscreen();
                }
                isFullScreen = true;
            }else{
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { /* Firefox */
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { /* IE/Edge */
                    document.msExitFullscreen();
                }
                isFullScreen = false;
            }
            console.log(isFullScreen)
        }
        toggleFullscreenButton.on('click', toggleFullscreen);
        let isFullScreen = false;
        let init = () => {
            window.location.reload();
            toggleFullscreen();
        };

        $(document).ready(() => {
            setTimeout(() => {
                init();
            }, reloadInterval );
        });
    </script>
@endsection
