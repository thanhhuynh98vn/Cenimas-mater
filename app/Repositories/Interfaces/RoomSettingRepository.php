<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoomSettingRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface RoomSettingRepository extends RepositoryInterface
{
    public function showAlphabet();
    public function showRoom();
    public function create(array $attributes);
    public function showIndex();
    public function update(array $attributes, $id);
    public function checkUniqueAlphabet($roomId,$alphabetId);
    public function delete($id);
    public function showUser();
}

