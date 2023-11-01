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

         <div class="col-2 ">
             <img src="{{ asset('storage/' . $project->photo) }}" class="rounded-circle my-2" style="margin-right: 15px">
             <h5 class="text-center">{{$project->name}}</h5>
         </div>
         @endforeach
     </div>