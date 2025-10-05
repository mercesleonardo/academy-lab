<div
    x-cloak
    x-data="{ open: false }"
    class="relative"
    x-on:keydown.window="
        if ($event.ctrlKey && ($event.key === 'k' || $event.key === 'K')) {
            $event.preventDefault()
            open = true
        }
    "
>
    @can('view', \App\Models\Product::find(2))
    <!-- Botão Flutuante -->
    <button
        @click="open = true"
        class="fixed bottom-8 right-4 h-16 w-16
               flex items-center justify-center
               bg-neutral-1000 text-white rounded-full
               shadow-[0_0_20px_#f44b34] z-50 cursor-pointer
               hover:scale-110 transition-all"
    >
        <img src="{{ asset('logos/mago-ia (2).png') }}">
    </button>

    <!-- Modal -->
    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
    >
        <!-- Caixa do modal -->
        <div
            class="bg-neutral-1000 rounded-xl shadow-[0_0_20px_#f44b34] w-full lg:w-1/2 pb-4"
            @click.away="open = false"
        >

            <livewire:chat-agent :agent_url="config('n8n.general_agent_endpoint')" />

        </div>
    </div>
    @endcan
</div>
