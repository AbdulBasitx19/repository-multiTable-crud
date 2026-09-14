<?php

namespace App\Services;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagService
{
    /**
     * Create a new class instance.
     */
    protected TagRepositoryInterface $tagRepository;
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTags(): Collection
    {
        return $this->tagRepository->all();
    }

    public function getTagById(int $id): ?Tag
    {
        return $this->tagRepository->find($id);
    }

    public function createTag(array $data): Tag
    {
        return $this->tagRepository->create($data);
    }
    public function updateTag(int $id, array $data): Tag
    {
        return $this->tagRepository->update($id, $data);
    }

    public function deleteTag(int $id): bool
    {
        return $this->tagRepository->delete($id);
    }

    public function getPostsByTag(int $tagId): Collection
    {
        return $this->tagRepository->getPostsByTag($tagId);
    }

}
