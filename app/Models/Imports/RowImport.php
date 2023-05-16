<?php

namespace App\Models\Imports;

use App\Models\Upload\Row;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

/**
 * Class RowImport
 * @package App\Models\Imports
 *
 * @author Shcerbakov Andrei
 */
class RowImport implements ToCollection, ShouldQueue, WithChunkReading, WithHeadingRow
{
    public function collection(Collection $collection): void
    {
        $collection->map(function ($item) {
            $row = new Row();
            $row->name = $item['name'];
            $row->date = (new Carbon(Date::excelToDateTimeObject((int)$item['date'])))->format('Y-m-d');
            $row->save();
        });
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
