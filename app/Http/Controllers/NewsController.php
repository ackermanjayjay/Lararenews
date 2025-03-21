<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request -> query('page', 1);
        $perPage = 6;
        $response = Http::get("http://127.0.0.1:8000/?page={$page}&per_page={$perPage}");
        
        // Check if request was successful
        if ($response->successful()) {
            $data = $response->json();
            $newsData = $data['news'];
            $total = $data['total'];
        } else {
            $newsData = [];
            $total = 0;
        }
        $news = new LengthAwarePaginator(
            $newsData,
            $total,
            $perPage,
            $page,
            ['path' => url('/news')] // Preserve pagination links
        );

        // Pass data to the view
        return view('index', compact('news'));

        // $basic =  Http::get("http://127.0.0.1:8000/");
         // dd($basic->body());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       
    }
    public function searchNews(Request $request)
    {
        $search = $request->query('search', '');
        $page = $request -> query('page', 1);
        $perPage = 6;
        $response = Http::get("http://127.0.0.1:8000/news/text?q={$search}?&page={$page}&per_page={$perPage}");

        // Check if request was successful
        if ($response->successful()) {
            $data = $response->json();
            $newsData = $data['news'];
            $total = $data['total'];
        } else {
            $newsData = [];
            $total = 0;
        }
        $news = new LengthAwarePaginator(
            $newsData,
            $total,
            $perPage,
            $page,
            ['path' => url('/news/text'), 'query' => ['search' => $search]]
        );

        // Pass data to the view
        return view('news_search', compact('news', 'search'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
