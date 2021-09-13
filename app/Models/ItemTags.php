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
        'name',
        'item_id',
        'tag_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function tag()
    {
        return $this->belongsTo(Tags::class, 'tag_id', 'id');
    }
}
