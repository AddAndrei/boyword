<?php

namespace App\Http\Services\Rows;

use App\Http\DTO\DTO;
use App\Http\DTO\Rows\RowSortingDTO;
use App\Http\DTO\SortingDTO;
use App\Http\Requests\Upload\UploadRequest;
use App\Models\Imports\RowImport;
use App\Models\Upload\Row;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class RowService
 * @package App\Http\Services\Upload
 *
 * @author Shcerbakov Andrei
 */
class RowService
{
    /**
     * @param UploadRequest $request
     * @return void
     */
    public function upload(UploadRequest $request): void
    {
        Excel::queueImport(new RowImport, $request->file('file'));
    }

    /**
     * @param SortingDTO $sortingDTO
     * @return Collection
     */
    public function get(SortingDTO $sortingDTO): Collection
    {
        return Row::sortingByFields($sortingDTO)->get();
    }
}
