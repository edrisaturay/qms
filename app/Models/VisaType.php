<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaType extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;

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
}
