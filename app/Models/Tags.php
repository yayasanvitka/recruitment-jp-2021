<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use CrudTrait;
    use HasFactory;

    // use TrackableTrait;

    protected $table = 'tags';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function group()
    {
        return $this->belongsTo(Item::class, 'item_Tags', 'id');
    }
}
