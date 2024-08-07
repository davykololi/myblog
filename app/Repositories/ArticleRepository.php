<?php

namespace App\Repositories;

use App\Interfaces\ArticleInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\ArticleException\ArticleNotFoundException;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleRepository implements ArticleInterface
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected ?Article $model)
    {
    }

    /**
     * Return new instance of the Query Builder for this model.
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function all(): Collection
    {
        return $this->model->eagerLoaded()->latest('id')->all();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->eagerLoaded()->latest('id')->paginate($perPage);
    }

    public function authArticles()
    {
        return auth()->user()->articles()->eagerLoaded()->latest('id')->paginate(2);
    }

    public function create(array $data)
    {
        return $this->query()->create($data);
    }

    public function getId(int $id)
    {  
        return $this->model->findOrFail($id);
    }

    public function update(array $data,$id)
    {
        $record = $this->getId($id);
        return $record->update($data);
    }

    public function delete($id): bool
    {
        $data = $this->model->find($id);
        return $data->delete();
    }

    public function randonmPublishedTwo()
    {
        return $this->query()->model->eagerLoaded()->published()->inRandomOrder()->take(2)->get();
    }

    public function latestPublishedFive()
    {
        return $this->query()->model->eagerLoaded()->latest()->published()->take(5)->get();
    }

    public function articleSlug(string $slug)
    {
        try {
            // the published_at + is_published are handled by BlogEtcPublishedScope, and don't take effect if the
            // logged in user can manage log posts
            return $this->query()->model->eagerLoaded()->published()->whereSlug($slug)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new ArticleNotFoundException('Unable to find blog post with slug: '.$slug);
        } 
    }

    public function allPublishedArticles()
    {
        return $this->query()->model->eagerLoaded()->published()->latest()->get();
    }
}