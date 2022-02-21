<?php
namespace App\Services;

use App\Models\Todo;

class TodosService {

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Todo::all();
    }
}
