<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PracticeRecord
 *
 * @property int $id
 * @property int $segment_id
 * @property int $user_id
 * @property string $session_uuid
 * @property float $tempo_multiplier
 * @property int $qty_available_notes
 * @property int $qty_correctly_played_notes
 * @property int $qty_incorrectly_played_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Segment $segment
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereQtyAvailableNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereQtyCorrectlyPlayedNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereQtyIncorrectlyPlayedNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereSegmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereSessionUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereTempoMultiplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeRecord whereUserId($value)
 * @mixin Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class PracticeRecord extends Model
{
    use HasFactory;

    const COLUMN_ID = "id";
    const COLUMN_SEGMENT_ID = "segment_id";
    const COLUMN_USER_ID = "user_id";
    const COLUMN_SESSION_UUID = "session_uuid";
    const COLUMN_TEMPO_MULTIPLIER = "tempo_multiplier";
    const COLUMN_QTY_AVAILABLE_NOTES = "qty_available_notes";
    const COLUMN_QTY_CORRECTLY_PLAYED_NOTES = "qty_correctly_played_notes";
    const COLUMN_QTY_INCORRECTLY_PLAYED_NOTES = "qty_incorrectly_played_notes";
    const COLUMN_CREATED_AT = "created_at";
    const COLUMN_UPDATED_AT = "updated_at";


    /**
     * Get the user who created this practice record
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the segment associated with this practice record
     */
    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'segment_id',
        'user_id',
        'session_uuid',
        'tempo_multiplier',
        'qty_available_notes',
        'qty_correctly_played_notes',
        'qty_incorrectly_played_notes',
    ];
}
