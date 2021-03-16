<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PostRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface PostRepository extends RepositoryInterface
{
    public function create(array $attributes);
    public function all($columns = ['*']);
    public function firstOrNew(array $attributes = []);
    public function find($id, $columns = ['*']);
    public function editTag($id);
    public function update(array $attributes, $id);
}
