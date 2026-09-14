<?php

namespace App\Interfaces;

use App\Models\Post;
use \App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Post;
    public function create(array $data): Post;
    public function update(int $id, array $data): Post;
    public function delete(int $id): bool;
    public function syncTags(int $postId, array $tagIds): void;
    public function addComment(int $postId, array $commentData): Comment;

}