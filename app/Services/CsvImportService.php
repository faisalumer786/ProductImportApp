<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Events\ProductInserted;

class CsvImportService
{
    public function importCsv($filePath, $userEmail)
    {
        $csv = array_map('str_getcsv', file($filePath));
        $header = array_shift($csv);

        $chunks = array_chunk($csv, 100); // Batch size of 100

        foreach ($chunks as $chunk) {
            DB::table('products')->insert($this->processChunk($chunk, $userEmail));
        }
    }

    protected function processChunk($chunk, $userEmail)
    {
        $processedChunk = [];

        foreach ($chunk as $row) {
            $processedChunk[] = [
                'title' => $row[1],
                'description' => $row[2],
                'sku' => $row[0],
                'type' => $row[3],
                'status' => $row[4],
            ];

            event(new ProductInserted($row, $userEmail));
        }

        return $processedChunk;
    }
}