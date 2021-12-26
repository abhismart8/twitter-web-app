@extends('layouts.main')

@section('content')
<div class="row home-scroll">
    <div class="col-sm-3 column">
        <div class="ml-30">
            <div class="form-group mt-15 mb-30 ml-15">
                <img src="{{ config('constants.app.logo') }}" width=60 height=60 />
            </div>
            <div class="menu ml-30">
                <p><a href="/"> Home </a></p>
                <p><a href="javascript:;"> Explore </a></p>
                <p><a href="javascript:;"> Notifications </a></p>
                <p><a href="javascript:;"> Messages </a></p>
                <p><a href="javascript:;"> Bookmarks </a></p>
                <p><a href="javascript:;"> List </a></p>
                <p><a href="javascript:;"> Profile </a></p>
                <p><a href="javascript:;"> More </a></p>
            </div>
            <div class="user mt-30 ml-30" style="margin-top: 80px; margin-bottom: 50px;">
                <p class="">
                    <img src="{{ Auth::user()->photo_url }}" width="40" height="40" style="border-radius: 50%" />
                    <span> {{ Auth::user()->name }} </span>
                </p>
                <a href="/logout" class="btn btn-primary btn-sm"> Logout </a>
            </div>
        </div>
    </div>
    <div class="col-sm-5 column scrolldown">
        <div class="form-group mt-30">
            <h3> Home </h3>
            <div class="form-group mt-30">
                {{-- <img src="{{ Auth::user()->photo_url }}" width="40" height="40" style="border-radius: 50%;" /> --}}
                <textarea class="form-control" rows="4" id="tweet-content"> </textarea>
                <a href="javascript:;" class="btn btn-primary mt-15" style="float: right;" id="tweetbtn"> Tweet </a>
            </div>
        </div>
        <div class="form-group" style="margin-top: 100px;">
            @foreach(($tweets??[]) as $tweet)
            <div class="form-group" style="border: 1px solid grey; border-radius: 5px;">
                <div class="ml-15" style="margin-top: 3px;">
                    <span style="float: right; font-size: 12px;" class="mr-15">{{ $tweet->created_at->diffForHumans() }}</span>
                    <h4> <img src="{{ Auth::user()->photo_url }}" width="30" height="30" style="border-radius: 50%" /> 
                        {{ $tweet->tweeter->name }} 
                    </h4>
                    <p> {{ $tweet->content }} </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-4 text-center">
        <div class="form-group search-bar mt-15">
            <input type="text" name="search" id="search-box" autocomplete="off" class="form-control" value="" placeholder="Search Twitter">
            <a class=""><img src="{{asset('images/search.svg')}}" alt="search"></a>
        </div>

        <div class="form-group mt-30">
            <h4>Who to follow</h4>
            <div class="table-responsive" id="users-table">
                <table class="table listings_table scrolldown">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><img src="{{ $user->photo_url }}" width="30" height="30" style="border-radius: 50%" /> <span>{{ $user->name }}</span></td>
                            <td><a href="javascript:;" data-id="{{$user->id}}" 
                                    class="btn btn-primary btn-sm follow-user">
                                    @if(in_array(Auth::user()->id, $user->followers->pluck('id')->toArray()??[])){{'Unfollow'}}@else{{'Follow'}}@endif
                                </a>
                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('post-scripts')
<script src="{{ asset('js/index.js') }}"></script>
<script>
    window.userId = "{{Auth::user()->id}}";

    // create tweet
    document.getElementById('tweetbtn').addEventListener('click', function(){
        tweet("{{route('tweet')}}", document.getElementById('tweet-content').value);
    });

    // follow
    $('.follow-user').on('click', function(){
        follow("{{route('follow')}}", $(this).attr('data-id'), $(this))
    })
</script>
@endpush