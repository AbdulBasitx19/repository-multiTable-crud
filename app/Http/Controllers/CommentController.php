<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index(int $postId): View
    {
        $comments = $this->commentService->getCommentsByPost($postId);
        return view('comments.index', compact('comments', 'postId'));
    }
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->commentService->createComment($validatedData);
        return redirect()
            ->back()
            ->with('success', 'Comment successfully added!');
    }

    public function edit(int $id): View
    {
        $comment = $this->commentService->getCommentById($id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment in storage.
     * (Comment ko update karna)
     */
    public function update(UpdateCommentRequest $request, int $id): RedirectResponse
    {
        $validatedData = $request->validated();
        $comment = $this->commentService->updateComment($id, $validatedData);
            return redirect()
            ->route('comments.index', $comment->post_id)
            ->with('success', 'Comment successfully updated!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $comment = $this->commentService->getCommentById($id);
        $postId = $comment->post_id;
        $this->commentService->deleteComment($id);
        return redirect()
            ->route('comments.index', $postId)
            ->with('success', 'Comment successfully deleted!');
    }
}