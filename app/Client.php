<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $appends = ['has_note'];
    public function getHasNoteAttribute(): bool
    {
        if($this->notes !== null) {
            return true;
        }
        return false;
    }
}
