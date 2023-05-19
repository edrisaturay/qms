<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class VisaType extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;
    use RevisionableTrait;

    public static int $FAMILY_REUNIFICATION = 1;
    public static int $HUMANITARIAN = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'code',
        'starting_number',
        'status',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    public function identifiableAttribute()
    {
        return 'name';
    }
    public function identifiableName() {
        return $this->name;
    }
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

    public function counters()
    {
        return $this->belongsToMany(\App\Models\Counter::class);
    }

    public function queue(){
        return $this->hasMany(Queue::class);
    }
}
