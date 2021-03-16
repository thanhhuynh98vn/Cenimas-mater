<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoomRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface RoomRepository extends RepositoryInterface
{
    public function all($columns = ['*']);
    public function getNameCinemas();
    public function create(array $attributes);
    public function getCinemas();
    public function find($id, $columns = ['*']);
    public function update(array $attributes, $id);
    public function delete($id);
}
