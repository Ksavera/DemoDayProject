@extends('layouts.app')
@section('content')

<section>
    @include('components.getStudents')
</section>

<section>
    @include('components.getProjects')
</section>

@endsection