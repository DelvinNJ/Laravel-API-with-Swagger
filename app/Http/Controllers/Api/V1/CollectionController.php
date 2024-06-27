<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CollectionUpdateRequest;
use App\Http\Resources\V1\CollectionResource;
use  App\Http\Requests\V1\CollectionStoreRequest;
use OpenApi\Annotations as OA;


class CollectionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/collections",
     *     summary="Get list of collections",
     *     tags={"Collections"},
     *     operationId="getCollections",
     *     security={
     *              {"Bearer": {}}
     *     },
     *     @OA\Parameter(
     *          in="query",
     *          name="page_limit",
     *          required=false,           
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      description="The number of collections to return per page, the default count is 50"        
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="products",
     *          required=false,           
     *          @OA\Schema(
     *              type="string",
     *              enum={"true"}
     *          ),
     *      description="The number of products to return per page, the default count is 50"        
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found"
     *     ), 
     * )
     */


    public function index(Request $request)
    {
        $include_products = $request->query('products');
        $page_limit = $request->query('page_limit') ?? 50;

        $collectionsQuery = Collection::query();

        if ($include_products) {
            $collectionsQuery->with('products');
        }
        $collections = $collectionsQuery->paginate($page_limit)->withQueryString();

        return CollectionResource::collection($collections);
    }

        /**
     * @OA\Post(
     *      path="/api/v1/collections",
     *      tags={"Collections"},
     *      summary="Create a new collection", 
     *      operationId="createCollection", 
     *      security={
     *          {"Bearer" : {}}
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",          
     *              @OA\Schema(
     *                   type="object",
     *                   required={"title", "htmlContent"},
     *                   @OA\Property(
     *                      property="title",
     *                      type="string",
     *                      description="Product title"
     *                  ),
     *                  @OA\Property(
     *                      property="htmlContent",
     *                      type="string",
     *                      description="Product content"
     *                  ),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200, 
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      )
     * )
     */
    public function store(CollectionStoreRequest $request)
    {
        $data = $request->all();
        return new CollectionResource(Collection::create($data));
    }


    public function show(Request $request, Collection $collection)
    {
        $include_products = $request->query('products');
        if ($include_products) {
            $collection->load('products');
        }
        return new CollectionResource($collection);
    }
    // public function show(Request $request,  string $id)
    // {
    //     $include_products = $request->query('products');
    //     $collectionsQuery = Collection::query();

    //     if ($include_products) {
    //         $collectionsQuery->with('products');
    //     }
    //     $collection = $collectionsQuery->find($id);

    //     return new CollectionResource($collection);
    // }

    /**
     * @OA\Put(
     *      path="/api/v1/collections/{id}",
     *      tags={"Collections"},
     *      summary="Update collection", 
     *      operationId="updateCollection", 
     *      security={
     *          {"Bearer" : {}}
     *      },
     *      @OA\Parameter(
     *          required=true,
     *          name="id",
     *          in="path",
     *          description="Collections id", 
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",          
     *              @OA\Schema(
     *                   type="object",
     *                   required={"title", "htmlContent"},
     *                   @OA\Property(
     *                      property="title",
     *                      type="string",
     *                      description="Product title"
     *                  ),
     *                  @OA\Property(
     *                      property="htmlContent",
     *                      type="string",
     *                      description="Product content"
     *                  ),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200, 
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      )
     * )
     */
    
    public function update(CollectionUpdateRequest $request, Collection $collection)
    {
        $collection->update($request->all());
        return new CollectionResource($collection->refresh());
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/collections/{id}", 
     *      summary="Delete a collection", 
     *      operationId="deleteSingleCollection",
     *      tags={"Collections"},
     *      security={
     *              {"Bearer": {}}
     *     },
     *      @OA\Parameter(
     *          in="path",
     *          name="id", 
     *          required=true, 
     *          description="Collection id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ), 
     *      @OA\Response(
     *          response=200, 
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     * )
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return response([
            'message' => 'Successful operation'
        ], 200);
    }
}
