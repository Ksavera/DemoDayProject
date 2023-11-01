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

 <div class="album py-5 bg-light">
     <div class="row gap-2 m-0">
         @foreach($profiles as $profile)

         <div class="col-2 border ">
             <a href="{{route('profileView', $profile->id)}}" class="link-underline link-underline-opacity-0 link-body-emphasis">
                 <img src="{{ asset('storage/' . $profile->profile_image) }}" class="rounded-circle my-2" style="margin-right: 15px">
                 <h5 class="text-center">{{$profile->first_name}} {{$profile->last_name}}</h5>
                 <h6 class="text-center m-0">{{$profile->location->name}} | {{$profile->category->name}}</h6>
                 <p class="text-center "><small>Views: {{$profile->views}}</small></p>
             </a>
         </div>


         @endforeach
     </div>
 </div>