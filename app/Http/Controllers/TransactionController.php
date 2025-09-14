<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;

class TransactionController extends Controller
{
    // 🟢 عرض كل العمليات
    public function index()
    {
        $transactions = Transaction::with('items.product')->get();
        return view('transactions.index', compact('transactions'));
    }

    // 🟢 عرض فورم إضافة عملية جديدة
    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    // 🟢 حفظ عملية جديدة
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'type' => $request->type,
            'total_amount' => 0,
        ]);

        $total = 0;
        foreach ($request->products as $productId => $data) {
            if (!empty($data['quantity']) && $data['quantity'] > 0) {
                $item = TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                ]);
                $total += $item->quantity * $item->price;
            }
        }

        $transaction->update(['total_amount' => $total]);

        return redirect()->route('transactions.index')->with('success', 'تم إضافة العملية بنجاح');
    }

    // 🟢 عرض تفاصيل عملية معينة
    public function show(Transaction $transaction)
    {
        $transaction->load('items.product');
        return view('transactions.show', compact('transaction'));
    }

    // 🟢 عرض فورم تعديل عملية
    public function edit(Transaction $transaction)
    {
        $products = Product::all();
        $transaction->load('items');
        return view('transactions.edit', compact('transaction', 'products'));
    }

    // 🟢 تحديث عملية
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update([
            'type' => $request->type,
            'total_amount' => 0,
        ]);

        // نحذف الـ items القديمة وندخل الجديدة
        $transaction->items()->delete();

        $total = 0;
        foreach ($request->products as $productId => $data) {
            if (!empty($data['quantity']) && $data['quantity'] > 0) {
                $item = TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                ]);
                $total += $item->quantity * $item->price;
            }
        }

        $transaction->update(['total_amount' => $total]);

        return redirect()->route('transactions.index')->with('success', 'تم تحديث العملية بنجاح');
    }

    // 🟢 حذف عملية
    public function destroy(Transaction $transaction)
    {
        $transaction->items()->delete();
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'تم حذف العملية بنجاح');
    }
}
