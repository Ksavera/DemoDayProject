@extends('layouts.app')
@section('content')
<section class="section1 d-flex align-items-center">

    <div class="container">
        <h2 class="text-center">Students</h2>
        @include('homepage.students')
        <h2 class="text-center mt-5 mb-3">Projects</h2>
        @include('homepage.galleriesView')

    </div>
</section>

@endsection