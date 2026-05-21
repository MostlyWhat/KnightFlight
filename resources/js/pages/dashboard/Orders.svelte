<script lang="ts" module>
    import { dashboard } from '@/routes';
    import { orders } from '@/routes/dashboard';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard()
            },
            {
                title: 'Orders',
                href: orders()
            }
        ]
    };
</script>

<script lang="ts">
    import { router } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';

    let { ordersList } = $props();

    const formatCurrency = (amount: number | string) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(Number(amount));
    };

    const formatDate = (date: string) => {
        return new Date(date).toLocaleString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: '2-digit'
        });
    };

    const viewReceipt = (id: number) => {
        router.visit(`/dashboard/receipt/${id}`);
    };
</script>

<AppHead title="Orders" />

<div class="min-h-screen bg-background p-6">
    <div class="mx-auto max-w-6xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight">
                Orders
            </h1>

            <p class="mt-2 text-muted-foreground">
                View all merchandise receipts and purchases.
            </p>
        </div>

        <div class="overflow-hidden rounded-2xl border bg-card shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b bg-muted/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Order #
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Date
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Shipping
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Total
                        </th>

                        <th class="px-6 py-4 text-right text-sm font-semibold">
                            Receipt
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    {#if ordersList?.length}
                        {#each ordersList as order}
                            <tr class="border-b transition-colors hover:bg-muted/30">
                                <td class="px-6 py-4 font-medium">
                                    #{order.id}
                                </td>

                                <td class="px-6 py-4 text-muted-foreground">
                                    {formatDate(order.order_date)}
                                </td>

                                <td class="px-6 py-4">
                                        <span
                                            class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700 dark:bg-green-900/30 dark:text-green-400"
                                        >
                                            {order.order_status}
                                        </span>
                                </td>

                                <td class="px-6 py-4">
                                    {formatCurrency(order.shipping_cost)}
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    {formatCurrency(order.total_amount)}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded-lg border px-4 py-2 text-sm font-medium transition-colors hover:bg-muted"
                                        onclick={() => viewReceipt(order.id)}
                                    >
                                        View Receipt
                                    </button>
                                </td>
                            </tr>
                        {/each}
                    {:else}
                        <tr>
                            <td
                                colspan="6"
                                class="px-6 py-12 text-center text-muted-foreground"
                            >
                                No orders found.
                            </td>
                        </tr>
                    {/if}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
