<div class="row mb-5 mt-2 py-3 justify-content-center align-items-center shadow-lg rounded-4 bg-white">
    @if(Route::currentRouteName() == 'home')
    <h4 class="text-center mt-3">
        <strong class="mx-2">TOP</strong><i class="bi bi-5-circle-fill top5" style="font-size: 1.8em; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);  vertical-align: middle;"></i><strong class="mx-2">STUDENTS</strong>
    </h4>
    @endif
    @foreach($profiles as $profile)
    <div class="profile-special col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 p-0">
        <a href="{{route('profileView', $profile->id)}}" class="link-underline link-underline-opacity-0 link-body-emphasis">
            <img src="{{ asset('storage/' . $profile->profile_image) }}" class="rounded-circle">
            <h6 class="text-center mt-2">{{$profile->first_name}} {{$profile->last_name}}</h6>
        </a>
        @if(Route::is('students*'))
        <a href="{{route('students.From', $profile->location_id)}}" class="link-underline link-underline-opacity-0 link-body-emphasis">
            <h6 class="text-center m-0">{{$profile->location->name}}
        </a> | <a href="{{route('students.Profession', $profile->category_id)}}" class="link-underline link-underline-opacity-0 link-body-emphasis">{{$profile->category->name}}</a></h6>
        <p class="text-center "><small>Views: {{$profile->views}}</small></p>
        @endif
    </div>
    @endforeach
</div>