<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['title', 'path', 'type', 'visibility',  'description'];

    public function uploaded() {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'users_card', 'card_id', 'user_id')->withPivot('quantity');
    }
}
