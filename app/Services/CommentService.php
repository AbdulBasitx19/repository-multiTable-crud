<?php

namespace App\Services;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    /**
     * Create a new class instance.
     */
    protected CommentRepositoryInterface $commentRepository;
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }


    public function getCommentsByPost(int $postId): Collection
    {
        return $this->commentRepository->getByPost($postId);
    }

    public function getCommentById(int $id): ?Comment
    {
        return $this->commentRepository->find($id);
    }

    public function createComment(array $data): Comment
    {
        return $this->commentRepository->create($data);
    }

    public function updateComment(int $id, array $data): Comment
    {
        return $this->commentRepository->update($id, $data);
    }

    public function deleteComment(int $id): bool
    {
        return $this->commentRepository->delete($id);
    }
}
