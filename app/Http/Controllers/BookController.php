<?php

namespace App\Http\Controllers;

use App\Actions\Action;
use App\Actions\Book\ListBooksAction;
use App\Actions\Book\ShowBookAction;
use App\Actions\Book\StoreBookAction;
use App\Http\Requests\Book\StoreBookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $data = Action::dispatch(ListBooksAction::class);

        return response()->json(
            $data
        );
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = Action::dispatch(
                StoreBookAction::class,
                $request->validated()
            );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response()->json(
            $data,
            Response::HTTP_CREATED
        );
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

        return response()->json(
            $data
        );
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
