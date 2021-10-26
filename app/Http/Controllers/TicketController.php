<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $ticketService;
    private $request;

    public function __construct(Request $request, TicketService $ticketService)
    {
        $this->request = $request;
        $this->ticketService = $ticketService;
    }

    public function index()
    {
        $items = $this->ticketService->datatable($this->request);

        $request = $this->request;

        return view('contents.ticket.index', compact('items', 'request'));
    }
}
