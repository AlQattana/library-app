<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {

            $books = Book::all();
            if (count($books) === 0) {
                throw new \Exception('Books not found');
            }

            return response()->json([
                'success' =>  true,
                'message' => '',
                'data' => $books
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' =>  false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'srn' => 'required',
            'pages_count' => 'required|integer',
            'published_at' => 'required|date',
            'category' => 'required',
            'author' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->getMessages();
        }

        $ctg =  Category::where('name', $data['category'])->first();
        if (!$ctg) {
            return response()->json([
                'success' =>  false,
                'message' => 'Category not found',
            ], 404);
        }

        $author = Author::where('name', 'like', '%'.$data['author'].'%')->first();
        if (!$author) {
            return response()->json([
                'success' =>  false,
                'message' => 'Author not found',
            ], 404);
        }

//        Book::create([
//
//        ]);

        // Create the book
        $book = new Book();
        $book->name = $data['name'];
        $book->srn = $data['srn'];
        $book->pages_count = $data['pages_count'];
        $book->published_at = $data['published_at'];
        $book->category_id = $ctg->id;
        $book->author_id = $author->id;
        $book->publisher_id = 1;
        $book->save();

        return response()->json([
            'success' =>  true,
            'message' => 'Book has been created successfully',
            'data' => $book
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
