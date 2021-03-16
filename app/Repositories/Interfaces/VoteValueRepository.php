<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VoteValueRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface VoteValueRepository extends RepositoryInterface
{
    public function all($columns = ['*']);
    public function find($id, $columns = ['*']);
    public function create(array $attributes);
    public function update(array $attributes, $id);
    public function delete($id);
    public function bookingSeat($filmId,$bookingSeat);
    public function bookingVip($filmId,$name,$roomId,$userId);
    public function userBook($filmId,$userId);
    public function getSeatDoneBook($filmId,$userId);
    public function getSeatNull($filmId);
    public function doneRandom($filmID,$name);


}
