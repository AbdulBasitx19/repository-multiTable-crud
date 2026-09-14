<?php

namespace App\Interfaces;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

interface TagRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Tag;
    public function create(array $data): Tag;
    public function update(int $id, array $data): Tag;
    public function delete(int $id): bool;
    public function getPostsByTag(int $tagId): Collection;
}