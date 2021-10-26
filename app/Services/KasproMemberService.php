<?php

namespace App\Services;

use App\Repositories\KasproMemberRepository;

class KasproMemberService
{
    /**
     * @var KasproMemberRepository

     */
    private $kasproMemberRepository;

    /**
     * KasproMemberService constructor.
     * @param KasproMemberRepository $kasproMemberRepository
     */

    public function __construct(KasproMemberRepository $kasproMemberRepository)
    {
        $this->kasproMemberRepository = $kasproMemberRepository;
    }


    public function getByUserId($userId)
    {
        return $this->kasproMemberRepository->getByUserId($userId);
    }
}
