<script lang="ts" module>
    import { dashboard } from '@/routes';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard()
            },
            {
                title: 'Receipt'
            }
        ]
    };
</script>

<script lang="ts">
    import AppHead from '@/components/AppHead.svelte';

    let { order } = $props();

    const items = order?.order_items ?? [];

    const subtotal = items.reduce(
        (sum: number, item: any) =>
            sum + item.quantity * Number(item.unit_price),
        0
    );
</script>

<AppHead title="Receipt" />

<div class="mx-auto max-w-5xl p-4">
    <div
        class="overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card shadow-sm dark:border-sidebar-border"
    >
        <!-- HEADER -->
        <div class="border-b p-8">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight">
                        Order Receipt
                    </h1>

                    <p class="mt-2 text-muted-foreground">
                        Thank you for your purchase.
                    </p>
                </div>

                <div
                    class="w-fit rounded-full border border-green-500/20 bg-green-500/10 px-4 py-2 text-sm font-medium capitalize text-green-600"
                >
                    {order.order_status}
                </div>
            </div>
        </div>

        <!-- DETAILS -->
        <div class="grid gap-8 p-8 md:grid-cols-2">
            <!-- SHIPPING -->
            <div>
                <h2 class="mb-4 text-lg font-semibold">
                    Shipping Information
                </h2>

                <div class="space-y-2 text-sm text-muted-foreground">
                    <p>{order.customer.name}</p>

                    <p>{order.address.street1}</p>

                    {#if order.address.street2}
                        <p>{order.address.street2}</p>
                    {/if}

                    <p>
                        {order.address.city},
                        {order.address.state}
                        {order.address.postal_code}
                    </p>

                    <p>{order.address.country}</p>

                    <div class="pt-3">
                        <p>Tel: {order.customer.phone}</p>
                    </div>
                </div>
            </div>

            <!-- SUMMARY -->
            <div>
                <h2 class="mb-4 text-lg font-semibold">
                    Order Summary
                </h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-muted-foreground">
                            Order ID
                        </span>

                        <span class="font-medium">
                            #{order.id}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-muted-foreground">
                            Order Date
                        </span>

                        <span>
                            {new Date(order.order_date).toLocaleDateString()}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-muted-foreground">
                            Status
                        </span>

                        <span class="font-medium capitalize">
                            {order.order_status}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ITEMS -->
        <div class="px-8 pb-8">
            <div class="overflow-hidden rounded-2xl border">
                <table class="w-full">
                    <thead class="bg-muted/40">
                    <tr class="text-left text-sm">
                        <th class="px-6 py-4 font-medium">Item</th>
                        <th class="px-6 py-4 font-medium">Qty</th>
                        <th class="px-6 py-4 font-medium">Price</th>
                        <th class="px-6 py-4 text-right font-medium">
                            Total
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    {#each items as orderItem}
                        <tr class="border-t">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img
                                        src={orderItem.item.image_url}
                                        alt={orderItem.item.item_name}
                                        class="h-16 w-16 rounded-xl object-cover"
                                    />

                                    <div>
                                        <p class="font-medium">
                                            {orderItem.item.item_name}
                                        </p>

                                        <p class="text-sm text-muted-foreground">
                                            {orderItem.item.description}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                {orderItem.quantity}
                            </td>

                            <td class="px-6 py-4">
                                ${Number(orderItem.unit_price).toFixed(2)}
                            </td>

                            <td class="px-6 py-4 text-right font-semibold">
                                ${Number(
                                orderItem.quantity *
                                orderItem.unit_price
                            ).toFixed(2)}
                            </td>
                        </tr>
                    {/each}
                    </tbody>
                </table>
            </div>

            <!-- TOTALS -->
            <div class="mt-8 ml-auto max-w-sm space-y-4">
                <div class="flex justify-between">
                    <span class="text-muted-foreground">
                        Subtotal
                    </span>

                    <span>
                        ${subtotal.toFixed(2)}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-muted-foreground">
                        Shipping
                    </span>

                    <span>
                        ${Number(order.shipping_cost).toFixed(2)}
                    </span>
                </div>

                <div class="flex justify-between border-t pt-4 text-xl font-bold">
                    <span>Total</span>

                    <span>
                        ${Number(order.total_amount).toFixed(2)}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
