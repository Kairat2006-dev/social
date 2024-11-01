<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostImage;
use App\Service\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        try {
            DB::beginTransaction();
            $data = $request->validationData();

            $post = PostService::store($data);

            return PostResource::make($post);
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 500);
        }


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
