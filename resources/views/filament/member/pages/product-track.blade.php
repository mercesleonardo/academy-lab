<x-filament-panels::page>
    <header class="pt-10 relative">
        <section class="mx-auto max-w-6xl px-4 text-center mt-6 z-10 relative">
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">{{ $product->name }}</h1>
            <p class="mt-3 text-primary">
                {!! $product->description !!}
            </p>
        </section>
        <div class="px-4 h-[300px] overflow-hidden absolute w-full top-0 z-1 mask-radial-top">
            <img alt="Capa" src="{{ \Illuminate\Support\Facades\Storage::temporaryUrl($product->cover, now()->addMinute()) }}" class="w-full object-cover"/>
        </div>
    </header>

    <!-- hero -->


    <main class="mx-auto max-w-6xl px-4 mt-32 pb-24">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-12">
            @foreach ($product->productTracks as $track)
            <!-- Card da esquerda -->
            <x-track-card :track="$track" />

            <!-- Timeline da direita -->
            <section class="lg:col-span-7">
                <ol class="relative border-s border-primary/80 pl-6">
                    <!-- item -->

                    @foreach($track->productTrackPaths as $path)
                        <li class="mb-10 ms-4">
                            <span class="absolute -start-2.5 mt-1 flex h-5 w-5 items-center justify-center rounded-full bg-primary ring-2 ring-primary/60"></span>
                            <div class="flex items-start gap-4">
                                <div class="h-14 w-14 shrink-0 rounded-full bg-primary/70 ring-1 ring-white/10 overflow-hidden">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::temporaryUrl($path->path->cover, now()->addMinute()) }}" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <a href="{{ route('filament.member.pages.produto.{product}.class-room.{path}.{slug}', [
                                            'product' => $product->id,
                                            'path' => $path->path->id,
                                            'slug' => $path->path->slug
                            ]) }}" class="text-lg font-semibold hover:underline">{{ $path->path->name }}</a>
                                    <p class="text-sm text-primary">{{ $path->path->description }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach

                </ol>
            </section>
            @endforeach

        </div>
    </main>
</x-filament-panels::page>
