<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getComments()
    {
    	$comments = Post::find(1)->comments->where('id', 1);
        return response()->json(['success' => 'Ok', 'data' => $comments],JsonResponse::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        if (!empty($request->input('limit'))) {
            $limit = $request->input('limit');
        }

        $query = new Post();
        if (!empty($request->input('title'))) {
            $query = $query->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }
        $data = $query->orderBy('id', 'DESC')->paginate($limit);

        return response()->json(['success' => 'Ok', 'data' => $data],JsonResponse::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        return Post::create($data);
    }

    public function updated($id, $data)
    {
        $post = Post::find($id);

        $post->user_id = $data['user_id'];
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->price = $data['price'];
        $post->save(); 

        return $post;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->user_id = 1;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->price = $request->price;
        $post->save();

        return response()->json(['success' => 'Ok', 'data' => $post],JsonResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Not exit'],JsonResponse::HTTP_BAD_REQUEST);
        }

        return response()->json(['success' => 'Ok', 'data' => $post],JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Not exit'],JsonResponse::HTTP_BAD_REQUEST);
        }

        $post->user_id = 1;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->price = $request->price;
        $post->save();
        return response()->json(['success' => 'Ok', 'data' => $post],JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Not exit'],JsonResponse::HTTP_BAD_REQUEST);
        }

        $post->delete();
        return response()->json(['message' => 'Ok'],JsonResponse::HTTP_OK); 
    }
}
