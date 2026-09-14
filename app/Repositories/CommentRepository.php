<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    protected Comment $commentModel; 

    public function __construct(Comment $commentModel)
    {
        $this->$commentModel = $commentModel;
    }

    public function getByPost(int $postId): Collection
    {
          return $this->commentModel->where('post_id', $postId)->with('user')->latest()->get();
    }

    public function find(int $id): ?Comment
    {
        return $this->commentModel->with('user')->find($id);
    }

    public function create(array $data): Comment
    {
        return $this->commentModel->create($data);
    }

    public function update(int $id, array $data): Comment
    {
        $comment = $this->commentModel->findOrFail($id);
        $comment->update($data);
        return $comment;
    }

    public function delete(int $id): bool
    {
        $comment = $this->commentModel->findOrFail($id);
        return $comment->delete();
    }

}
