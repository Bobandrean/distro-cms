<?php

namespace App\Services;

use App\Repositories\TicketRepository;

class TicketService
{
    /**
     * @var TicketRepository
     */
    private $ticketRepository;

    /**
     * TicketService constructor.
     * @param TicketRepository $ticketRepository
     */

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function datatable($request)
    {
        return $this->ticketRepository->datatable($request);
    }
}
