<?php

namespace App\Http\Controllers;

use App\Actions\Action;
use App\Actions\Author\ListAuthorsAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Action::dispatch(ListAuthorsAction::class);

        $message = ['message' => 'Lista de registros.'];

        return response()->json(
            array_merge($message, $data->toArray()),
            Response::HTTP_OK
        );
    }
}
