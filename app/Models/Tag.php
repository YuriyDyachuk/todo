<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [];


    ############################## [RELATION METHOD] ##############################

    public function todos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Todo::class,'tag_todo','tag_id','todo_id')
                    ->withPivot('tag_id','todo_id');
    }
}
