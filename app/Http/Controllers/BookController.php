<?php

namespace App\Http\Controllers;

use App\Actions\Action;
use App\Actions\Book\DeleteBookAction;
use App\Actions\Book\ListBooksAction;
use App\Actions\Book\ShowBookAction;
use App\Actions\Book\StoreBookAction;
use App\Actions\Book\UpdateBookAction;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $data = Action::dispatch(
            ListBooksAction::class,
            $request->all()
        );

        $message = ['message' => 'Lista de registros.'];

        return response()->json(
            array_merge($message, $data->toArray()),
            Response::HTTP_OK
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

        return response()->json([
            'message' => 'Registro foi incluído.',
            'data'    => $data,
        ],
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

        if (empty($data)) {
            abort(404, 'Registro não encontrado');
        }

        return response()->json([
            'message' => 'Informações do registro.',
            'data'    => $data,
        ],);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = Action::dispatch(
                UpdateBookAction::class,
                $id,
                $request->validated()
            );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response()->json([
            'message' => 'Registro foi atualizado.',
            'data'    => $data,
        ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $data = Action::dispatch(
                DeleteBookAction::class,
                $id
            );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response()->json([
            'message' => 'Registro foi excluído.',
            'data'    => $data,
        ],
            Response::HTTP_OK
        );
    }
}
