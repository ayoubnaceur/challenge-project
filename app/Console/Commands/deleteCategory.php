<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Services\CategoryService;


class deleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appdo:deleteCategory
                        {id : The id of category}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category';

    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryService $service)
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
            $result = $this->service->delete($id);;

            $this->table(
                ['Id','Name', 'Parent'],
                [[$result->id, $result->name, $result->category_id]]
            );

            $this->info('Category deleted successfuly!');

        } catch (Exception $e) {
            $this->error('Something went wrong!'. $e->getMessage());
        }
    }
}
