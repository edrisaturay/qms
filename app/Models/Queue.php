<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Venturecraft\Revisionable\RevisionableTrait;

class Queue extends Model
{
    use CrudTrait;
    use HasFactory;
    use RevisionableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'number',
        'counter_id',
        'visa_type_id',
    ];

    public static string $_QUEUE_STATUS_SERVING = 'serving';
    public static string $_QUEUE_STATUS_LINEUP = 'lineup';
    public static string $_QUEUE_STATUS_SERVED = 'served';
    public static string $_QUEUE_STATUS_CALLING = 'calling';
    public static string $_QUEUE_STATUS_RECALL = 'recall';

    public static array $queueStatuses = [
        'serving' => 'Serving',
        'lineup' => 'Lineup',
        'served' => 'Served',
        'calling' => 'Calling',
        'recall' => 'Recall',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'counter_id' => 'integer',
        'visa_type_id' => 'integer',
        'deleted_at' => 'timestamp',
    ];

    public function counter(): BelongsTo
    {
        return $this->belongsTo(Counter::class);
    }

    public function visa_type(): BelongsTo
    {
        return $this->belongsTo(VisaType::class);
    }
}
