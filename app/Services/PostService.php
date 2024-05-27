<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPaginated($pages = 4)
    {
        return $this->postRepository->paginate($pages);
    }

    public function findById($id)
    {
        return $this->postRepository->find($id);
    }

    public function createPost(array $data)
    {
        return $this->postRepository->create($data);
    }

    public function updateById(array $data, $id)
    {
        return $this->postRepository->update($data, $id);
    }

    public function deleteById($id)
    {
        return $this->postRepository->delete($id);
    }
    public function getTrash()
    {
        return $this->postRepository->getTrash();
    }
}
