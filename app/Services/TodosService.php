<?php
namespace App\Services;

use App\Models\Todo;

class TodosService {

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Todo::all();
    }

    public function getById($id)
    {
        try {
            return Todo::findOrFail($id);
        } catch (\Exception $e) {
            logger('TodoService: getById -- ');
            logger($e->getMessage());
        }
    }

    public function update($id, $status)
    {
        try {
            $todoItem = Todo::findOrFail($id);
            $todoItem->is_done = $status;
            $todoItem->save();

            return $todoItem;
        } catch (\Exception $e) {
            logger('TodoService: getById -- ');
            logger($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            Todo::destroy($id);
        } catch (\Exception $e) {
            logger('TodoService: destroy -- ');
            logger($e->getMessage());
        }
    }

    public function createNew($content)
    {
        try {
            $newTodoItem = Todo::create([
                'content' => $content
            ]);

            return $newTodoItem;
        } catch (\Exception $e) {
            logger('TodoService: createNew -- ');
            logger($e->getMessage());
        }
    }
}
