<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Services\CategoryService;

class createCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appdo:createCategory
                        {name : The name of category}
                        {--root=null : Parent category id(Null if its the a root category)}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a category';

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
        $categoryName = $this->argument('name');
        $categoryRoot = $this->option('root');

        $data =[
            'name' => $categoryName,
            'category_id' => $categoryRoot,
        ];
        
        try {
            $result = $this->service->create($data);

            $this->table(
                ['Id','Name', 'Parent'],
                [[$result->id, $result->name, $result->category_id]]
            );

            $this->info('Category created successfuly!');

        } catch (Exception $e) {
            $this->error('Something went wrong!'. $e->getMessage());
        }

    }
}
