<?php

namespace App\Livewire;

use App\Models\Lesson;
use App\Models\Message;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatAgent extends Component
{

    public array $messages = [
        [
            'role' => 'agent',
            'message' => 'Olá! Sou seu assistente de IA. Posso ajudar com dúvidas sobre a aula. Como posso te ajudar hoje?',
        ],
    ];
    public string $message = '';
    public $activelesson;
    public $loading = false;
    public $agent_url;

    public function mount()
    {
        if ($this->activelesson) {

            $messages = Message::where('lesson_id', $this->activelesson->id)
                ->where('user_id', auth()->id())
                ->orderBy('id', 'asc')
                ->get()->toArray();

            $this->messages = array_merge($this->messages, $messages);

        }
    }

    public function render()
    {
        return view('livewire.chat-agent');
    }

    public function addMessage()
    {
        if (trim($this->message) === '') {
            return;
        }

        $this->dispatch('call-agent', ['message' => $this->message]);
        $this->messages[] = ['role' => 'user', 'message' => $this->message];
        $this->message = "";
        $this->dispatch('scroll-to-bottom');
        $this->loading = true;

    }

    #[On('call-agent')]
    public function chatToAgent($data)
    {

        Message::create([
            'role' => 'user',
            'message' => $data['message'],
            'lesson_id' => $this->activelesson->id ?? null,
            'user_id' => auth()->id(),
        ]);

        $response = Http::timeout(0)
            ->retry(3, 1000)
            ->post($this->agent_url, [
            'message' => $data['message'],
            'lesson_id' => $this->activelesson->id ?? null,
        ]);


            if ($response->ok()) {
                if ($this->activelesson) {
                    $data = $response->json();
                    Message::create([
                        'role' => 'agent',
                        'message' => $data['output'],
                        'lesson_id' => $this->activelesson->id ?? null,
                        'user_id' => auth()->id(),
                    ]);

                    $this->messages[] = ['role' => 'agent', 'message' => $data['output']];
                } else {
                    $this->processGlobalAgentResponse($response);
                }


            }else {
                $this->messages[] = [
                    'role' => 'agent',
                    'message' => 'Tive um problema ao responder agora. Pode tentar novamente?',
                ];
            }

        $this->loading = false;
        $this->dispatch('scroll-to-bottom');

    }

    public function processGlobalAgentResponse($response)
    {
        $data = $response->json();

        Message::create([
            'role' => 'agent',
            'message' => $data['output']['response'],
            'lesson_id' => $this->activelesson->id ?? null,
            'extra_attributes' => $data['output']['lessons'] ?? null,
            'user_id' => auth()->id(),
        ]);

        $lessons_collect = collect($data['output']['lessons'] ?? []);
        $lessons = Lesson::whereIn('id', $lessons_collect->pluck('lesson_id'))->get(['id', 'name']);

        $this->messages[] = [
            'role' => 'agent',
            'message' => $data['output']['response'],
            'extra_attributes' => $lessons_collect->map(function ($item) use ($lessons) {
                return [
                    ...$item,
                    ...$lessons->where('id', $item['lesson_id'])->first()->toArray(),
                ];
            })->toArray(),
        ];
    }
}
