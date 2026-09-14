<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \App\Models\Tag;

class PostController extends Controller
{
    protected PostService $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index(): View
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }
    public function create(): View
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }
    public function store(StorePostRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $post = $this->postService->createPost($validatedData);
        return redirect()
            ->route('posts.index')
            ->with('success', 'Post successfully created with tags and comments!');
    }

    public function edit(int $id): View
    {
        $post = $this->postService->getPostById($id);
        $tags = \App\Models\Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }
    public function update(UpdatePostRequest $request, int $id): RedirectResponse
    {
        $validatedData = $request->validated();
        $post = $this->postService->updatePost($id, $validatedData);
        return redirect()
            ->route('posts.index')
            ->with('success', 'Post successfully updated!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->postService->deletePost($id);
        return redirect()
            ->route('posts.index')
            ->with('success', 'Post successfully deleted!');
    }
}