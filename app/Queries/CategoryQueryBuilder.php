<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class CategoryQueryBuilder
{
    private Builder $model;
    public  function __construct()
    {
        $this->model = Category::query();
    }

    public function getCategory(): Collection|LengthAwarePaginator
    {
        return $this->model->paginate(config('pagination.admin.categories'));
    }

    public function create(array $data): Category|bool
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data): bool
    {
        return $category->fill($data)->save();
    }
}
