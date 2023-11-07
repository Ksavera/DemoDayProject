@extends('layouts.app')
@section('content')

<div class="col-6 mx-auto mt-0">
    <div class="d-flex bg-white rounded-4 p-4 gap-5 justify-content-center">
        <div class="col-3 my-4 text-center">
            <p class="text-center">Contact me: </p>
            <h6>Ksavera Armonavičienė</h6>
        </div>
        <div class="col-3 about-center">
            <img src="{{ asset('photos/githubKA.png') }}" alt="">
            <p><i class="bi bi-github"></i> Github</p>
        </div>
        <div class="col-3 about-center">
            <img src="{{ asset('photos/linkedIn.png') }}" alt="">
            <p class=""><i class="bi bi-linkedin"></i> LinkedIn</p>
        </div>
    </div>
</div>

@endsection