<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface UserRepository extends RepositoryInterface
{
    public function all($columns = ['*']);
    public function find($id, $columns = ['*']);
    public function delete($id);
    public function update(array $attributes, $id);
    public function showRole();
    public function rolePermissions($id);
    public function deleteUser_role($id);
    public function checkEmail($email);
    public function exportExcel();
    public function create(array $attributes);

}
