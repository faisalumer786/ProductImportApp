<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCsvData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $csvFile;

    public function __construct($csvFile)
    {
        $this->csvFile = $csvFile;
    }

    public function handle()
    {
        $csv = Reader::createFromPath($this->csvFile);
        $stmt = Statement::create()->process($csv);
        
        foreach ($stmt->getRecords() as $record) {
            Product::create([
                'title' => $record[0],
                'description' => $record[1],
                'sku' => $record[2],
                'type' => $record[3],
                'cost_price' => 0.0, // Add appropriate value
                'status' => 'published', // Add appropriate value
            ]);
        }
    }
}
