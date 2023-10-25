@extends('layouts.app')
@section('galleryForm')


@if(session()->has('success'))
<div class="container alert alert-success alert-dismissible fade show w-50 d-flex justify-content-between align-items-center" role="alert">
    <strong>{{ session()->get('success') }}</strong>
    <button type="button" class="close btn btn-outline-dark" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif($errors->any())
@foreach($errors->all() as $error)
<div class="container alert alert-danger alert-dismissible fade show w-50 d-flex justify-content-between align-items-center" role="alert">
    <strong>{{ $error }}</strong><br>
    <button type="button" class="close btn btn-outline-dark" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endforeach
@endif

<div class="container w-25 border">
    <form action="{{ isset($profile) ? route('updateProfile', $profile->id) : route('saveProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mt-3">
            <label for="">First name: </label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name', isset($profile) ? $profile->first_name : '') }}">
        </div>
        <div class="mt-3">
            <label for="">Last name: </label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name',isset($profile)? $profile->last_name: '') }}">
        </div>
        <div class="mt-3">
            <label for="">Skills: </label>
            <input type="text" class="form-control" name="skills" value="{{  old('skills',isset($profile)? $profile->skills: '') }}">
        </div>
        <div class="mt-3">
            <label for="">About me: </label>
            <input type="text" class="form-control" name="about" value="{{ old('about',isset($profile)? $profile->about: '') }}">
        </div>
        <div class="mt-3">
            <label for="">Location: </label>
            <input type="text" class="form-control" name="location" value="{{  old('location',isset($profile)? $profile->location: '')}}">
        </div>
        <div class="mt-3">
            <label for="">Profile image: </label>
            <input type="file" class="form-control" name="profile_image" value="{{  old('profile_image',isset($profile)? $profile->profile_image: '')}}">
        </div>
        <div class="d-flex justify-content-end gap-3">
            <div class="mt-3 d-flex justify-content-end">
                <button class="btn btn-outline-primary" value="create">save</button>

            </div>
        </div>

    </form>

</div>

@endsection