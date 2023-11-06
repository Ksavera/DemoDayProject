@extends('layouts.app')
@section('content')



<div class="d-flex justify-content-center pb-2 pt-0">
    @if(session()->has('success'))
    <div class="py-2 container alert displaystyle displaystyle-successs alert-dismissible fade show col-4 d-flex justify-content-between align-items-center text-blue" role="alert">
        <strong>{{ session()->get('success') }}</strong>
        <button type="button" class="close btn border-blue py-0" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif($errors->any())
    @foreach($errors->all() as $error)
    <div class="py-2 container alert displaystyle alert-dismissible fade show col-4 d-flex justify-content-between align-items-center text-white" role="alert">
        <strong>{{ $error }}</strong><br>
        <button type="button" class="close btn py-0 border-rose" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach
    @endif
</div>

<section>
    @include('components.getStudents')
</section>

<section>
    @include('components.getProjects')
</section>

@endsection