<?php

namespace App\Services;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    /**
     * Create a new class instance.
     */
    protected PostRepositoryInterface $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts(): Collection
    {
        return $this->postRepository->all();
    }

    public function getPostById(int $id): ?Post
    {
        return $this->postRepository->find($id);
    }

    public function createPost(array $data): Post
    {
        $post = $this->postRepository->create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        // Step 2: Tags sync 
        if (isset($data['tags']) && !empty($data['tags'])) {
            $this->postRepository->syncTags($post->id, $data['tags']);
        }

        // Step 3: Initial comments add 
        if (isset($data['comments']) && !empty($data['comments'])) {
            foreach ($data['comments'] as $commentData) {
                $this->postRepository->addComment($post->id, $commentData);
            }
        }

        // Step 4: Fresh post return with all relationships loaded
        return $this->postRepository->find($post->id);
    }

    public function updatePost(int $id, array $data): Post
    {
        $post = $this->postRepository->update($id, [
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        if (isset($data['tags'])) {
            $this->postRepository->syncTags($id, $data['tags']);
        }

        return $this->postRepository->find($id);
    }
    public function deletePost(int $id): bool
    {
        return $this->postRepository->delete($id);
    }

    public function addCommentToPost(int $postId, array $commentData): Comment
    {
        return $this->postRepository->addComment($postId, $commentData);
    }



}
