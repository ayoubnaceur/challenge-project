<?php   

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\RepositoryInterface; 

class Repository implements RepositoryInterface 
{     

    protected $model;       

    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
 
    public function all()
    {
        return $this->model->all();
    }
    
    public function find($id)
    {
        $this->model = $this->model->findOrFail($id);
        return $this->model;
    }

    public function create(array $attributes)
    {
        $this->model = new Model();
        return $this->model->create($attributes);
    }
    
}