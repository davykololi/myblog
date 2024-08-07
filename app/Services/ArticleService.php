<?php

namespace App\Services;

use Auth;
use App\Repositories\ArticleRepository;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\ArticleFormRequest as StoreRequest;
use App\Http\Requests\ArticleFormRequest as UpdateRequest;

class ArticleService
{
	use ImageUploadTrait;
	protected $articleRepo;

	public function __construct(ArticleRepository $articleRepo)
	{
		$this->articleRepo = $articleRepo;
	}

	public function all()
	{
		return $this->articleRepo->all();
	}

	public function authArticles()
	{
		return $this->articleRepo->authArticles();
	}

	public function paginate($perPage)
	{
		return $this->articleRepo->paginate($perPage);
	}

	public function getId($id)
	{
		return $this->articleRepo->getId($id);
	}

	public function createData(StoreRequest $request)
	{
        if(Auth::user()->hasRole('author')){
        	$data = $request->validated();
        	$data['image'] = $this->verifyAndUpload($request,'image','/storage/');
        	$data['category_id'] = $request->category_id;
        	$data['user_id'] = auth()->user()->id;

        	return $data;
        }
	}

	public function updateData(UpdateRequest $request)
	{
        if(Auth::user()->hasRole('editor')){
        	$data = $request->validated();
        	$data['image'] = $this->verifyAndUpload($request,'image','/storage/');
        	$data['category_id'] = $request->category_id;
        	$data['is_published']  = $request->is_published;
        	$data['user_id'] = $request->user_id;
        	$data['published_by'] = Auth::user()->name;
        	$data['published_at'] = $request->published_at;

        	return $data;
        } elseif(Auth::user()->hasRole('author')){
        	$data = $request->validated();
        	$data['image'] = $this->verifyAndUpload($request,'image','/storage/');
        	$data['category_id'] = $request->category_id;
        	$data['user_id'] = auth()->user()->id;

        	return $data;
        }
	}

	public function createArticle(StoreRequest $request)
	{
		$data = $this->createData($request);

		return $this->articleRepo->create($data);
	}

	public function updateArticle(UpdateRequest $request,$id)
	{
		$data = $this->updateData($request,$id);

		return $this->articleRepo->update($data,$id);
	}

	public function deleteArticle($id)
	{
		return $this->articleRepo->delete($id);
	}
}