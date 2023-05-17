<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    />
    <title>How to Align Responsive Image in Center in Bootstrap</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div>
    <div class="row align-items-center" style="height: 100vh;">
        <div class="mx-auto col-10 col-md-8 col-lg-6" id="button-container">
{{--            <img src="https://worldexperiencero.files.wordpress.com/2018/07/iom-logo.jpg" width="50%" alt="logo" />--}}

{{--            <div class="logo ">--}}
{{--            </div>--}}
                @foreach($visa_types as $visa_type)
                    <button class="btn btn-lg btn-block btn-primary m-5 w-100" style="height: 100px;">{{ $visa_type->code }} - {{ $visa_type->name }} </button>
                @endforeach


        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"
></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>

{{--    let buttonContainer = $.("#button-container");--}}

{{--    let visaTypeURL = "{{ route('ajax.get-visa-types') }}";--}}

{{--    let createButton = function (vitem) {--}}
{{--        let button = $("<button>").text('')--}}
{{--    }--}}
{{--    // jquery ajax get request to the visa type url route and loop through the result--}}
{{--    $.get(visaTypeURL, function (data) {--}}
{{--        $.each(data, function (item) {--}}

{{--        });--}}
{{--    });--}}
</script>
</body>
</html>
