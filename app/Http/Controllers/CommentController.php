<?php

namespace App\Http\Controllers;

use App\Actions\AddComment;
use App\Events\AddNewComment;
use App\Http\Requests\CommentRequest;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    public function __invoke(CommentRequest $request, Product $product, AddComment $addComment): JsonResponse
    {
        $data = $addComment->store($product, $request->validated());
        // AddNewComment::dispatch($data);
        return Response::json([
            'message' => 'Add Comment Success',
            'data' => $data,
        ], 201);
    }
}
