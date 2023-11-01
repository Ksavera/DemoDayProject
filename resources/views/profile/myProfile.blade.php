 @extends('layouts.app')
 @section('myProfile')


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


 <section class="section1 d-flex align-items-center">
     <div class="container">
         <!-- My Profile view -->
         <div class="row justify-content-center">
             <div class="col-md-7">
                 <div class="card" style="height:400px; overflow-y: auto;">
                     <div class="card-header">{{ __('My profile') }}</div>

                     <div class="card-body">
                         @if (session('status'))
                         <div class="alert alert-success" role="alert">
                             {{ session('status') }}
                         </div>
                         @endif

                         <!-- {{ __('You are logged in!') }} -->


                         <div class="row">
                             @foreach ($profiles as $profile)
                             @include('components.profile', ['profile' => $profile])
                             @endforeach
                         </div>

                     </div>

                 </div>
             </div>
         </div>

         <!-- Project view atvaizdavimas-->
         @if (isset($profiles) && !$profiles->isEmpty())
         <!-- Check if projects exist -->
         @if (isset($projects) && !$projects->isEmpty())
         <main role="main">


             <section>
                 <div class="album py-5 bg-light">
                     <div class="container">
                         <h2 class="text-center my-3">Projects</h2>
                         <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                             @foreach ($projects as $project)
                             @include('components.project', ['project' => $project])
                             @endforeach
                             @endif
                             @endif
                         </div>
                     </div>
                 </div>
             </section>

         </main>
 </section>
 @endsection