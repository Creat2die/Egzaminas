@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <form action="{{route('b_index')}}" method="get">
                <div class="container">
                    <div class="row">
                        <div class="col-5">
                            <select name="sort" class="form-select mt-1">
                                <option value="0">All</option>
                                @foreach($sortSelect as $option)
                                <option value="{{$option[0]}}" @if($sort==$option[0]) selected @endif>{{$option[1]}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="input-group-text mt-1">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <form action="{{route('b_index')}}" method="get">
                <div class="container">
                    <div class="row">
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" name="s" class="form-control" placeholder="Search..." >
                                <button type="submit" class="input-group-text">Search</button>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="{{route('b_index')}}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="turinys">
    @forelse($books as $book)

    <div class="korta">
        <div class="card" >

            <div class="card-body">
                <h2 class="card-title">{{$book->title}}</h2>
                @if($book->getPhotos()->count())
                <div><img class="fit-picture" src="{{$book->lasImageUrl()}}" height="150"></div>
                @endif
                <h4><b>Category:</b> {{$book->getCategory->name}}</h4>
                <h4><b>ISBN:</b> {{$book->ISBN}}</h4>
                <h4><b>Pages:</b> {{$book->pages}}</h4>
                <h5><b>Description:</b><br> {{$book->description}}</h4>
                <div class="mygtukai">
                @if(Auth::user()->role >= 10)
                <a href="{{route('b_edit', $book)}}" class="btn btn-primary m-2">Edit</a>
                <form action="{{route('b_delete', $book)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary m-2">DELETE</button>
                </form>
                <a href="{{route('b_show', $book)}}" class="btn btn-primary m-2">View</a>
                @endif
                </div>
                <div class="mygtukai">
                                <a href="" class="btn btn-primary m-2">Reserve</a>
                <a href="" class="btn btn-primary m-2">Add to Wishlist</a>
            </div>
            </div>
        </div>
    </div>

    @empty
    <div class="col-5 turinys">
    <li class="list-group-item">No Books found</li>
    </div>
    @endforelse
</div>

@endsection
