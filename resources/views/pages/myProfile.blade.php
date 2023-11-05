 @extends('layouts.app')
 @section('content')


 @if(session()->has('success'))
 <div class="container alert alert-success alert-dismissible fade show col-7 d-flex justify-content-between align-items-center" role="alert">
     <strong>{{ session()->get('success') }}</strong>
     <button type="button" class="close btn btn-outline-dark" data-bs-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
 @elseif($errors->any())
 @foreach($errors->all() as $error)
 <div class="container alert alert-danger alert-dismissible fade show col-7 d-flex justify-content-between align-items-center" role="alert">
     <strong>{{ $error }}</strong><br>
     <button type="button" class="close btn btn-outline-dark" data-bs-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
 @endforeach
 @endif


 <section>
     <!-- My Profile view -->
     <div class="row justify-content-center rounded-4 bg-white py-3 mb-5">
         <div class=" col-12">
             <div class="row m-0">

                 <!-- profile info column -->
                 <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 shadow-lg rounded-4 text-center">
                     @foreach ($profiles as $profile)

                     <div class="row my-3 mx-2 align-items-center">
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
                         @endif
                         @endauth
                     </div>

                     <img class="rounded rounded-circle profileImg" src="{{ asset('storage/' . $profile->profile_image) }}">
                     <h5 class="mt-3 " style="font-weight: 600;">{{$profile->first_name}} {{$profile->last_name}}</h5>
                     <h6 class=""><i>{{$profile->category->name}}</i></h6>
                     <p class=" m-0 mb-2"><i class="bi bi-geo-alt-fill"></i> Location: {{$profile->location->name}}</p>
                     <a href="{{$profile->linkedin}}" class="btn btn-sm btn-blue text-white rounded-4 px-3 py-0 mb-2"><i class="bi bi-github"></i> github</a>
                     <a href="{{$profile->github}}" class="btn btn-sm btn-blue text-white rounded-4 px-3 py-0 mb-2"><i class="bi bi-linkedin"></i> linkedin</a>
                     <button type="button" class="btn btn-sm btn-blue text-white rounded-4 px-3 py-0" data-bs-toggle="popover" data-bs-title="Phone number" data-bs-content="{{$profile->phone}}"><i class="bi bi-telephone-fill"></i> phone</button>
                     <h6 class="mt-5"><i>My strongest skills: </i> {{$profile->skills}}</h6>
                     <h6 class="text-justify">{{ucfirst($profile->about)}} Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, suscipit ullam. Illum delectus, reprehenderit culpa volu.</h6>
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
                                 <p class="top5 d-flex align-items-center m-0"><i class="bi bi-balloon-heart-fill"></i>{{ optional($project->likes)->count() ?? 0 }}</p>
                             </div>
                         </div>
                         @endforeach
                     </div>

                     <!-- Project Delete modal -->
                     <div class="modal" tabindex="-1" id="modal2">
                         <div class="modal-dialog">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title">DELETE</h5>
                                 </div>
                                 <div class="modal-body">
                                     <p>Are you sure you want to delete your project?</p>
                                 </div>
                                 <div class="modal-footer">
                                     <form action="{{ route('deleteProject', $project['id']) }}" method="POST">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-warning">YES</button>
                                     </form>
                                     <a href="">
                                         <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Profile Delete Modal -->
                     @foreach ($profiles as $profile)
                     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="deleteModalLabel">DELETE</h5>
                                 </div>
                                 <div class="modal-body">
                                     <p>Are you sure you want to delete your profile?</p>
                                 </div>
                                 <div class="modal-footer">
                                     <form action="{{ route('deleteProfile', $profile['id']) }}" method="POST">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-warning">YES</button>
                                     </form>
                                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                                 </div>
                             </div>
                         </div>
                     </div>
                     @endforeach

                     <!-- Project view Modal -->
                     @foreach ($projects as $project)
                     <div class="view modal fade" id="exampleModal{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                             <div class="modal-content my-3">
                                 <div class="modal-header py-3">
                                     <h6 class="modal-title px-5" id="exampleModalLabel">Project title: {{$project->name}} | <a href="{{$project->github}}" class="link-custom"><i class="bi bi-github"></i> Project's github</a></h6>

                                     <div class="d-flex gap-1">
                                         @auth
                                         @if (auth()->id() == $profile->user_id)
                                         <a href="{{ route('editProject', $project['id']) }}" class="btn btn-sm btn-action rounded-circle my-auto"><i class="bi bi-pencil-square edit-icon px-1"></i></a>
                                         <button type="button" class="btn btn-sm btn-delete rounded-circle" onclick="document.getElementById('modal2').style.display='block'"><i class="bi bi-trash-fill delete-icon px-1"></i></button>
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
 </script>
 @endsection