<div
    x-data="{
        show: false,
        countdown: 5,
        startCountdown() {
            this.show = true;
            this.countdown = 5;

            const timer = setInterval(() => {
                this.countdown--;

                if (this.countdown <= 0) {
                    clearInterval(timer);
                    this.goToNextLesson();
                }
            }, 1000);

            // Salvar o timer para poder cancelar
            this.timer = timer;
        },
        cancel() {
            clearInterval(this.timer);
            this.show = false;
        },
        goToNextLesson() {
            clearInterval(this.timer);
            this.show = false;
            window.location.reload()

        }
    }"
    @keydown.escape="cancel()"
    @start-count-down.window="startCountdown"
>
    <!-- Modal -->
    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4"
        style="display: none;"
    >
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="bg-zinc-900 rounded-2xl border border-zinc-800 max-w-md w-full p-8 shadow-2xl"
            @click.away="cancel()"
        >
            <!-- Ícone -->
            <div class="flex justify-center mb-6">
                <div class="bg-primary-600 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Título -->
            <h2 class="text-white text-2xl font-bold text-center mb-3">
                Próxima aula em
            </h2>

            <!-- Contador -->
            <div class="flex justify-center mb-6">
                <div class="bg-zinc-800 rounded-full w-24 h-24 flex items-center justify-center border-4 border-primary-600">
                    <span class="text-5xl font-bold text-white" x-text="countdown"></span>
                </div>
            </div>

            <!-- Descrição -->
            <p class="text-zinc-400 text-center mb-8">
                A próxima aula começará automaticamente
            </p>

            <!-- Botões -->
            <div class="flex gap-3">
                <button
                    @click="cancel()"
                    class="flex-1 bg-zinc-800 hover:bg-zinc-700 text-white font-medium py-3 px-6 rounded-lg transition-colors"
                >
                    Cancelar
                </button>
                <button
                    @click="goToNextLesson()"
                    class="flex-1 bg-primary hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition-colors"
                >
                    Iniciar agora
                </button>
            </div>
        </div>
    </div>
</div>
