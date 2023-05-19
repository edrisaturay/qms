@extends(backpack_view('blank'))
@php
    \Backpack\CRUD\app\Library\Widget::add()
        ->to('before_content')
        ->type('div')
        ->class('row')
        ->content([
            [
                'type'        => 'progress',
                'class'       => 'card text-white bg-primary mb-2',
                'value'       => get_today_vitem_iii_queue(),
                'description' => 'Today Queue VITEM III.',
                'progress'    => get_percentage(get_today_vitem_iii_queue(), get_today_total_queue()), // integer
//                'hint'        => '8544 more until next milestone.',
            ],
            [
                'type'        => 'progress',
                'class'       => 'card text-white bg-warning mb-2',
                'value'       => get_today_vitem_xi_queue(),
                'description' => 'Today Queue VITEM XI.',
                'progress'    => get_percentage(get_today_vitem_xi_queue(), get_today_total_queue()), // integer
//                'hint'        => '8544 more until next milestone.',
            ],
            [
                'type'        => 'progress',
                'class'       => 'card text-white bg-success mb-2',
                'value'       => get_today_completed_queue(),
                'description' => 'Today Completed.',
                'progress'    => get_percentage(get_today_completed_queue(), get_today_total_queue()), // integer
//                'hint'        => '8544 more until next milestone.',
            ],
            [
                'type'        => 'progress',
                'class'       => 'card text-white bg-danger mb-2',
                'value'       => get_today_pending_queue(),
                'description' => 'Today Pending.',
                'progress'    => get_percentage(get_today_pending_queue(), get_today_total_queue()), // integer
//                'hint'        => '8544 more until next milestone.',
            ],
        ]);
@endphp
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                <button
                    id="call-next-button"
                    class="btn btn-block btn-lg btn-success"
                >
                    {{ __('Call Next') }} <i class="la la-arrow-right"></i>
                </button>
            </div>
            <div class="col-3">
                <button
                    id="recall-last-button"
                    class="btn btn-block btn-lg btn-info">
                    {{ __('Recall Last') }} <i class="la la-arrow-alt-circle-up"></i>
                </button>
            </div>
            <div class="col-3">
                <button
                    id="complete-current-button"
                    class="btn btn-block btn-lg btn-primary">{{ __('Complete') }} <i class="la la-check"></i> </button>
            </div>
            <div class="col-3">
                <button
                    id="away-button"
                    class="btn btn-block btn-lg btn-danger">{{ __('Away') }} <i class="la la-close"></i> </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(() => {
            // Functions
            let handleCallNextButton = () => {
                let callNextURL = "{{ route('ajax.call_next') }}";
                $.get(
                    callNextURL,
                    function (data) {
                        console.log(data);
                        new Noty({
                            type: (data.status) ? "success" : "warning",
                            text: "<strong>" + data.message + "</strong>",
                        }).show();
                    });
            };

            let handleRecallLastButton = () => {
                let recallLastURL = "{{ route('ajax.recall_last') }}";
                $.get(
                    recallLastURL,
                    function (data) {
                        console.log(data);
                        new Noty({
                            type: (data.status) ? "success" : "warning",
                            text: "<strong>" + data.message + "</strong>",
                        }).show();
                    });
            }

            let completeCurrentButton = () => {

            }
            // Events
            let callNextButton = $('#call-next-button');
            callNextButton.on('click', handleCallNextButton);

            let recallLastButton = $('#recall-last-button');
            recallLastButton.on('click', handleRecallLastButton);
        });
    </script>
@endsection
