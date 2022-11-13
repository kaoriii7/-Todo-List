<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'tag_id', 'user_id'];

    public function tag() {
        return $this->belongsTo(Tag::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
