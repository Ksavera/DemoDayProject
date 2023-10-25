<div class="container">
    <!-- <h5 class="text-center mt-5 text-warning">Students lists will be displayed here</h5>
    <div class="border">
        <img src="{{url('/photos/imageedit_1_9141295572.png')}}" alt="" width="20%">
    </div> -->
    <div class="row gap-2 m-0">
        @foreach($profiles as $profile)

        <div class="col-2 ">
            <img src="{{ asset('storage/' . $profile->profile_image) }}" class="rounded-circle my-2" style="margin-right: 15px">
            <h5 class="text-center">{{$profile->first_name}} {{$profile->last_name}}</h5>
            <p class="text-center">{{$profile->location->name}}</p>

            <!-- <h5><strong>Skills:</strong> {{$profile->skills}} </h5>
                <h5><strong>About:</strong> {{$profile->about}} </h5>
                <h5><strong>Location:</strong> {{$profile->location}}</h5> -->
        </div>
        @endforeach
    </div>