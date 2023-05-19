<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Counter extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;
    use RevisionableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'user_id',
    ];

    public static string $COUNTER_STATUS_SERVING = 'serving';
    public static string $COUNTER_STATUS_FREE = 'free';
    public static string $COUNTER_STATUS_CALLING = 'calling';
    public static string $COUNTER_STATUS_CLOSED = 'closed';
    public static string $COUNTER_STATUS_AWAY = 'away';

    public array $queue_statuses = [
        'serving' => 'Serving',
        'free' => 'Free',
        'calling' => 'Calling',
        'closed' => 'Closed',
        'away' => 'Away',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'boolean',
        'deleted_at' => 'timestamp',
    ];

    public function identifiableAttribute()
    {
        return 'name';
    }
    public function identifiableName() {
        return $this->name;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visa_types(): BelongsToMany
    {
        return $this->belongsToMany(VisaType::class);
    }
}
