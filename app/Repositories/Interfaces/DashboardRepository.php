<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface DashboardRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface DashboardRepository extends RepositoryInterface
{
    public function showDasboard();
    public function totalTicker();
    public function ticketDone();
    public function doneBook();
}
