<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTags extends Model
{
    use CrudTrait;
    use HasFactory;

    // use TrackableTrait;

    protected $table = 'item_tags';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
