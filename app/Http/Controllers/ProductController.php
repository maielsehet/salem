<?php

namespace App\Http\Controllers;

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
    //  عرض كل المنتجات
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

    //  عرض فورم إنشاء جديد
    public function create()
    {
        try {
            return view('products.create');
        } catch (Exception $e) {
            Log::error('Error loading create product form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'حدث خطأ في تحميل صفحة إضافة منتج جديد.');
        }
    }

    //  تخزين منتج جديد
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();

            // حفظ الصور
            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    try {
                        $path = $image->store('products', 'public');
                        $images[] = $path;
                    } catch (Exception $e) {
                        Log::error('Error storing image: ' . $e->getMessage());
                        throw new Exception('حدث خطأ في حفظ الصور');
                    }
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
            
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->serverErrorResponse('حدث خطأ في إنشاء المنتج');
            }
            
            return redirect()->back()
                ->with('error', 'حدث خطأ في إنشاء المنتج. يرجى المحاولة مرة أخرى.')
                ->withInput();
        }
    }

    //  عرض منتج واحد
    public function show(Request $request, Product $product)
    {
        try {
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->successResponse($product, 'Product retrieved successfully');
            }
            
            return view('products.show', compact('product'));
        } catch (Exception $e) {
            Log::error('Error showing product: ' . $e->getMessage());
            
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->notFoundResponse('المنتج المطلوب غير موجود');
            }
            
            return redirect()->route('products.index')->with('error', 'المنتج المطلوب غير موجود.');
        }
    }

    //  عرض فورم تعديل
    public function edit(Product $product)
    {
        try {
            return view('products.edit', compact('product'));
        } catch (Exception $e) {
            Log::error('Error loading edit product form: ' . $e->getMessage());
            return redirect()->route('products.index')->with('error', 'المنتج المطلوب للتعديل غير موجود.');
        }
    }

    //  تحديث البيانات
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $product->update($request->validated());

            DB::commit();

            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->successResponse($product, 'تم تحديث المنتج بنجاح');
            }
            
            return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating product: ' . $e->getMessage());
            
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->serverErrorResponse('حدث خطأ في تحديث المنتج');
            }
            
            return redirect()->back()
                ->with('error', 'حدث خطأ في تحديث المنتج. يرجى المحاولة مرة أخرى.')
                ->withInput();
        }
    }

    //  حذف
    public function destroy(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            // حذف الصور من التخزين
            if ($product->images) {
                $images = json_decode($product->images, true);
                if (is_array($images)) {
                    foreach ($images as $image) {
                        try {
                            Storage::disk('public')->delete($image);
                        } catch (Exception $e) {
                            Log::warning('Error deleting image file: ' . $e->getMessage());
                        }
                    }
                }
            }

            $product->delete();

            DB::commit();

            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->successResponse(null, 'تم حذف المنتج بنجاح');
            }
            
            return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting product: ' . $e->getMessage());
            
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->serverErrorResponse('حدث خطأ في حذف المنتج');
            }
            
            return redirect()->back()->with('error', 'حدث خطأ في حذف المنتج. يرجى المحاولة مرة أخرى.');
        }
    }
}
