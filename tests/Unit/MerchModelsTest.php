<?php

use App\Models\Address;
use App\Models\Customer;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Order;
use App\Models\OrderItem;

test('models expose expected relation methods', function () {
    // Ensure relation methods exist on the models. We avoid invoking the relation
    // objects directly to keep tests independent of a DB connection.
    expect(method_exists(Customer::class, 'user'))->toBeTrue();
    expect(method_exists(Customer::class, 'addresses'))->toBeTrue();
    expect(method_exists(Customer::class, 'orders'))->toBeTrue();

    expect(method_exists(Address::class, 'customer'))->toBeTrue();
    expect(method_exists(Address::class, 'orders'))->toBeTrue();

    expect(method_exists(Item::class, 'images'))->toBeTrue();
    expect(method_exists(Item::class, 'orderItems'))->toBeTrue();

    expect(method_exists(Order::class, 'customer'))->toBeTrue();
    expect(method_exists(Order::class, 'address'))->toBeTrue();
    expect(method_exists(Order::class, 'orderItems'))->toBeTrue();

    expect(method_exists(OrderItem::class, 'order'))->toBeTrue();
    expect(method_exists(OrderItem::class, 'item'))->toBeTrue();

    expect(method_exists(ItemImage::class, 'item'))->toBeTrue();
});
