<div>
    <div class="bg-neutral-1000/30 rounded-lg shadow-sm"
        x-data="{
            scrollToBottom() {
                $nextTick(() => {
                    const el = $refs.chatContainer;
                    if (!el) return;
                    el.scrollTop = el.scrollHeight;
                });
            }
        }"
         x-init="
            scrollToBottom();
        "
         x-on:livewire:update="scrollToBottom()"
         @scroll-to-bottom.window="scrollToBottom"
    >
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-neutral-900">
            <div class="flex items-center space-x-3">
                <div
                    class="w-12 h-12 flex items-center justify-center">
                    <img src="{{ asset('logos/mago-ia (2).png') }}" class="w-full">
                </div>
                <div>
                    <h3 class="font-semibold text-white-900">VirguIA</h3>
                    <p class="text-xs text-white-500">Online • Responde em segundos</p>
                </div>
            </div>
        </div>

        <!-- Chat Messages -->
        <div  x-ref="chatContainer" id="chatContainer" class="h-80 overflow-y-auto p-4 space-y-4">
            @foreach ($messages as $message)
                <div
                    @class([
                        'flex',
                        'justify-start' => $message['role'] == 'agent',
                        'justify-end' => $message['role'] == 'user',
                    ])
                >
                    <div

                        @class([
                            "flex space-x-2",
                            "justify-start" => $message['role'] == 'agent',
                            "justify-end" => $message['role'] == 'user',
                        ])>
                        <div @class([
                            "text-gray-800 px-4 py-2 rounded-2xl max-w-3/4",
                            "bg-gray-100 rounded-bl-sm" => $message['role'] == 'agent',
                            "bg-primary-light rounded-br-sm" => $message['role'] == 'user',
                        ])>
                            <p class="text-sm !text-gray-800 richtext">
                                {!! $message['message'] !!}

                            @if (isset($message['extra_attributes']))
                                <ul>
                                    @foreach($message['extra_attributes'] as $attribute)
                                        <li><strong>{{ $attribute['name'] }}</strong>: a partir de: {{ $attribute['start'] }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            </p>
                            <p class="text-xs text-gray-500 mt-1">agora</p>

                        </div>
                    </div>
                </div>
            @endforeach

                @if($loading)
                    <div class="flex justify-start">
                        <div class="bg-gray-100 text-gray-800 px-4 py-2 rounded-2xl rounded-bl-sm max-w-xs">
                            <div class="flex items-center gap-1">
                                <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay:0ms"></div>
                                <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay:150ms"></div>
                                <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay:300ms"></div>
                            </div>
                        </div>
                    </div>
                @endif
        </div>

        <!-- Input Area -->
        <div class="relative w-full max-w-4xl mx-auto p-2">
            <!-- Container do input -->
            <div class="relative flex items-end gap-2 rounded-3xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 shadow-lg focus-within:border-gray-400 dark:focus-within:border-gray-500 transition-colors">

                <textarea
                    wire:model="message"
                    wire:keydown.ctrl.enter.prevent="addMessage"
                    wire:keydown.meta.enter.prevent="addMessage"
                    rows="1"
                    placeholder="Mande sua duvida"
                    class="field-sizing-content flex-1 resize-none bg-transparent px-4 py-3 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none max-h-52 overflow-y-auto"
                ></textarea>

                <button
                    wire:click="addMessage"
                    type="submit"
                    class="flex-shrink-0 mb-2 mr-2 w-8 h-8 rounded-full bg-black dark:bg-white text-white dark:text-black flex items-center justify-center hover:opacity-80 transition-opacity disabled:opacity-40 disabled:cursor-not-allowed"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                    </svg>

                </button>
            </div>
        </div>
    </div>
</div>
