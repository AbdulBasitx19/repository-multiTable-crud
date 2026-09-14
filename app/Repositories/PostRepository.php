<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Comment;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    
    protected Post $postModel;
    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    public function all(): Collection
    {
        return $this->postModel->with(['user', 'comments.user', 'tags'])->latest()->get();
    }

    public function find(int $id): ?Post 
    {
        return $this->postModel->with(['user', 'comments.user', 'tags'])->find($id);
    }

    public function create(array $data): Post 
    {
        return $this->postModel::create($data);
    }

    public function update(int $id , array $data): Post 
    {
        $post = $this->postModel->findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function delete(int $id): bool 
    {
        $post = $this->postModel->findOrFail($id);
        return $post->delete();
    }

    public function syncTags(int $postId, array $tagIds): void 
    {
        $post = $this->postModel->findOrFail($id);
        $post->tags()->sync($tagIds);
    }

    public function addComment(int $postId, array $commentData): Comment
    {
        $post = $this->postModel->findOrFail($postId);
        return $post->comments()->create($commentData);
    }


}
