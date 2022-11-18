<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->s) {
            $search = explode(' ' , $request->s);

            if(count($search) == 1){
                $books = Book::where('title', 'like', '%'.$request->s.'%');
            } else{
                $books = Book::where('title', 'like', '%'.$search[0]. '%' .$search[1] . '%')
                ->orWhere('title', 'like', '%'.$search[1]. '%' .$search[0] . '%')
                ->orWhere('title', 'like', '%'.$search[0]. '%')
                ->orWhere('title', 'like', '%'.$search[1]. '%');
            }
        } else {
            $books = Book::where('id', '>', 0);
        }


        // Sort
        if ($request->sort == 'title_asc') {
            $books->orderBy('title');
        }
        else if ($request->sort == 'title_desc') {
            $books->orderBy('title', 'desc');
        }
        else if ($request->sort == 'pages_asc') {
            $books->orderBy('pages');
        }
        else if ($request->sort == 'pages_desc') {
            $books->orderBy('pages', 'desc');
        }


        return view('book.index',[
            'books' => $books->get(),
            'sort' => $request->sort ?? '0',
            'sortSelect' => Book::SORT_SELECT,
            's' => $request->s ?? '0',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create',[
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' =>'required|min:1|max:63',
            'description' =>'required|max:300',
            'ISBN' =>'required|min:13|max:13',
            'pages' =>'required|min:1|max:4',
            'category_id' =>'required',
            'photo.*' => 'sometimes|required|mimes:jpg|max:3000',
        ]);

        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'ISBN' => $request->ISBN,
            'pages' => $request->pages,
            'category_id' => $request->category_id,
        ])->addImages($request->file('photo'));

        return redirect()->route('b_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', [
            'book' => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book,
            'categories' => Category::orderBy('name')->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' =>'required|min:1|max:63',
            'description' =>'required|max:300',
            'ISBN' =>'required|min:13|max:13',
            'pages' =>'required|min:1|max:4',
            'category_id' =>'required',
            'photo.*' => 'sometimes|required|mimes:jpg|max:3000',
        ]);

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'ISBN' => $request->ISBN,
            'pages' => $request->pages,
            'category_id' => $request->category_id,
        ]);
        $book->removeImages($request->delete_photo)
        ->addImages($request->file('photo'));

        return redirect()->route('b_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if($book->getPhotos()->count()){
            $delIds = $book->getPhotos()->pluck('id')->all();
            $book->removeImages($delIds);
        }
        $book->delete();
        return redirect()->route('b_index');
    }
}
