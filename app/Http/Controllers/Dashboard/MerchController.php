<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OrderRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class MerchController extends Controller
{
    public function index()
    {
        return Inertia::render('dashboard/Merch', [
            'items' => Item::query()
                ->where('active', 1)
                ->get()
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(OrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $filteredItems = collect($validated['items'])
            ->filter(fn($item) => $item['quantity'] > 0)
            ->values();

        if ($filteredItems->count() === 0) {
            return back()->withErrors([
                'items' => 'You must order at least one item.'
            ]);
        }

        $shippingBase = 4;
        $shippingAdditional = 0.75;

        DB::transaction(function () use (
            $validated,
            $filteredItems,
            $shippingBase,
            $shippingAdditional,
            &$order
        ) {
            $customer = Customer::create([
                'user_id' => auth()->id(),
                'phone' => $validated['phone'],
            ]);

            $address = Address::create([
                'customer_id' => $customer->id,
                'address_name' => 'Shipping',
                'street1' => $validated['street1'],
                'street2' => $validated['street2'] ?? null,
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'is_default' => true,
            ]);

            $subtotal = 0;
            $totalWeightOz = 0;

            foreach ($filteredItems as $entry) {
                $item = Item::findOrFail($entry['item_id']);

                $subtotal += $item->price * $entry['quantity'];
                $totalWeightOz += $item->weight_oz * $entry['quantity'];
            }

            $weightLb = ceil($totalWeightOz / 16);
            $shippingCost = $shippingBase + ($weightLb * $shippingAdditional);
            $total = $subtotal + $shippingCost;

            $order = Order::create([
                'customer_id' => $customer->id,
                'address_id' => $address->id,
                'order_date' => now(),
                'order_status' => 'paid',
                'shipping_cost' => $shippingCost,
                'total_amount' => $total,
            ]);

            foreach ($filteredItems as $entry) {
                $item = Item::findOrFail($entry['item_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'quantity' => $entry['quantity'],
                    'unit_price' => $item->price,
                ]);

                $item->decrement('quantity_in_stock', $entry['quantity']);
            }
        });

        return redirect()->route('dashboard.receipt.show', $order);
    }

    public function receipt(Order $order): Response
    {
        $order->load([
            'customer',
            'address',
            'orderItems.item'
        ]);

        return Inertia::render('dashboard/Receipt', [
            'order' => $order,
        ]);
    }
}
