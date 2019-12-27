<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\Publisher;


class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return view('admin.books.index')->with([
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();

        
        return view('admin.books.create')->with([
            'publishers' => $publishers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cover' => 'required|file|image',
            // |dimensions:width=300,height=400
            'title' => 'required|max:191',
            'author' => 'required|max:191',
            'publisher_id' => 'required',
            'year' => 'required|integer|min:1900',
            'isbn' => 'required|alpha_num|size:13|unique:books',
            'price' => 'required|numeric|min:0',
        ]);

        $cover = $request->file('cover');
        $extension = $cover->getClientOriginalExtension();
        $filename = date('Y-m-d-His') . '_' . $request->input('isbn') . '.' . $extension;
        $path = $cover->storeAs('public/covers', $filename);

        $book = new Book();
        $book->cover = $filename;
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher_id = $request->input('publisher_id');
        $book->year = $request->input('year');
        $book->isbn = $request->input('isbn');
        $book->price = $request->input('price');

        $book->save();

        $request->session()->flash('success', 'Book added successfully');

        return redirect()->route('admin.books.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $reviews = $book->reviews()->get();

        return view('admin.books.show')->with([
            'book' => $book,
            'reviews' => $reviews
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $publishers = Publisher::all();

        return view('admin.books.edit')->with([
            'book' => $book,
            'publishers' => $publishers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'cover' => 'file|image',
            'title' => 'required|max:191',
            'author' => 'required|max:191',
            'publisher_id' => 'required',
            'year' => 'required|integer|min:1900',
            'isbn' => 'required|alpha_num|size:13|unique:books,isbn,'.$book->id,
            'price' => 'required|numeric|min:0',
        ]);

        if($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $extension = $cover->getClientOriginalExtension();
            $filename = date('Y-m-d-His') . '_' . $request->input('isbn') . '.' . $extension;
            $path = $cover->storeAs('public/covers', $filename);

            Storage::delete("public/covers/{$book->cover}");
            $book->cover = $filename;
        }

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher_id = $request->input('publisher_id');
        $book->year = $request->input('year');
        $book->isbn = $request->input('isbn');
        $book->price = $request->input('price');

        $book->save();

        $request->session()->flash('info', 'Book updated successfully');

        return redirect()->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        Storage::delete("public/covers/{$book->cover}");
        
        $book->delete();

        $request->session()->flash('danger', 'Deleted book');

        return redirect()->route('admin.books.index');
    }
}
