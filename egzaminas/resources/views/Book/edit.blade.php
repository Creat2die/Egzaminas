@extends('layouts.app')

@section('content')


<div class="turinys justify-content-center">

    <div class="korta">
        <div class="card" style="width: 30rem;">
            <div class="card-body">

                <h2 class="card-title">Edit Book: {{$book->title}}</h2>
                <form action="{{route('b_update', $book)}}" method="post" enctype="multipart/form-data">
                    @error('title')
                    <div style="color:crimson">{{$message}}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Title</span>
                        <input type="text" class="form-control" name="title" value="{{old('title', $book->title)}}">
                    </div>

                    @error('description')
                    <div style="color:crimson">{{$message}}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Description</span>
                        <input type="text" class="form-control" name="description" value="{{old('description', $book->description)}}">
                    </div>

                    @error('ISBN')
                    <div style="color:crimson">{{$message}}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">ISBN</span>
                        <input type="text" class="form-control" name="ISBN" value="{{old('ISBN', $book->ISBN)}}">
                    </div>

                    @error('pages')
                    <div style="color:crimson">{{$message}}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Pages</span>
                        <input type="text" class="form-control" name="pages" value="{{old('pages', $book->pages)}}">
                    </div>

                    <div data-clone class="input-group mt-3">
                        <span class="input-group-text">Photo</span>
                        <input type="file" name="photo[]" multiple class="form-control">
                    </div>
                    <h3 class=" mt-3">Check (x) for delete photo</h3>
                    @forelse($book->getPhotos as $photo)
                    <div class="img mt-3">
                        <label for="{{$photo->id}}-del-photo">x</label>
                        <input type="checkbox" value="{{$photo->id}}" id="{{$photo->id}}-del-photo" name="delete_photo[]">
                        <img  src="{{$photo->url}} " width="150">
                    </div>
                    @empty
                    <h2>No photos yet</h2>
                    @endforelse


                    @error('category_id')
                    <div style="color:crimson">{{$message}}</div>
                    @enderror
                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text" id="basic-addon3">Restoran</span>
                        <select name="category_id">
                            @foreach($categories as $category)
                            <option  value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif >{{$category->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-secondary mt-4">Update</button>
                </form>
                <a href="{{route('b_index')}}" class="btn btn-info mt-3">Back</a>
            </div>
        </div>
    </div>
</div>

@endsection
