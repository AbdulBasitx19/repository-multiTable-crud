<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{
    protected TagService $tagService;
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(): View
    {
        $tags = $this->tagService->getAllTags();
        return view('tags.index', compact('tags'));
    }

    public function create(): View
    {
        return view('tags.create');
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->tagService->createTag($validatedData);
        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag successfully created!');
    }

    public function edit(int $id): View
    {
        $tag = $this->tagService->getTagById($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, int $id): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->tagService->updateTag($id, $validatedData);
        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag successfully updated!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->tagService->deleteTag($id);
        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag successfully deleted!');
    }

    public function posts(int $tagId): View
    {
        $tag = $this->tagService->getTagById($tagId);
        $posts = $this->tagService->getPostsByTag($tagId);
        return view('tags.posts', compact('tag', 'posts'));
    }
}