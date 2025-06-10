<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Book;
use OpenApi\Annotations as OA;

/**
 * Class BookController.
 *
 * @author Josevan <josevan422024005@ukrida.ac.id>
 */

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/book",
     *     tags={"book"},
     *     summary="Display a listing of items",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     )
     * )
     */
    public function index()
    {
        $book = Book::all();
        return response()->json(array('message' => 'Data retrieved successfully', 'data' => $book), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/book",
     *     tags={"book"},
     *     summary="Store a newly created item",
     *     operationId="store",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body description",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Book",
     *             example={"title": "Eating Clean", "author": "Inge Tumiwa-Bachrens",
     *                 "publisher": "Kawan Pustaka", "publication_year": "2016",
     *                 "cover": "https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1482170555l/3351107.jpg",
     *                 "description": "Menjadi sehat adalah impian semua orang. Makanan yang selama ini kita pikir sehat ternyata belum tentu ‘sehat’ bagi tubuh kita.",
     *                 "price": 85000}
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:books',
                'author' => 'required|max:100',
            ]);

            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }

            $book = new Book;
            $book->fill($request->all())->save();
            return response()->json(array('message' => 'Saved successfully', 'data' => $book), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }
    /**
     * @OA\Get(
     *     path="/api/book/{id}",
     *     tags={"book"},
     *     summary="Display the specified item",
     *     operationId="show",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be displayed",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json(array('message' => 'Data detail retrieved successfully', 'data' => $book), 200);
    }
    /**
     * @OA\Put(
     *     path="/api/book/{id}",
     *     tags={"book"},
     *     summary="Update the specified item",
     *     operationId="update",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body description",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Book",
     *             example={"title": "Eating Clean", "author": "Inge Tumiwa-Bachrens",
     *                 "publisher": "Kawan Pustaka", "publication_year": "2016",
     *                 "cover": "https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1482170555l/3351107.jpg",
     *                 "description": "Menjadi sehat adalah impian semua orang. Makanan yang selama ini kita pikir sehat ternyata belum tentu ‘sehat’ bagi tubuh kita.",
     *                 "price": 85000}
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        $book = Book::find($id);
        if (!$book) {
            throw new HttpException(404, 'Item not found');
        }

        try {
            $book->fill($request->all())->save();
            return response()->json(array('message' => 'Updated successfully', 'data' => $book), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }
    /**
     * @OA\Delete(
     *     path="/api/book/{id}",
     *     tags={"book"},
     *     summary="Remove the specified item",
     *     operationId="destroy",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be removed",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(array('message' => 'Deleted successfully', 'data' => $book), 204);
    }

}