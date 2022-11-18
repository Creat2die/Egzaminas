<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{



    public function homeList(Request $request)
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
