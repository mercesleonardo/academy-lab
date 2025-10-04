<x-filament-panels::page>
    <div class="flex w-full flex-col lg:flex-row items-center justify-center gap-8 py-8">
        @foreach($products as $product)

            <x-product-card :$product />

        @endforeach
    </div>
</x-filament-panels::page>
