@extends('layouts.app')
@section('content')
    @if (session('video_updated'))
        <div class="alert alert-success">
            Vidéo mise en ligne avec succès !
        </div>
    @endif
    <div class="container align-items-center">
        <div class="profile">
            <div class="col-md-3 text-center" style="margin-left: auto; margin-right: auto; margin-bottom: 40px;">
                <div class="profile">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        @if(isset($profile->image))
                            <img src="{{ asset('storage/images/'. $profile->image) }}" style="width: 250px; height: 250px">
                        @else
                            <img src="https://static.asianetnews.com/img/default-user-avatar.png" style="width: 250px; height: 250px">
                        @endif
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{ $profile ?? '' ? $profile->first_name : '' }} {{ $profile ?? '' ? $profile->last_name : '' }}
                        </div>
                        <div class="profile-usertitle-job">
                            {{ $profile ?? '' ? substr($profile->dateOfBirth, 0, 10) : '' }}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    @if($profile->id == \Illuminate\Support\Facades\Auth::id())
                        <div class="profile-userbuttons">
                            <a href="{{ route('profile_edit') }}"><button type="submit" class="btn btn-success btn-sm">Éditer profil</button></a>
                            <a href="{{ route('profile_destroy') }}"><button type="submit" class="btn btn-danger btn-sm">Supprimer le profil</button></a>
                        </div>
                    @endif
                    <!-- END SIDEBAR BUTTONS -->
                </div>
            </div>
            <h3>Vidéos publiées</h3>
            <hr />
            @foreach ($videos as $video)
                @php
                $video->id;
                @endphp
            <div class="media">
                <img src="{{ asset('storage/images/'. $video->image) }}" class="mr-3" alt="miniature">
                <div class="media-body" style="text-overflow:  ellipsis;  overflow: hidden !important;">
                    <h5 class="mt-1">{{ $video->title }}</h5>
                    <p>
                        {{ $video->description }}
                    </p>
                    <p>
                        Sortie le : {{ $video->created_at }}
                    </p>
                </div>
                <div class="text-center" style="width: 20%">
                    <button type="button" class="btn btn-success" style=" margin-bottom: 14px">
                        <i class="fas fa-thumbs-up" style="margin-right: 10px"></i><span class="badge badge-light">{{ $video->likes }}</span>
                    </button>
                    <button type="button" class="btn btn-danger" style=" margin-bottom: 14px">
                        <i class="fas fa-thumbs-down" style="margin-right: 10px"></i><span class="badge badge-light">{{$video->dislikes}}</span>
                    </button>
                    <button type="button" class="btn btn-secondary" style="margin-bottom: 30px">
                        <i class="fas fa-eye" style="margin-right: 10px"></i><span class="badge badge-light">{{ $video->nbWatch }}</span>
                    </button>
                    @if($profile->id == \Illuminate\Support\Facades\Auth::id())
                        <div class="profile-userbuttons">
                            <a href="{{ route('video_destroy', $video->id) }}"><button type="submit" class="btn btn-warning btn-sm" style="vertical-align: bottom"><i class="fas fa-trash-alt" style="margin-right: 10px"></i>Supprimer le profil</button></a>
                        </div>
                    @endif
                </div>
            </div>
            <hr />
            @endforeach
        </div>
    </div>
@endsection
