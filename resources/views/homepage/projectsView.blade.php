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

 <div class="container">
     <!-- <h5 class="text-center mt-5 text-warning">Students lists will be displayed here</h5>
    <div class="border">
        <img src="{{url('/photos/imageedit_1_9141295572.png')}}" alt="" width="20%">
    </div> -->
     <div class="row gap-2 m-0">
         @foreach($projects as $project)

         <div class="col-2 " data-bs-toggle="modal" data-bs-target="#exampleModal{{$project->id}}">
             <img src="{{ asset('storage/' . $project->photo) }}" class="rounded-circle my-2" style="margin-right: 15px">
             <h5 class="text-center">{{$project->name}}</h5>

             <!-- Modal -->
             <div class="view modal" id="exampleModal{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title text-center" id="exampleModalLabel">{{$project->name}}</h5>

                             <a href="{{route('profileView', $project->profile->id)}}" class="link-underline link-underline-opacity-0 link-body-emphasis">
                                 {{$project->profile->first_name}}-{{$project->profile->last_name}}
                             </a>
                             <h2 class="text-danger"><i id="{{$project->id}}" onclick="callApi(this)" class="bi bi-balloon-heart mx-5"></i></h2>

                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <img src="{{ asset('storage/' . $project->photo) }}" alt="">
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         </div>
                     </div>
                 </div>
             </div>
             <small class="text-muted d-flex align-items-center mx-5">{{$project->created_at}}</small>
         </div>
         @endforeach
     </div>
     <!-- <script>
         function like(element) {
             if (element.classList.contains('bi-balloon-heart')) {
                 element.classList.remove('bi-balloon-heart');
                 element.classList.add('bi-balloon-heart-fill');
             } else {
                 element.classList.remove('bi-balloon-heart-fill');
                 element.classList.add('bi-balloon-heart');
             }
         }
     </script> -->
     <script>
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