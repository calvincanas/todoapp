<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoControllerUpdateRequest;
use App\Http\Requests\TodosControllerStoreRequest;
use App\Services\TodosService;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    private TodosService $todoService;

    public function __construct(TodosService $todoService)
    {
        $this->todoService = $todoService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $todos = $this->todoService->getAll();
        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TodosControllerStoreRequest $request)
    {
        $newTodoItem = $this->todoService->createNew($request->new_content);

        return response()->json([
            'status' => 'success',
            'item' => $newTodoItem
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TodoControllerUpdateRequest $request, $id)
    {
        $todoItem = $this->todoService->update($id, $request->is_done);

        return response()->json([
            'status' => 'success',
            'item' => $todoItem
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->todoService->destroy($id);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
