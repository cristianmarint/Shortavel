@extends('layout.main')
@section('content')
<div class="col-xl-9 mx-auto">
    <h1 class="mb-5">¡Summit your URL and we take care of it!🤹🏾‍♂️🤹🏾‍♀️</h1>
</div>
<div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
    <form action="{{url('/store')}}" method="POST" >
        @csrf
        <div class="form-row">
            <div class="col-12 col-md-9 mb-2 mb-md-0"><input class="form-control form-control-lg" type="url" placeholder="www.google.com/asdfghj" name="origin"></div>
            <div class="col-12 col-md-3"><button class="btn btn-primary btn-block btn-lg" type="submit">Generate</button></div>
        </div>
    </form>
</div>
@endsection