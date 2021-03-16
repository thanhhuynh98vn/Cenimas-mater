<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VoteRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface VoteRepository extends RepositoryInterface
{

    public function getVoteValue($id);
    public function getMonthVote();
    public function firstOrNew(array $attributes = []);
    public function getTopVote();
    public function winnerFilm();
    public function getFimTicket();
    public function registerTicket($user_id,$vote_value_id,$quantity);
    public function showUserTicket();
    public function showRooms();
    public function ajaxShowSeat($idRoom);
    public function maxSeatRow($idRoom);
    public function spaceRoom($idRoom);
    public function showUser();
    public function booking1Film($name,$filmId,$userId);
    public function bookingNfilm($filmId,$name,$userID);
    public function LoadSeatChecked($filmId,$roomId);
    public function checkSeatRandomNull($filmId);
}
