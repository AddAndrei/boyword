<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upload\UploadRequest;
use App\Http\Services\Rows\RowService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExcelController
 * @package App\Http\Controllers\Upload
 *
 * @author Shcerbakov Andrei
 */
class ExcelController extends Controller
{
    public function __construct(private RowService $service)
    {
    }

    #[Route("/api/excel/upload", methods: ["POST"])]
    public function upload(UploadRequest $request): Application|ResponseFactory|Response
    {
        $this->service->upload($request);
        return response(null, SymfonyResponse::HTTP_NO_CONTENT);
    }
}
