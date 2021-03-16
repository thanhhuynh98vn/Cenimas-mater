<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CinemasRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface CinemasRepository extends RepositoryInterface
{
    public function all($columns = ['*']);
    public function getCompanies();
    public function create(array $attributes);
    public function update(array $attributes, $id);
    public function find($id, $columns = ['*']);
    public function delete($id);
    public function subDelete($id);
}
