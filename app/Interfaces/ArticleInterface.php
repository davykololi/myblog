<?php 

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleInterface
{
	/**
	 * Get all records
	 * 
	 * @return Collection
	 */
	public function all(): Collection;

	/**
	 * Get all all paginated data
	 * 
	 * @param integer $perPage
	 * @return LengthAwarePaginator
	 */
	public function paginate(int $perPage = 10): LengthAwarePaginator;

	/**
	 * Get all records
	 * 
	 * @return Collection
	 */
	public function authArticles();

	/**
	 * Create a record
	 * 
	 * @param array $data
	 * @return Model | null
	 */
	public function create(array $data);

	/**
	 * Get a record
	 * 
	 * @param integer $id
	 * @return Model | null
	 */
	public function getId(int $id);

	/**
	 * Update a record
	 * 
	 * @param array $data
	 * @param integer $id
	 * @return Model | null
	 */
	public function update(array $data,$id);

	/**
	 * Delete a record
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	public function delete($id): bool;

	public function randonmPublishedTwo();

	public function latestPublishedFive();

	public function articleSlug(string $slug);

	public function allPublishedArticles();
}