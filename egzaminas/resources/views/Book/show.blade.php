@extends('layouts.app')

@section('content')

<div class="turinys justify-content-center">
    <div class="turinys">
        <div class="korta">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <h2 class="card-title">{{$book->title}}</h2>
                    @if($book->getPhotos()->count())
                    <div><img class="fit-picture" src="{{$book->lasImageUrl()}}" height="350"></div>
                    @endif
                    <h4><b>Category:</b> {{$book->getCategory->name}}</h4>
                    <h4><b>ISBN:</b> {{$book->ISBN}}</h4>
                    <h4><b>Pages:</b> {{$book->pages}}</h4>
                    <h5><b>Description:</b><br> {{$book->description}}</h4>
                    <a href="{{url()->previous()}}" class="btn btn-primary m-2">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
