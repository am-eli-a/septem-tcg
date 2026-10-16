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
        return $this->belongsToMany(User::class, 'user_cards', 'card_id', 'user_id')->withPivot('quantity');
    }

    public function scopeVisibleTo($query, ?User $user)
    {
        if ($user && $user->isValidator()) {
            return $query;
        }

        $query->where('status', 'approved');

        if (!$user || !$user->isMember()) {
            $query->where('visibility', 'public');
        }

        return $query;
    }
}
