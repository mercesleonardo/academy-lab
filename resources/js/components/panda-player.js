// resources/js/components/panda-player.js

// Helper para aguardar tempo
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
}

function waitForPandaApi() {
    return new Promise((resolve, reject) => {
        // Se já carregou
        if (typeof window !== 'undefined' && window.PandaPlayer) {
            return resolve(window.PandaPlayer)
        }

        // A API do Panda expõe uma fila window.pandascripttag
        window.pandascripttag = window.pandascripttag || []
        const start = Date.now()

        // Tentativa periódica de detecção (fallback caso x-load-js já tenha injetado o script)
        const iv = setInterval(() => {
            if (window.PandaPlayer) {
                clearInterval(iv)
                resolve(window.PandaPlayer)
            } else if (Date.now() - start > 15000) { // timeout de 15s
                clearInterval(iv)
                reject(new Error('Panda API did not load in time'))
            }
        }, 50)
    })
}

export default function pandaPlayer({ elementId, activeLesson, options = {} }) {
    return {
        /** STATE */
        ready: false,
        error: null,
        currentTime: 0,
        isPlaying: false,
        duration: null,
        _player: null,
        _elementId: elementId || 'panda-video',
        activeLesson: activeLesson,

        /** LIFECYCLE */
        async init() {
            await waitForPandaApi()
            this.$nextTick(() => {
                this.initPlayer()
            })
        },

        changeLesson(lesson) {
            this.destroy()

            this.activeLesson = lesson
            this.$wire.setLesson(lesson)
        },

        initPlayer() {
            const player = new window.PandaPlayer(this._elementId, {
                onReady: () => {
                    player.onEvent(({ message }) => {
                        if (message === 'panda_play') {
                            if (!this.activeLesson.user_lesson_status) {
                                this.$dispatch('start-lesson')
                            }
                        } else if (message === 'panda_ended') {
                            this.$dispatch('complete-lesson')
                            this.$dispatch('start-count-down')
                        }
                    })
                },
                onError: (event) => {
                    console.log('Player onError', event)
                    window.location.reload()

                },
                ...options,
            })

            this._player = player
            console.log("O PLAYER AQUIY", this._player);

        },

        /** CLEANUP */
        destroy() {
            try { this._player?.destroy?.() } catch (_) {}
            this._player = null
        },
    }
}

window.pandaPlayer = pandaPlayer
