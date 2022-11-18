<?php

namespace App\Http\Controllers;

use App\Models\BookImage;
use App\Http\Requests\StoreBookImageRequest;
use App\Http\Requests\UpdateBookImageRequest;

class BookImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookImage  $bookImage
     * @return \Illuminate\Http\Response
     */
    public function show(BookImage $bookImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookImage  $bookImage
     * @return \Illuminate\Http\Response
     */
    public function edit(BookImage $bookImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookImageRequest  $request
     * @param  \App\Models\BookImage  $bookImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookImageRequest $request, BookImage $bookImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookImage  $bookImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookImage $bookImage)
    {
        //
    }
}
