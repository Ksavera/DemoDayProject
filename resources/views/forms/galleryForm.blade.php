@extends('layouts.app')
@section('galleryForm')


@if(session()->has('success'))
<div class="container alert alert-success alert-dismissible fade show w-50 d-flex justify-content-between align-items-center" role="alert">
    <strong>{{ session()->get('success') }}</strong>
    <button type="button" class="close btn btn-outline-dark" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@else
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
    <form action="{{ isset($gallery) ? route('updateGallery', $gallery->id) : route('saveGallery') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($gallery))
        @method('PUT')
        @endif

        <div class="mt-3">
            <label for="">Project name: </label>
            <input type="text" class="form-control" name="name" value="{{ old('name', isset($gallery) ? $gallery->name : '') }}">
        </div>

        <div class="mt-3">
            <label for="">Description: </label>
            <input type="text" class="form-control" name="description" value="{{  old('description',isset($gallery)? $gallery->description: '') }}">
        </div>
        <div class="mt-3">
            <label for="">Github: </label>
            <input type="text" class="form-control" name="github" value="{{ old('github',isset($gallery)? $gallery->github: '') }}">
        </div>



        <div class="mt-3">
            <label for="">Project image: </label>
            <input type="file" class="form-control" name="photo">
        </div>


        <div class="d-flex justify-content-end gap-3">
            <div class="mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-primary" value="create">{{ isset($gallery) ? 'Update' : 'Save' }}</button>

            </div>
        </div>

    </form>

</div>

@endsection