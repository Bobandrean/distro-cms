<?php

namespace App\Services;

use App\Repositories\NotificationRepository;

class NotificationService
{
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    /**
     * NotificationService constructor.
     * @param NotificationRepository $notificationRepository
     */

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function datatable($request)
    {
        return $this->notificationRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->notificationRepository->getById($id);
    }

    public function store($data)
    {
        return $this->notificationRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->notificationRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->notificationRepository->destroy($id);
    }
    public function export($request)
    {
        return $this->notificationRepository->export($request);
    }
}
