 <div class="col-md-4">
     <div class="card mb-4 box-shadow">
         <img class="card-img-top" alt="" style="height: 225px; width: 100%; display: block;" src="{{ asset('storage/' . $project->photo) }}" data-holder-rendered="true">
         <div class="card-body">
             <p class="card-text" style="text-align: justify;">{{$project->description}}</p>
             <div class="d-flex justify-content-between align-items-center w-100">
                 <div class="btn-group">
                     <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$project->id}}" class="btn btn-sm btn-outline-secondary">View</button>
                     <a href="{{ route('editProject', $project['id']) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                     <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('modal2').style.display='block'">Delete</button>
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

                     <!-- Modal -->
                     <div class="view modal fade" id="exampleModal{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title text-center" id="exampleModalLabel">{{$project->description}}</h5>
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
             </div>
         </div>
     </div>
 </div>