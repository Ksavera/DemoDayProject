 @extends('layouts.app')
 @section('content')

 <div class="d-flex justify-content-center pb-2 pt-0">
     @if(session()->has('success'))
     <div class="py-2 container alert displaystyle displaystyle-successs alert-dismissible fade show col-4 d-flex justify-content-between align-items-center text-blue" role="alert">
         {{ session()->get('success') }}
         <button type="button" class="close btn border-blue py-0" data-bs-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
     @elseif($errors->any())
     @foreach($errors->all() as $error)
     <div class="py-2 container alert displaystyle displaystyle-danger alert-dismissible fade show col-4 d-flex justify-content-between align-items-center text-white" role="alert">
         {{ $error }}<br>
         <button type="button" class="close btn py-0 border-rose" data-bs-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
     @endforeach
     @endif
 </div>

 <section>
     <!-- My Profile view -->
     <div class="row justify-content-center rounded-4 bg-white py-3 mb-5">
         <div class=" col-12">
             <div class="row m-0">

                 <!-- profile info column -->
                 <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 shadow-lg rounded-4 text-center">
                     @foreach ($profiles as $profile)

                     <div class="row my-3 mx-1 align-items-center">
                         <!-- Views and likes -->
                         <div class="col-6 p-0">
                             <div class="d-flex gap-2">
                                 <div class="circle-sky"><i class="bi bi-eye-fill"></i><small>{{$profile->views}}</small></div>
                             </div>
                         </div>

                         <!-- Edit and Delete buttons -->
                         @auth
                         @if (auth()->id() == $profile->user_id)
                         <div class="col-6 p-0">
                             <div class="d-flex gap-2 justify-content-end">

                                 <a href="{{ route('editProfile', $profile['id']) }}" class="btn btn-sm btn-action text-white rounded-circle my-auto">
                                     <i class="bi bi-pencil-square edit-icon px-1"></i>
                                 </a>
                                 <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-delete text-white rounded-circle my-auto">
                                     <i class="bi bi-trash-fill delete-icon px-1"></i>
                                 </button>

                             </div>
                         </div>
                         <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                             <div class="modal-dialog border-rose shadow-sm">
                                 <div class="modal-content color-red">
                                     <div class="modal-body">
                                         <p class="text-center text-white">Are you sure you want to delete your profile?</p>
                                     </div>
                                     <div class="modal-footer">
                                         <form action="{{ route('deleteProfile', $profile['id']) }}" method="POST">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="btn displaystyle-success text-white py-1">YES</button>
                                         </form>
                                         <button type="button" class="btn bg-white displaystyle-no py-1" data-bs-dismiss="modal">NO</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endif
                         @endauth
                     </div>

                     <img class="rounded rounded-circle profileImg" src="{{ asset('storage/' . $profile->profile_image) }}">
                     <h5 class="mt-3 " style="font-weight: 600;">{{$profile->first_name}} {{$profile->last_name}}</h5>
                     <h6 class=""><i>{{$profile->category->name}}</i></h6>
                     <p class=" m-0 mb-2"><i class="bi bi-geo-alt-fill"></i> Location: {{$profile->location->name}}</p>

                     <div class="d-flex flex-column justify-content-center align-items-center">
                         <div class="col-4">
                             @if($profile->github)
                             <a href="{{$profile->github}}" class="btn btn-sm btn-blue text-white rounded-4  py-0 mb-2"><i class="bi bi-github"></i> github</a>
                             @endif
                         </div>
                         <div class="col-5">
                             @if($profile->linkedin)
                             <a href="{{$profile->linkedin}}" class="btn btn-sm btn-blue text-white rounded-4  py-0 mb-2"><i class="bi bi-linkedin"></i> linkedin</a>
                             @endif
                         </div>
                         <div class="col-6">
                             @if($profile->phone)
                             <a class="btn btn-sm btn-blue text-white rounded-4  py-0 mb-2"><i class="bi bi-telephone-fill"></i> {{$profile->phone}}</a>
                             @endif
                         </div>
                     </div>


                     <h6 class="mt-4"><i>My strongest skills: </i> {{$profile->skills}}</h6>
                     <h6 class="text-justify"><i>About me: </i> {{ucfirst($profile->about)}}</h6>
                     @endforeach
                 </div>
                 <!-- gallery column -->
                 <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12 mt-5 rounded">
                     <!-- Project view atvaizdavimas-->
                     @if (isset($profiles) && !$profiles->isEmpty())
                     <!-- Check if projects exist -->
                     @if (isset($projects) && !$projects->isEmpty())
                     <div class="gallery">
                         @foreach ($projects as $project)
                         <div class="gallery-item mx-auto position-relative">
                             <div class="profile-special p-0  rounded" data-bs-toggle="modal" data-bs-target="#exampleModal{{$project->id}}" style="height: 200px;">
                                 <img src="{{ asset('storage/' . $project->photo) }}" data-holder-rendered="true">
                             </div>

                             <p class="text-center m-0">{{$project->name}}</p>

                             <p class="text-muted text-center m-0" style="font-size: 10px;">Updated: {{$project->updated_at}}</p>
                             <div class="position-absolute top-0 start-0 px-1 rounded-circle bg-light border d-flex justify-content-center align-items-center">
                                 <p class="color-rose d-flex align-items-center m-0"><i class="bi bi-balloon-heart-fill"></i>{{ optional($project->likes)->count() ?? 0 }}</p>
                             </div>
                         </div>
                         <!-- Project View modal -->

                         <div class="view modal fade" id="exampleModal{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                 <div class="modal-content my-3">
                                     <div class="modal-header py-3">
                                         <h6 class="modal-title px-5" id="exampleModalLabel">Project title: {{$project->name}} | <a href="{{$project->github}}" class="link-custom"><i class="bi bi-github"></i> Project's github</a></h6>
                                         @php
                                         $userId = auth()->user() ? auth()->user()->id : null;
                                         $ownerId = $project->profile_id;
                                         $isOwner = ($userId === $ownerId);
                                         $isLikedByUser = $project->likes->contains('user_id', $userId);
                                         @endphp

                                         @if (!$isOwner)
                                         <h5 class="color-rose ms-auto cursor-pointer">
                                             <i id="{{ $project->id }}" onclick="callApi(this)" class="bi bi-balloon-heart{{ $isLikedByUser ? '-fill' : '' }} mx-5" {{ $isOwner ? 'disabled' : '' }}>{{ optional($project->likes)->count() ?? 0 }}</i>
                                         </h5>
                                         @endif


                                         <div class="d-flex gap-1">
                                             @auth
                                             @if (auth()->id() == $profile->user_id)
                                             <a href="{{ route('editProject', $project['id']) }}" class="btn btn-sm btn-action rounded-circle my-auto"><i class="bi bi-pencil-square edit-icon px-1"></i></a>
                                             <button type="button" class="btn btn-sm btn-delete rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteModal{{$project->id}}"><i class="bi bi-trash-fill delete-icon px-1"></i></button>

                                             @endif
                                             @endauth
                                             <button type="button" class="btn btn-action py-1 rounded-circle" data-bs-dismiss="modal"><i class="bi bi-x-square-fill close-icon"></i></button>
                                         </div>
                                     </div>
                                     <div class="modal-body">
                                         <img src="{{ asset('storage/' . $project->photo) }}" alt="">
                                     </div>
                                     <div class="text-center my-0 py-0">
                                         <p class="m-0"><i>About project: </i>{{$project->description}}</p>
                                         <p class="text-muted pb-3" style="font-size:12px">Updated: {{$project->updated_at}}</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endforeach
                     </div>

                     <!-- Project Delete modal -->

                     <!-- Project Delete modal -->
                     @foreach ($projects as $project)
                     <div class="modal" tabindex="-1" id="deleteModal{{$project->id}}">
                         <div class="modal-dialog border-rose shadow-sm">
                             <div class="modal-content color-red">
                                 <div class="modal-body">
                                     <p class="text-center text-white">Are you sure you want to delete your project?</p>
                                 </div>
                                 <div class="modal-footer mx-auto gap-2">
                                     <form action="{{ route('deleteProject', $project['id']) }}" method="POST">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn displaystyle-success text-white py-1">YES</button>
                                     </form>
                                     <a href="">
                                         <button type="button" class="btn bg-white displaystyle-no py-1" data-bs-dismiss="modal">NO</button>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     @endforeach







                     @endif
                     @endif
                 </div>
             </div>
         </div>
 </section>


 <script>
     document.querySelectorAll('[data-bs-toggle="popover"]').forEach(element => {
         new bootstrap.Popover(element);
     });

     function callApi(element) {

         var projectId = element.id;
         //  console.log(projectId);
         var apiToken = "{{ session('api_token') }}";
         console.log(apiToken);

         fetch(`/api/project/${projectId}/like`, {
                 method: 'POST',
                 headers: {
                     'Accept': 'application/json',
                     'Authorization': 'Bearer ' + apiToken,
                     'Content-Type': 'application/json',
                 },
             })
             .then(response => response.json())
             .then(data => {
                 console.log(data);
                 if (data.message === 'Project liked') {
                     element.classList.remove('bi-balloon-heart');
                     element.classList.add('bi-balloon-heart-fill');
                 } else {
                     element.classList.remove('bi-balloon-heart-fill');
                     element.classList.add('bi-balloon-heart');
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
             });
     }
 </script>

 @endsection