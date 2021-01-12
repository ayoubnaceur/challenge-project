<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Services\ProductService;

class deleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appdo:deleteProduct
                        {id : The id of product}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a product';
    
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $service)
    {
        parent::__construct();
        $this->service =  $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->argument('id');
        $this->info('Thier is no confirmation, I know i told u late hhh');
        try {
            $result = $this->service->delete($id);

            $this->table(
                ['Id','Name'],
                [[$result->id, $result->name]]
            );

            $this->info('Product deleted successfuly!');

        } catch (Exception $e) {
            $this->error('Something went wrong!'. $e->getMessage());
        }
    }
}
