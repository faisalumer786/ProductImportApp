<?php

namespace App\Jobs;




use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Reader;
use App\Models\Product;

class ProcessCsvImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $csvFilePath;

    public function __construct($csvFilePath)
    {
        $this->csvFilePath = $csvFilePath;
    }

    public function handle()
    {
        $csv = Reader::createFromPath(storage_path('app/'.$this->csvFilePath));
        $csv->setHeaderOffset(0);
      

        foreach ($csv as $record) {
            // Validate and insert products using batch insert
            Product::create([
                'title' => $record['Title'],
                'description' => $record['Body (HTML)'],
                'sku' => $record['Handle'],
                'type' => $record['Type'],
                'status' => $record['Published']
            ]);
        }
    }
}