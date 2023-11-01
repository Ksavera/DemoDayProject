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
 @auth
 @if (auth()->id() == $profile->user_id)
 <div class="card-footer d-flex justify-content-end gap-2">
     <a href="{{ route('editProfile', $profile['id']) }}"> <button class="btn btn-outline-dark">Edit</button></a>
     <!-- Trigger Delete Modal -->
     <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-outline-danger">Delete</button>

     <!-- Delete Modal -->
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
         @endif
         @endauth