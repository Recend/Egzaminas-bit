<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Order;
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

        $name=$request->session()->get('find_book',null);
        $books = Book::findByName($name)->get();
        $orders=Order::all();
        $favorites=Favorite::all();
        return view('books.index',['books'=>$books,
            'findBook'=>$name,
            'orders'=>$orders,
            'favorites'=>$favorites
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $books = new Book();
        $books->name=$request->name;
        $books->summary=$request->summary;
        $books->ISBN=$request->ISBN;
        $books->pages=$request->pages;
        $books->category_id=$request->category_id;

        if($request->file('photo')!=null) {
            $foto = $request->file('photo');
            $fotoname = $request->id . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $books->photo=$fotoname;
        }
        $books->save();
        return redirect()->route('books.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', ['book'=>$book, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->name=$request->name;
        $book->summary=$request->summary;
        $book->ISBN=$request->ISBN;
        $book->pages=$request->pages;
        $book->category_id=$request->category_id;

        if($request->file('photo')!=null) {
            $foto = $request->file('photo');
            $fotoname = $request->id . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $book->photo=$fotoname;
        }
        $book->save();
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        unlink( storage_path('/app/images/'.$book->photo));
        $book->delete();
        return redirect()->route('books.index');
    }

    public function display($name,Request $request){
        $file=storage_path('app/images/'.$name);
        return response()->file( $file );
    }

    public function findBook(Request $request){
        $request->session()->put('find_book',$request->name);
        return redirect()->route('books.index');
    }


    public function placeOrder(Request $request, $add)
    {
        $order= new Order();
        $order->user_id=$request->user_id;
        $order->book_id=$request->book_id;
        $order->status=$request->status;
        $order->save();
        return redirect()->route('books.index');
    }


    public function placeFavorite(Request $request, $add)
    {
        $fav= new Favorite();
        $fav->user_id=$request->user_id;
        $fav->book_id=$request->book_id;
        $fav->save();
        return redirect()->route('books.index');
    }


 public function placeUnorder(Request $request, Order $order)
{
    $order->user_id=$request->user_id;
    $order->book_id=$request->book_id;
    $order->save();
    return redirect()->route('books.index');
}
}


