<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Responses\System\SystemResponse;
use App\Http\Services\System\SystemService;
use Symfony\Component\Routing\Attribute\Route;


class SystemController extends Controller
{
    private SystemService $service;
    public function __construct(SystemService $systemService)
    {
        $this->service = $systemService;
    }

    #[Route('/api/mm', methods: ["GET"])]
    public function showEntities(): SystemResponse
    {
        return SystemResponse::make($this->service->getAll());
    }

}
