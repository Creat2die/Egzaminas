@extends('layouts.app')

@section('content')

    <div style=" padding:10px">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h2>Pavadinimas</h2>
        </ul>
        @forelse($categories as $category)
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h4><a href="{{route('c_show', $category)}}" class="categoryTitle">{{$category->name}}</a></h4>
                <div class="col-sm-3" style="display:flex">
                    <a href="{{route('c_edit', $category)}}" class="btn btn-primary m-2">Edit</a>
                    <form action="{{route('c_delete', $category)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary m-2">DELETE</button>
                    </form>
                    <a href="{{route('c_show', $category)}}" class="btn btn-primary m-2">View</a>
                </div>
            </li>
            </li>
        </ul>
        @empty
        <li class="list-group-item">No Categories found</li>
        @endforelse
    </div>

@endsection
