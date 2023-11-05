@extends('layouts.app')
@section('profileForm')


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

<div class="container w-25 border pb-2 mb-5">
    <form action="{{ isset($profile) ? route('updateProfile', $profile->id) : route('saveProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($profile))
        @method('PUT')
        @endif

        <section>
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
                <label for="">Linkedin: </label>
                <input type="text" class="form-control" name="linkedin" value="{{ old('linkedin',isset($profile)? $profile->linkedin: '') }}">
            </div>
            <div class="mt-3">
                <label for="">github: </label>
                <input type="text" class="form-control" name="github" value="{{ old('github',isset($profile)? $profile->github: '') }}">
            </div>
            <div class="mt-3">
                <label for="">phone: </label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone',isset($profile)? $profile->phone: '') }}">
            </div>
            <div class="mt-3">
                <label>Category:</label>
                <select class="form-select" name="category">
                    <option selected>Select a category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($profile) && $profile->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <label>Location:</label>
                <select class="form-select" name="location">
                    <option selected>Select location</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ isset($profile) && $profile->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label for="">Profile image: </label>
                <input type="file" class="form-control" name="profile_image" value="{{  old('profile_image',isset($profile)? $profile->profile_image: '')}}">
            </div>
            <div class="d-flex justify-content-end gap-3">
                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-primary" value="create">{{ isset($profile) ? 'Update' : 'Save' }}</button>

                </div>
            </div>

    </form>

</div>
</section>


@endsection