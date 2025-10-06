<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $question
 * @property string $answer
 * @property int $quiz_id
 * @property-read \App\Models\Quiz $quiz
 * @method static \Database\Factories\FlashcardFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flashcard whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Flashcard extends Model
{
    /** @use HasFactory<\Database\Factories\FlashcardFactory> */
    use HasFactory;

    protected $fillable = ['question', 'answer', 'quiz_id'];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
