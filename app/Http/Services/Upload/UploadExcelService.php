<?php

namespace App\Http\Services\Upload;

use App\Http\Requests\Upload\UploadRequest;
use App\Models\Imports\RowImport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class UploadExcelService
 * @package App\Http\Services\Upload
 *
 * @author Shcerbakov Andrei
 */
class UploadExcelService
{
    /**
     * @param UploadRequest $request
     * @return void
     */
    public function upload(UploadRequest $request): void
    {
        Excel::queueImport(new RowImport, $request->file('file'));
    }
}
