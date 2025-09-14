<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    use ApiResponse;

    // 🟢 عرض كل المنتجات (لـ Web أو API)
    public function index(Request $request)
    {
        try {
            $products = Product::all();
            
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->successResponse($products, 'Products retrieved successfully');
            }
            
            return view('products.index', compact('products'));
        } catch (Exception $e) {
            Log::error('Error fetching products: ' . $e->getMessage());
            
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->serverErrorResponse('حدث خطأ في جلب المنتجات');
            }
            
            return redirect()->back()->with('error', 'حدث خطأ في جلب المنتجات. يرجى المحاولة مرة أخرى.');
        }
    }

    // 🟢 عرض فورم إنشاء جديد
    public function create()
    {
        return view('products.create');
    }

    // 🟢 تخزين منتج جديد
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();

            // حفظ الصور
            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('products', 'public');
                    $images[] = $path;
                }
            }

            $validatedData = $request->validated();
            $validatedData['colors'] = $request->colors ? json_encode($request->colors) : null;
            $validatedData['images'] = !empty($images) ? json_encode($images) : null;

            $product = Product::create($validatedData);

            DB::commit();

            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->successResponse($product, 'تم إنشاء المنتج بنجاح', 201);
            }
            
            return redirect()->route('products.index')->with('success', 'تم إنشاء المنتج بنجاح.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating product: ' . $e->getMessage());

            return $request->expectsJson() || $request->is('api/*')
                ? $this->serverErrorResponse('حدث خطأ في إنشاء المنتج')
                : redirect()->back()->with('error', 'حدث خطأ في إنشاء المنتج. يرجى المحاولة مرة أخرى.')->withInput();
        }
    }

    // 🟢 عرض منتج واحد
    public function show(Request $request, Product $product)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->successResponse($product, 'Product retrieved successfully');
        }
        return view('products.show', compact('product'));
    }

    // 🟢 عرض فورم تعديل
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // 🟢 تحديث البيانات
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $product->update($request->validated());

            DB::commit();

            return $request->expectsJson() || $request->is('api/*')
                ? $this->successResponse($product, 'تم تحديث المنتج بنجاح')
                : redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating product: ' . $e->getMessage());

            return $request->expectsJson() || $request->is('api/*')
                ? $this->serverErrorResponse('حدث خطأ في تحديث المنتج')
                : redirect()->back()->with('error', 'حدث خطأ في تحديث المنتج. يرجى المحاولة مرة أخرى.')->withInput();
        }
    }

    // 🟢 حذف منتج
    public function destroy(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            if ($product->images) {
                $images = json_decode($product->images, true);
                if (is_array($images)) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $product->delete();

            DB::commit();

            return $request->expectsJson() || $request->is('api/*')
                ? $this->successResponse(null, 'تم حذف المنتج بنجاح')
                : redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting product: ' . $e->getMessage());

            return $request->expectsJson() || $request->is('api/*')
                ? $this->serverErrorResponse('حدث خطأ في حذف المنتج')
                : redirect()->back()->with('error', 'حدث خطأ في حذف المنتج. يرجى المحاولة مرة أخرى.');
        }
    }

  public function getAllProducts()
{
    $products = Product::with(['stocks.warehouse.branch'])->get();

    $products->transform(function ($product) {
        // جلب branch واحد فقط من أي stock موجود
        $branch = $product->stocks->first()?->warehouse->branch;

        // حذف بيانات المخزون والـ warehouse
        unset($product->stocks);

        // ضيفي الفرع مباشرة كخاصية
        $product->branch = $branch;

        return $product;
    });

    return response()->json([
        'success' => true,
        'data' => $products
    ]);
}
public function getProductsWithOffers()
{
    $products = Product::whereHas('offers')
                       ->with(['offers', 'stocks.warehouse.branch'])
                       ->get();

    $products->transform(function ($product) {
        // جلب branch واحد فقط من أي stock موجود
        $branch = $product->stocks->first()?->warehouse->branch;

        // حذف بيانات المخزون والـ warehouse
        unset($product->stocks);

        // ضيفي الفرع مباشرة كخاصية
        $product->branch = $branch;

        return $product;
    });

    return response()->json([
        'success' => true,
        'data' => $products
    ]);
}



// public function getAllProducts()
// {
//     $products = Product::with(['offers', 'branches'])->get();

//     return response()->json([
//         'success' => true,
//         'data' => $products
//     ]);
// }
}



