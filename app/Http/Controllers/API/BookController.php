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
 * @author Benny <benny422024008@ukrida.ac.id>
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
     *         description="successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="_page",
     *         in="query",
     *         description="current page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_limit",
     *         in="query",
     *         description="max item in a page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=10
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_search",
     *         in="query",
     *         description="word to search",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_publisher",
     *         in="query",
     *         description="search by publisher like name",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_sort_by",
     *         in="query",
     *         description="word to search",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="latest"
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        try {
            $data['filter']     = $request->all();
            $page               = ($data['filter']['_page'] = (@$data['filter']['_page'] ? intval($data['filter']['_page']) : 1));
            $limit              = ($data['filter']['_limit'] = (@$data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000));
            $offset             = ($page > 1 ? ($page - 1) * $limit : 0);
            $data['products']   = Book::whereRaw('1 = 1');

            if($request->get('_search')){
                $data['products'] = $data['products']->whereRaw("(LOWER(title) LIKE '%".strtolower($request->get('_search'))."%' OR LOWER(author) 
                LIKE '%".strtolower($request->get('_search'))."%')");
            }
            if($request->get('_publisher')){
                $data['products'] = $data['products']->whereRaw("LOWER(publisher) = '".strtolower($request->get('_publisher'))."'");
            }
            if($request->get('_sort_by')){
            switch ($request->get('_sort_by')) {
                default:
                case 'latest_publication':
                    $data['products'] = $data['products']->orderBy('publication_year','DESC');
                    break;
                case 'latest_added':
                    $data['products'] = $data['products']->orderBy('created_at','DESC');
                    break;
                case 'title_asc':
                    $data['products'] = $data['products']->orderBy('title','ASC');
                    break;
                case 'title_desc':
                    $data['products'] = $data['products']->orderBy('title','DESC');
                    break;
                case 'price_asc':
                    $data['products'] = $data['products']->orderBy('price','ASC');
                    break;
                case 'price_desc':
                    $data['products'] = $data['products']->orderBy('price','DESC');
                    break;
            }
            }
            $data['products_count_total']   = $data['products']->count();
            $data['products']               = ($limit == 0 && $offset == 0) ? $data['products'] : $data['products']->limit($limit)->offset($offset);
            // $data['products_raw_sql'] = $data['products']->toSql();
            $data['products']               = $data['products']->get();
            $data['products_count_start']   = ($data['products_count_total'] == 0 ? 0 : (($page - 1) * $limit) + 1);
            $data['products_count_end']     = ($data['products_count_total'] == 0 ? 0 : (($page - 1) * $limit) + sizeof($data['products']));
            return response()->json($data, 200);

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
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
            $book->created_by = \Auth::user()->id;  //  store the user ID
            $book->save();
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
            $book->updated_by = \Auth::user()->id;  //  Set user ID on update
            $book->save();
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
     *     ),
     *     security={{"passport_token_ready"={}, "passport"={}}}
     * )
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->deleted_by = \Auth::user()->id;  //  Track who deleted the
        $book->delete();

        return response()->json(array('message' => 'Deleted successfully', 'data' => $book), 204);
    }

}