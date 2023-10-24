 @extends('layouts.app')
 @section('profile')




 @if(session()->has('success'))
 <div class="container alert alert-success alert-dismissible fade show w-50 d-flex justify-content-between align-items-center" role="alert">
     <strong>{{ session()->get('success') }}</strong>
     <button type="button" class="close btn btn-outline-dark" data-bs-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
 @elseif(session()->has('error'))
 <div class="container alert alert-danger alert-dismissible fade show w-50 d-flex justify-content-between align-items-center" role="alert">
     <strong>{{ session()->get('error') }}</strong>
     <button type="button" class="close btn btn-outline-dark" data-bs-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>

 @endif

 <section class="section1 d-flex align-items-center">
     <div class="container">
         <!-- @if($profiles->count()) -->
         <!-- ... existing profile code ... -->
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
                         @foreach($profiles as $profile)
                         <div class="row">
                             <div class="text-wrap col-12">
                                 <img src="{{ asset('storage/' . $profile->profile_image) }}" class="float-left" style="margin-right: 15px">
                                 <div style="text-align: justify;">
                                     <h5><strong>First name:</strong> {{$profile->first_name}} Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic ea quidem quisquam recusandae cum odit. Dolorem, architecto maxime, praesentium corporis quidem nemo quo quae debitis, neque culpa soluta fugiat! Voluptates, fuga debitis ut atque voluptatibus, vero totam maxime qui, adipisci eum ipsa! Vel omnis hic facere adipisci praesentium, repellat eius. </h5>
                                     <h5><strong>Last name: </strong>{{$profile->last_name}} Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, animi! Itaque eaque dolorum eius, repellat sed cum sint eveniet, placeat magnam molestias qui deleniti aliquam optio quam fugit officia autem, suscipit explicabo quibusdam iure. Ipsam quasi delectus totam consectetur temporibus numquam obcaecati magnam omnis minus, enim reprehenderit autem nulla nostrum?</h5>
                                     <h5><strong>Skills:</strong> {{$profile->skills}} Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem nihil, cumque tenetur eum laudantium facere sunt adipisci veritatis cum magnam at esse quasi, impedit accusantium alias quis eos ad. Consequatur reprehenderit nihil accusamus ipsam quos excepturi voluptas nostrum nesciunt earum eaque repellat veritatis, quaerat facere sequi nobis, at animi nisi. </h5>
                                     <h5><strong>About:</strong> {{$profile->about}} </h5>
                                     <h5><strong>Location:</strong> {{$profile->location}}</h5>
                                 </div>

                             </div>
                             @endforeach


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
                         </div>
                     </div>

                 </div>
             </div>
         </div>
         <!-- 
         <a href="{{ route('deleteProfile', $profile['id']) }}> -->


         <!-- 
         <h5 class=" my-5 text-center">Gallery</h5>
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
             @endfor -->
         <!-- @else
         <div class="container text-center alert alert-danger alert-dismissible fade show w-50 d-flex justify-content-between align-items-center px-0" role="alert">
             <div class="d-flex gap-2 px-3">
                 You don't have profile.<strong><a class="nav-link" href="{{ route('newProfile') }}"> {{ __(' Create your profile.') }}</a> </strong>
             </div>
             <button type="button" class="close btn btn-outline-danger mx-3" data-bs-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         @endif -->


     </div>
 </section>
 @endsection