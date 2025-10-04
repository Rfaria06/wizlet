<?php

namespace App\Livewire\Flashcard;

use App\Models\Flashcard as ModelsFlashcard;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FlashcardDisplay extends Component
{
    #[Locked]
    public ModelsFlashcard $flashcard;

    public bool $flipped = false;

    public function flip(): void
    {
        $this->flipped = ! $this->flipped;
    }

    public function render()
    {
        return view('livewire.flashcard.flashcard-display');
    }
}
