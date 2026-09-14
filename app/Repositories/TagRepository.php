<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Interfaces\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TagRepository
{
    /**
     * Create a new class instance.
     */
     protected Tag $tagModel;

    public function __construct(Tag $tagModel)
    {
        $this->tagModel = $tagModel;
    }
    public function all(): Collection
    {
        return $this->tagModel->latest()->get();
    }

    public function find(int $id): ?Tag
    {
        return $this->tagModel->find($id);
    }

    public function create(array $data): Tag
    {
        return $this->tagModel->create($data);
    }

    public function update(int $id, array $data): Tag
    {
        $tag = $this->tagModel->findOrFail($id);
        $tag->update($data);
        return $tag;
    }

    public function delete(int $id): bool
    {
        $tag = $this->tagModel->findOrFail($id);
        return $tag->delete();
    }
    public function getPostsByTag(int $tagId): Collection
    {
        $tag = $this->tagModel->findOrFail($tagId);
        return $tag->posts()->with(['user', 'comments.user', 'tags'])->latest()->get();
    }
}
