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
                             <div class="text-wrap col-12">
                                 <img src="{{ asset('storage/' . $profile->profile_image) }}" class="float-left" style="margin-right: 15px">
                                 <div style="text-align: justify;">
                                     <h5><strong>First name: </strong>{{$profile->first_name}}</h5>
                                     <h5><strong>Last name: </strong>{{$profile->last_name}} </h5>
                                     <h5><strong>Skills:</strong> {{$profile->skills}} </h5>
                                     <h5><strong>About:</strong> {{$profile->about}} </h5>
                                     <h5><strong>Location:</strong> {{$profile->location->name}}</h5>
                                     <h5><strong>Linkedin:</strong> {{$profile->linkedin}}</h5>
                                     <h5><strong>Github:</strong> <a href="{{$profile->github}}">{{$profile->github}}</a></h5>
                                 </div>

                             </div>



                         </div>
                     </div>
                     <div class="card-footer d-flex justify-content-end gap-2">
                         <a href="{{ route('editProfile', $profile['id']) }}"> <button class="btn btn-outline-dark">Edit</button></a>
                         <button class="btn btn-outline-danger" onclick="document.getElementById('modal1').style.display='block'">Delete</button>
                         <div class="modal" tabindex="-1" id="modal1">
                             <div class="modal-dialog">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title">DELETE</h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                         <p>Are you sure you want to delete your profile?</p>
                                     </div>
                                     <div class="modal-footer">

                                         <button onclick="window.location='{{ route('deleteProfile', $profile['id']); }}'" type=" button" class="btn btn-warning">YES</button>

                                         <a href="">
                                             <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                                         </a>


                                     </div>
                                 </div>
                             </div>
                             @endforeach
                         </div>
                     </div>

                 </div>
             </div>
         </div>

         <h5 class=" my-5 text-center">Projects</h5>
         <!-- Gallery view atvaizdavimas-->
         <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
             @for($i=0; $i<10; $i++) <div class="col">
                 <div class="card shadow-sm">
                     <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                         <title>Placeholder</title>
                         <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                     </svg>
                     <div class="card-body">
                         <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                         <div class="d-flex justify-content-between align-items-center">
                             <div class="btn-group">
                                 <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                 <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                 <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                             </div>
                             <small class="text-body-secondary">9 mins</small>
                         </div>
                     </div>
                 </div>
         </div>
         @endfor

     </div>
 </section>
 @endsection