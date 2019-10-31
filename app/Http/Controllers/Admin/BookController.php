<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;

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
        return view('admin.books.create');
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
            'title' => 'required|max:191',
            'author' => 'required|max:191',
            'publisher' => 'required|max:191',
            'year' => 'required|integer|min:1900',
            'isbn' => 'required|alpha_num|size:13|unique:books',
            'price' => 'required|numeric|min:0',
        ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->year = $request->input('year');
        $book->isbn = $request->input('isbn');
        $book->price = $request->input('price');

        $book->save();

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

        return view('admin.books.show')->with([
            'book' => $book
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

        return view('admin.books.edit')->with([
            'book' => $book
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
            'title' => 'required|max:191',
            'author' => 'required|max:191',
            'publisher' => 'required|max:191',
            'year' => 'required|integer|min:1900',
            'isbn' => 'required|alpha_num|size:13|unique:books,isbn,'.$book->id,
            'price' => 'required|numeric|min:0',
        ]);

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->year = $request->input('year');
        $book->isbn = $request->input('isbn');
        $book->price = $request->input('price');

        $book->save();

        return redirect()->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.books.index');
    }
}
