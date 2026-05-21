<script lang="ts" module>
    import { dashboard } from '@/routes';
    import { merch } from '@/routes/dashboard';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard()
            },
            {
                title: 'Merch',
                href: merch()
            }
        ]
    };
</script>

<script lang="ts">
    import { useForm } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';

    let { items } = $props();

    const form = useForm({
        name: '',
        street1: '',
        street2: '',
        city: '',
        state: '',
        postal_code: '',
        country: 'United States',
        phone: '',
        email: '',
        card_number: '',
        card_type: '',

        items: items.map((item: any) => ({
            item_id: item.id,
            quantity: 0
        }))
    });

    const submit = () => {
        form.post('/dashboard/merch', {
            preserveScroll: true
        });
    };
</script>

<AppHead title="Merch" />

<form
    class="flex flex-col gap-6 p-6"
    onsubmit={(e) => {
        e.preventDefault();
        submit();
    }}
>
    <!-- HERO -->
    <div
        class="rounded-2xl border border-sidebar-border/70 bg-card p-8 shadow-sm dark:border-sidebar-border"
    >
        <h1 class="text-4xl font-bold tracking-tight">
            Knight Flight Merch
        </h1>

        <p class="mt-2 text-muted-foreground">
            Official Knight Flight apparel and travel accessories.
        </p>
    </div>

    <!-- PRODUCTS -->
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        {#each items as item, index}
            <div
                class="overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card shadow-sm transition hover:shadow-lg dark:border-sidebar-border"
            >
                <img
                    src={item.image_url}
                    alt={item.item_name}
                    class="aspect-square w-full object-cover"
                />

                <div class="space-y-4 p-5">
                    <div>
                        <h2 class="text-xl font-semibold">
                            {item.item_name}
                        </h2>

                        <p class="mt-1 text-sm text-muted-foreground">
                            {item.description}
                        </p>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold">
                            ${Number(item.price).toFixed(2)}
                        </span>

                        <span class="text-sm text-muted-foreground">
                            {(item.weight_oz / 16).toFixed(1)} lb
                        </span>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium">
                            Quantity
                        </label>

                        <input
                            type="number"
                            min="0"
                            max="100"
                            bind:value={form.items[index].quantity}
                            class="w-full rounded-xl border bg-background px-4 py-3"
                        />
                    </div>

                    <div class="text-sm text-muted-foreground">
                        {item.quantity_in_stock} in stock
                    </div>
                </div>
            </div>
        {/each}
    </div>

    <!-- CHECKOUT -->
    <div
        class="rounded-2xl border border-sidebar-border/70 bg-card p-8 shadow-sm dark:border-sidebar-border"
    >
        <div class="mb-8">
            <h2 class="text-2xl font-semibold">
                Checkout Information
            </h2>

            <p class="mt-1 text-muted-foreground">
                Complete your order details below.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- NAME -->
            <div class="space-y-2">
                <label class="text-sm font-medium">
                    Full Name
                </label>

                <input
                    bind:value={form.name}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                    placeholder="John Doe"
                />

                {#if form.errors.name}
                    <p class="text-sm text-red-500">
                        {form.errors.name}
                    </p>
                {/if}
            </div>

            <!-- PHONE -->
            <div class="space-y-2">
                <label class="text-sm font-medium">
                    Phone Number
                </label>

                <input
                    bind:value={form.phone}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                    placeholder="123-456-7890"
                />

                {#if form.errors.phone}
                    <p class="text-sm text-red-500">
                        {form.errors.phone}
                    </p>
                {/if}
            </div>

            <!-- STREET -->
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium">
                    Street Address
                </label>

                <input
                    bind:value={form.street1}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                    placeholder="123 Main St"
                />

                {#if form.errors.street1}
                    <p class="text-sm text-red-500">
                        {form.errors.street1}
                    </p>
                {/if}
            </div>

            <!-- STREET 2 -->
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium">
                    Apartment / Suite
                </label>

                <input
                    bind:value={form.street2}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                    placeholder="Optional"
                />
            </div>

            <!-- CITY -->
            <div class="space-y-2">
                <label class="text-sm font-medium">
                    City
                </label>

                <input
                    bind:value={form.city}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                />

                {#if form.errors.city}
                    <p class="text-sm text-red-500">
                        {form.errors.city}
                    </p>
                {/if}
            </div>

            <!-- STATE -->
            <div class="space-y-2">
                <label class="text-sm font-medium">
                    State
                </label>

                <input
                    bind:value={form.state}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                />

                {#if form.errors.state}
                    <p class="text-sm text-red-500">
                        {form.errors.state}
                    </p>
                {/if}
            </div>

            <!-- POSTAL -->
            <div class="space-y-2">
                <label class="text-sm font-medium">
                    Postal Code
                </label>

                <input
                    bind:value={form.postal_code}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                />

                {#if form.errors.postal_code}
                    <p class="text-sm text-red-500">
                        {form.errors.postal_code}
                    </p>
                {/if}
            </div>

            <!-- COUNTRY -->
            <div class="space-y-2">
                <label class="text-sm font-medium">
                    Country
                </label>

                <input
                    bind:value={form.country}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                />

                {#if form.errors.country}
                    <p class="text-sm text-red-500">
                        {form.errors.country}
                    </p>
                {/if}
            </div>

            <!-- EMAIL -->
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium">
                    Email Address
                </label>

                <input
                    bind:value={form.email}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                    placeholder="you@example.com"
                    type="email"
                />

                {#if form.errors.email}
                    <p class="text-sm text-red-500">
                        {form.errors.email}
                    </p>
                {/if}
            </div>

            <!-- CARD -->
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium">
                    Credit Card Number
                </label>

                <input
                    bind:value={form.card_number}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                    placeholder="1234123412341234"
                />

                {#if form.errors.card_number}
                    <p class="text-sm text-red-500">
                        {form.errors.card_number}
                    </p>
                {/if}
            </div>

            <!-- CARD TYPE -->
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium">
                    Card Type
                </label>

                <select
                    bind:value={form.card_type}
                    class="w-full rounded-xl border bg-background px-4 py-3"
                >
                    <option value="">Select Card</option>
                    <option value="visa">Visa</option>
                    <option value="mastercard">Mastercard</option>
                    <option value="discover">Discover</option>
                </select>

                {#if form.errors.card_type}
                    <p class="text-sm text-red-500">
                        {form.errors.card_type}
                    </p>
                {/if}
            </div>
        </div>

        <!-- ITEMS ERROR -->
        {#if form.errors.items}
            <div class="mt-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4">
                <p class="text-sm text-red-500">
                    {form.errors.items}
                </p>
            </div>
        {/if}

        <!-- SUBMIT -->
        <div class="mt-8 flex justify-end">
            <button
                class="rounded-xl bg-primary px-6 py-3 font-medium text-primary-foreground transition hover:opacity-90 disabled:opacity-50"
                disabled={form.processing}
                type="submit"
            >
                {#if form.processing}
                    Processing...
                {:else}
                    Complete Order
                {/if}
            </button>
        </div>
    </div>
</form>
