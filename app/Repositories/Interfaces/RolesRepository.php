<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RolesRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface RolesRepository extends RepositoryInterface
{
    public function all($columns = ['*']);
    public function find($id, $columns = ['*']);
    public function show($id);
    public function showPermission();
    public function deleteRole($id);
    public function rolePermissions($id);
    public function deletePermission_role($id);
    public function checkName($name);
    public function create(array $attributes);
    public function update(array $attributes, $id);
}
