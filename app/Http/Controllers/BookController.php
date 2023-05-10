<?php

namespace App\Http\Controllers;

use App\Actions\Action;
use App\Actions\Book\ListBooksAction;
use App\Actions\Book\ShowBookAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $data = Action::dispatch(ListBooksAction::class);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request): JsonResponse
    {
        $data = Action::dispatch(
            ShowBookAction::class,
            $id,
            $request->input('include', []),
        );

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
