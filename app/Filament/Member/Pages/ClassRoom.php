<?php

namespace App\Filament\Member\Pages;

use App\Models\Lesson;
use App\Models\LessonMaterial;
use App\Models\Path;
use App\Models\Product;
use Filament\Pages\Page;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class ClassRoom extends Page
{
    protected string $view = 'filament.member.pages.class-room';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $slug = 'produto/{product}/class-room/{path}/{slug}';
    protected static ?string $title = '';
    protected static string $layout = 'filament-panels::components.layout.base';

    public Product $product;
    public Path $path;
    public Lesson $activelesson;
    public int $product_track_path_id;

    #[Url]
    public $lesson_id;

    public static function canAccess(): bool
    {
        $product = request()->route('product');
        $path = request()->route('path');

        return auth()->user()->can('accessClassRoom', [$product,$path]);
    }

    public function mount(Product $product, Path $path): void
    {
        $this->product = $product;
        $this->path = $path->load([
            'modules.lessons',
            'modules.lessons.userLessonStatus' => fn($query) => $query->where('product_track_path_id', $this->path->getProductTrackPathId($this->product->id))
        ]);
        $this->product_track_path_id = $this->path->getProductTrackPathId($this->product->id);


        $this->nextLesson($this->lesson_id);
    }

    public function nextLesson($targetLessonId = null)
    {
        $lessonsOrdered = $this->path->modules
            ->flatMap(fn ($m) => collect($m['lessons'])->sortBy('position'));


        if ($targetLessonId) {

            $targetLesson = $lessonsOrdered->first(fn ($lesson) => $lesson->id == $targetLessonId);

        } else {
            $firstIncomplete = $lessonsOrdered
                ->first(function ($lesson) {
                    return empty($lesson->userLessonStatus)
                        || is_null($lesson->userLessonStatus->completed_at);
                });

            $targetLesson = $firstIncomplete ?: $lessonsOrdered->first();
        }

        if (!$targetLesson)
        {
            abort(404);
        }

        $this->setLesson($targetLesson);
    }

    public function setLesson(Lesson $lesson): void
    {
        $this->activelesson = $lesson;
    }

    public function download(LessonMaterial $material)
    {
        return Storage::download($material->file);
    }

    #[On('complete-lesson')]
    public function completeLesson($reRender = false)
    {
        if ($this->activelesson->userLessonStatus) {
            $this->activelesson->userLessonStatus()
                ->where('product_track_path_id', $this->product_track_path_id)
                ->update(['completed_at' => now()]);
        }

        $this->activelesson->userLessonStatus()->firstOrCreate([
            'user_id' => auth()->id(),
            'product_track_path_id' => $this->product_track_path_id,
            'lesson_id' => $this->activelesson->id
        ], [
            'completed_at' => now(),
        ]);

        $this->nextLesson();

        if (!$reRender){
            $this->skipRender();
        }


    }

    #[On('start-lesson')]
    public function startLessonStatus()
    {
        $this->activelesson->userLessonStatus()->firstOrCreate([
            'user_id' => auth()->id(),
            'product_track_path_id' => $this->product_track_path_id,
            'lesson_id' => $this->activelesson->id
        ], [
            'started_at' => now(),
        ]);

        $this->skipRender();

    }

}
