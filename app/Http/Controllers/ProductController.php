<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): ResourceCollection
    {
        return ProductResource::collection(Product::whereNull('parent_id')->orderBy('position')->get());
    }

    public function moveUp(int $id): JsonResponse
    {
        $product = Product::find($id);
        $previous = Product::where('position', '<', $product->position)->orderByDesc('position')->first();

        try {
            self::swap($product, $previous);
            return response()->json(['message' => 'Updated successfully.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Update failed.', 'message' => $e->getMessage()], 500);
        }
    }

    public function moveDown(int $id): JsonResponse
    {
        $product = Product::find($id);
        $next = Product::where('position', '>', $product->position)->orderBy('position')->first();

        try {
            self::swap($product, $next);
            return response()->json(['message' => 'Updated successfully.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Update failed.', 'message' => $e->getMessage()], 500);
        }
    }

    function remove(int $id): JsonResponse
    {
        Product::find($id)->delete();
        return response()->json(['message' => 'Deleted successfully.']);
    }

    private static function swap(Product $first, Product $second): void
    {
        DB::beginTransaction();

        $secondPosition = $second->position;
        $second->position = $first->position;
        $first->position = $secondPosition;
        $first->save();
        $second->save();

        DB::commit();
    }
}
