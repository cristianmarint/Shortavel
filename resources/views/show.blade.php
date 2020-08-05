@extends('layout.main')
@section('content')
    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <div class="row">
            <div class="col-12 col-md-9 mb-2 mb-md-0">
                <label>URL Original</label>
                <a href="{{$link->origin}}" target="_blank">
                    <input type="url" class="form-control form-control-lg" placeholder="{{$link->origin}}" readonly>
                </a>
                <label>ID</label>
                <input type="text" class="form-control form-control-lg" placeholder="{{$link->shorturl}}" readonly>
                
                <label>Total Views</label>
                <input type="number" class="form-control form-control-lg text-center" placeholder="{{$link->view_count}}" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto mt-5">
        <div class="form-row">
            <div class="col-12 col-md-9 mb-2 mb-md-0">
                <label>Short URL</label>
                    <input class="form-control form-control-lg" type="url" id="shorturl" value="{{url($link->shorturl)}}" readonly>
                    <button class="btn btn-primary btn-block btn-lg"  onclick="copyURL()">Copy</button>
                </div>
            </div>
    </div>

    <script>
        function copyURL() {
            var copyText = document.getElementById("shorturl");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            alert("Url copied: " + copyText.value);
            }
    </script>
@endsection