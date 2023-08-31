<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessCsvImport;

class ProductImportController extends Controller
{
    public function import(Request $request)
    {
        $csvFile = $request->file('csv_file');
        $userEmail = $request->input('rajafaisalumer786@gmail.com');

        if ($csvFile) {
            $csvFilePath = $csvFile->store('csv_files');
            ProcessCsvImport::dispatch($csvFilePath);
            return response()->json(['message' => 'CSV import started']);
        }

        return response()->json(['error' => 'No CSV file provided'], 400);
    }
}