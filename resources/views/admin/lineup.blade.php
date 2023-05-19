@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        @foreach($visa_types as $visaType)
            <button data-id="{{ $visaType->id }}" onclick="handleButton({{ $visaType->id }})" class="btn btn-lg btn-block btn-primary m-5 w-100" style="height: 100px;">{{ $visaType->code }} - {{ $visaType->name }} </button>
        @endforeach
    </div>

    <script>
        let handleButton = (_visa_type_id) => {
            let button = $(this);
            let lineUpEntryURL = "{{ route('ajax.lineup_entry') }}";
            $.post(
                lineUpEntryURL,
                {
                    visa_type_id: _visa_type_id
                },
                function (data) {
                console.log(data);
            });
        };
    </script>
@endsection
