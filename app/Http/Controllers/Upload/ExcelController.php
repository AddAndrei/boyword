<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upload\UploadRequest;
use App\Http\Services\Upload\UploadExcelService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
/**
 * Class ExcelController
 * @package App\Http\Controllers\Upload
 *
 * @author Shcerbakov Andrei
 */
class ExcelController extends Controller
{
    public function __construct(private UploadExcelService $service)
    {
    }

    #[Route("/api/excel/upload", methods: ["POST"])]
    public function upload(UploadRequest $request): Application|ResponseFactory|Response
    {
        try {
            $this->service->upload($request);
            return response(null, SymfonyResponse::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            return $this->jsonException($e);
        }
    }
}
