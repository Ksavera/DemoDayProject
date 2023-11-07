<div class="row gap-5 mb-5 p-4 justify-content-center align-items-center shadow-lg bg-white rounded-4">
    @if(Route::currentRouteName() == 'home')
    <h4 class="text-center mt-3 mb-0"><strong>TOP</strong>
        <i class="bi bi-5-circle-fill top5" style="font-size: 1.8em; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3); vertical-align: middle;"></i><strong class="mx-2">PROJECTS</strong>
    </h4>
    @endif
    @foreach($projects as $project)

    <div class="profile-special col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 p-0 position-relative rounded mb-4 mt-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{$project->id}}" style="height: 200px;">
        <img src="{{ asset('storage/' . $project->photo) }}" class="w-100 img-cover">
        <h6 class="text-center mt-2" style="margin-top: 10px;">{{$project->name}}</h6>
        <div class="position-absolute top-0 start-0 px-1 rounded-circle bg-light border d-flex justify-content-center align-items-center">
            <p class="color-rose d-flex align-items-center m-0"><i class="bi bi-balloon-heart-fill"></i>{{ optional($project->likes)->count() ?? 0 }}</p>
        </div>
    </div>
    @endforeach
</div>



<!-- Modal -->
@foreach($projects as $project)
<div class=" view modal " id="exampleModal{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content my-3">
            <div class="modal-header">
                <h6>Visit profile:
                    <a href="{{route('profileView', $project->profile->id)}}" class="link-custom">
                        {{$project->profile->first_name}} {{$project->profile->last_name}}</a> | <a href="{{$project->github}}" class="link-custom"><i class="bi bi-github"></i> Project's github</a>

                </h6>
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




                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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