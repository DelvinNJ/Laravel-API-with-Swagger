<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ProductUpdateRequest;
use App\Http\Resources\V1\ProductResource;
use App\Http\Requests\V1\ProductStoreRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0",
 *     description="API Documentation for e-commerce",
 *     @OA\Contact(
 *         email="delvinnj02@gmail.com"
 *     )
 * )
 */

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/products",
     *     summary="Get list of products",
     *     tags={"Products"},
     *     operationId="getProducts",
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
     *      description="The number of products to return per page, the default count is 50"        
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="collections",
     *          required=false,           
     *          @OA\Schema(
     *              type="string",
     *              enum={"true"}
     *          ),  
     *          description="Including collections"      
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
     *     )
     * )
     */

    public function index(Request $request)
    {
        $include_collections = $request->query('collections');
        $page_limit = $request->query('page_limit') ?? 50;

        $products = Product::query();
        if ($include_collections) {
            $products->with('collections');
        }
        $data = ProductResource::collection($products->paginate($page_limit)->withQueryString());
        // $data = new ProductResource(Product::first());   //If only one instance
        return $data;
    }

    /**
     * @OA\Post(
     *      path="/api/v1/products",
     *      tags={"Products"},
     *      summary="Create new product", 
     *      operationId="createProduct", 
     *      security={
     *          {"Bearer" : {}}
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",          
     *              @OA\Schema(
     *                   type="object",
     *                   required={"title", "htmlContent", "productType", "vendor"},
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
     *                  @OA\Property(
     *                      property="productType",
     *                      type="string",
     *                      enum={"Food", "Drinks", "Electronic"},
     *                      description="Product type"
     *                  ),
     *                  @OA\Property(
     *                      property="vendor",
     *                      type="string",
     *                      description="Vendor name"
     *                  ) 
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
    public function store(ProductStoreRequest $request)
    {
        $data = $request->all();
        return new ProductResource(Product::create($data));
    }
    public function bulkInsert(Request $request)
    {
        dd($request->all());
    }

    /**
     * @OA\Get(
     *      path="/api/v1/products/{id}",
     *      summary="Get a product details", 
     *      operationId="getSingleProduct",
     *      tags={"Products"},
     *      security={
     *              {"Bearer": {}}
     *     },
     *      @OA\Parameter(
     *          in="path",
     *          name="id", 
     *          required=true, 
     *          description="Product id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ), 
     *      @OA\Parameter(
     *          in="query",
     *          name="collections", 
     *          required=false,
     *          @OA\Schema(
     *              type="string", 
     *              enum={"true"}
     *          ), 
     *          description="Including collections"
     *      ), 
     *      @OA\Response(
     *          response=200, 
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      )
     * )
     */
    public function show(Request $request, Product $product)
    {
        $include_collections = $request->query('collections');
        if ($include_collections) {
            $product->load('collections');
        }
        return new ProductResource($product);
    }
    // public function show(Request $request, string $id)
    // {
    //     $productQuery = Product::query();
    //     $include_collections = $request->query('collections');
    //     if ($include_collections) {
    //         $productQuery->with('collections');
    //     }
    //     $product = $productQuery->find($id);
    //     return new ProductResource($product);
    // }

    /**
     * @OA\PUT(
     *      path="/api/v1/products/{id}",
     *      tags={"Products"},
     *      summary="Update product", 
     *      operationId="updateProduct", 
     *      security={
     *          {"Bearer" : {}}
     *      },
     *      @OA\Parameter(
     *          required=true,
     *          name="id",
     *          in="path",
     *          description="Product id", 
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
     *                   required={"title", "htmlContent", "productType", "vendor"},
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
     *                  @OA\Property(
     *                      property="productType",
     *                      type="string",
     *                      enum={"Food", "Drinks", "Electronic"},
     *                      description="Product type"
     *                  ),
     *                  @OA\Property(
     *                      property="vendor",
     *                      type="string",
     *                      description="Vendor name"
     *                  ) 
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

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->all();
        $product->update($data);
        return new ProductResource($product->refresh());
    }


    /**
     * @OA\Delete(
     *      path="/api/v1/products/{id}", 
     *      summary="Delete a product", 
     *      operationId="deleteSingleProduct",
     *      tags={"Products"},
     *      security={
     *              {"Bearer": {}}
     *     },
     *      @OA\Parameter(
     *          in="path",
     *          name="id", 
     *          required=true, 
     *          description="Product id",
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
    public function destroy(Product $product)
    {
        $product->delete();
        return response([
            'message' => 'Successful operation'
        ], 200);
    }
}
