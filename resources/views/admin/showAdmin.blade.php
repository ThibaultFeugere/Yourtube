@extends('layouts.app')
@section('content')
    <!-- Modal -->
    @if (session('report_approved'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Signalement appouvé avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('report_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Signalement supprimé avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('comment_approved'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Commentaire approuvé avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('comment_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Commentaire supprimé avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('role_updated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Role de l'utilisateur mis à jour avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        {{-- Videos block --}}
        <div class="row justify-content-center mb-3">
            <div class="card table-responsive">
                <div class="card-header"><i class="fas fa-video"></i> Vidéos en attente</div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Miniature</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <td><a href="{{route('video_show', $video->id)}}" target="_blank"><img src="{{asset('storage/' . $video->miniature)}}" width="100"></a></td>
                            <td><a href="{{route('video_show', $video->id)}}" target="_blank">{{ucfirst($video->title)}}</a></td>
                            <td>{{$video->description}}</td>
                            <td>
                                <a href="{{ route('video_approve', $video->id) }}">
                                    <button type="button" class="btn btn-success"><i
                                            class="fas fa-check"></i>
                                    </button>
                                </a>
                                <a href="{{route('video_destroy', $video->id)}}">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Reports block --}}
        <div class="row justify-content-center mb-3">
            <div class="card table-responsive">
                <div class="card-header"><i class="fas fa-flag"></i> Derniers signalements</div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Vidéo</th>
                        <th scope="col">Signalement</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
{{--                        @php(dd($reports))--}}
                        <tr>
                            <td><a href="{{route('profile_show', $report->name)}}" target="_blank">{{$report->name}}</a></td>
                            <td><a href="{{route('video_show', $report->video_id)}}" target="_blank">{{$report->title}}</a></td>
                            <td>{{$report->content}}</td>
                            <td>
                                <a href="{{ route('report_approve', $report->report_id) }}">
                                    <button type="button" class="btn btn-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </a>
                                <a href="{{ route('report_destroy', $report->report_id) }}">
                                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Supprimer le signalement">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Comments block --}}
        <div class="row justify-content-center mb-3">
            <div class="card table-responsive">
                <div class="card-header"><i class="fas fa-comments"></i> Derniers commentaires</div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Vidéo</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td><a href="{{route('profile_show', $comment->name)}}" target="_blank">{{$comment->name}}</a></td>
                            <td><a href="{{route('video_show', $comment->id)}}" target="_blank">{{$comment->title}}</a></td>
                            <td>{{$comment->content}}</td>
                            <td>
                                <a href="{{route('comment_approve', $comment->comment_id)}}">
                                    <button type="button" class="btn btn-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </a>
                                <a href="{{route('comment_destroy', $comment->comment_id)}}">
                                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Supprimer le commentaire">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Users block --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card table-responsive">
                    <div class="card-header"><i class="fas fa-users"></i> Liste utilisateurs</div>
                    <div class="card-body">
                        @foreach ($profile as $profiler)
                            <div class="modal fade" id="delete_user" tabindex="-1" role="dialog"
                                 aria-labelledby="delete_user" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Supprimer l'utilisateur</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post"
                                              action="{{ route('admin_profile_destroy', $profiler->id) }}">
                                            <div class="modal-body">
                                                <h6>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</h6>
                                            </div>
                                            <input type="hidden" name="id" value="">
                                            @csrf
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-flag"
                                                                                                style="margin-right: 10px"></i>Supprimer
                                                    !
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                @if(strlen($profiler->avatar) > 0)
                                    <img src="{{ asset('storage/' . $profiler->avatar) }}" class="mr-3" alt="miniature"
                                         width="80" height="80">
                                @else
                                    <img src="https://static.asianetnews.com/img/default-user-avatar.png"
                                         class="mr-3" width="80" height="80" style="border-radius: 100%">
                                @endif
                                <div class="media-body" style="text-overflow:  ellipsis;  overflow: hidden !important;">
                                    <h5 class="mt-1"><b
                                            style="text-transform: capitalize">{{ $profiler->role_name }}</b>
                                        | {{ $profiler->name }}</h5>

                                    <h6 class="mt-1">{{ $profiler->email }}</h6>
                                    <p>
                                        {{ $profiler->dateOfBirth }}
                                    </p>
                                    <p>
                                        Crée le : {{ $profiler->created_at }}
                                    </p>
                                </div>
                                <div class="text-center" style="width: 30%;">
                                    <form method="post" action="{{route('role_update', $profiler->id)}}">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Éditer le rôle</label>
                                            <select class="form-control d-inline" id="exampleFormControlSelect1"
                                                    style="width: 70%" name="roles">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="id" value="">
                                            @csrf
                                            <button type="submit" class="btn btn-primary float-right d-inline">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <a href="{{ route('profile_show', $profiler->name) }}">
                                        <button type="button" class="btn btn-success" style=" margin: 5px">
                                            <i class="fas fa-user"></i>
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#delete_user">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <hr/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card table-responsive">
                    <div class="card-header">
                        <i class="fas fa-tags"></i> Catégories
                        <div class="float-lg-right">
                            <button type="button" class="btn" data-toggle="modal"
                                    data-target="#addCategorie">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($categories as $categorie)
                                <li>{{$categorie->title}} <a href="{{route('category_delete', $categorie->id)}}"><i class="fas fa-times"></i></a> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('category_create')}}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Nom de la catégorie</span>
                            </div>
                            <input type="text" class="form-control" name="category" id="basic-url"
                                   aria-describedby="basic-addon3">
                        </div>
                    </div>
                    @csrf
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
