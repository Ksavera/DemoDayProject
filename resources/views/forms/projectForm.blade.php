@extends('layouts.app')
@section('projectForm')

<div class="d-flex justify-content-center pb-2 pt-0">
    @if(session()->has('success'))
    <div class="py-3 container alert displaystyle displaystyle-successs alert-dismissible fade show col-4 d-flex justify-content-between align-items-center text-blue" role="alert">
        <strong>{{ session()->get('success') }}</strong>
        <button type="button" class="close btn border-blue py-0" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif($errors->any())
    @foreach($errors->all() as $error)
    <div class="py-3 container alert displaystyle alert-dismissible fade show col-7 d-flex justify-content-between align-items-center text-white" role="alert">
        <strong>{{ $error }}</strong><br>
        <button type="button" class="close btn py-0 border-rose" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach
    @endif
</div>

<div class="container w-25 border">
    <form action="{{ isset($project) ? route('updateProject', $project->id) : route('saveProject') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($project))
        @method('PUT')
        @endif

        <div class="mt-3">
            <label for="">Project name: </label>
            <input type="text" class="form-control" name="name" value="{{ old('name', isset($project) ? $project->name : '') }}">
        </div>

        <div class="mt-3">
            <label for="">Description: </label>
            <input type="text" class="form-control" name="description" value="{{  old('description',isset($project)? $project->description: '') }}">
        </div>
        <div class="mt-3">
            <label for="">Github: </label>
            <input type="text" class="form-control" name="github" value="{{ old('github',isset($project)? $project->github: '') }}">
        </div>



        <div class="mt-3">
            <label for="">Project image: </label>
            <input type="file" class="form-control" name="photo">
        </div>


        <div class="d-flex justify-content-end gap-3">
            <div class="mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-primary" value="create">{{ isset($project) ? 'Update' : 'Save' }}</button>

            </div>
        </div>

    </form>

</div>

@endsection