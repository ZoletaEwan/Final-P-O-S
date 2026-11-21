<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        $sales = Sale::with([
            'product',
            'customer',
            'staff',
        ])
            ->latest()
            ->paginate(15);

        return view('sales.index', compact('sales'));
    }

    public function create(): View
    {
        $products = Product::where(
            'stock_quantity',
            '>',
            0
        )
            ->orderBy('name')
            ->get();

        $customers = Customer::orderBy('full_name')->get();

        return view(
            'sales.create',
            compact('products', 'customers')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],
            'customer_id' => [
                'nullable',
                'exists:customers,id',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        DB::transaction(function () use ($data): void {
            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail($data['product_id']);

            if ($data['quantity'] > $product->stock_quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'The requested quantity exceeds the available stock of '.$product->stock_quantity.'.',
                ]);
            }

            $totalPrice = round(
                (float) $product->price * $data['quantity'],
                2
            );

            Sale::create([
                'product_id' => $product->id,
                'customer_id' => $data['customer_id'] ?? null,
                'sold_by' => auth()->id(),
                'quantity' => $data['quantity'],
                'total_price' => $totalPrice,
            ]);

            $product->decrement(
                'stock_quantity',
                $data['quantity']
            );
        });

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale recorded successfully.');
    }
}