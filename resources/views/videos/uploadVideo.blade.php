@extends('layouts.app')
@section('content')
@if (session('video_extension_error'))
    <div class="alert alert-warning">
        La miniature doit être une image en png ou jpg.
        <br>
        La vidéo doit être de type mp4.
    </div>
@endif
@if (session('video_error'))
    <div class="alert alert-warning">
        Une erreur est survenue !
    </div>
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Partager une vidéo') }}</div>
                    <form method="post" action="{{ route('video_upload') }}" enctype="multipart/form-data" style="margin: 5px">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="miniature" name="miniature">
                            <label class="custom-file-label" for="miniature">Changer d'avatar</label>
                        </div>
                        <div class="custom-file" style="margin-top:10px">
                            <input type="file" class="custom-file-input" id="video" name="video" required>
                            <label class="custom-file-label" for="video">Choisir la vidéo</label>
                        </div>
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control" id="title" placeholder="Titre putaclic" name="title" value="{{ $profile ?? '' ? $profile->title : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Description" name="description" value="{{ $videos ?? '' ? $videos->description : '' }}" required></textarea>
                        </div>
                        <input type="hidden" name="id" value="">
                        @csrf
                        <button type="submit" class="btn btn-primary">Mettre en ligne</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection