<?php

namespace App\Interfaces;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    public function getByPost(int $postId): Collection;
    public function find(int $id): ?Comment;
    public function create(array $data): Comment;
    public function update(int $id, array $data): Comment;
    public function delete(int $id): bool;
}