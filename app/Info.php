<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Info extends Model
{
    protected $appends = ['exp','status'];

    /**
     * @return string
     */
    public function getExpAttribute(): string
    {
        return Carbon::parse($this->expires_at)->addDay(-1)->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getStatusAttribute(): string
    {
        /*
         *  Status:
         *  0 - inactive
         *  1 - active
         *  2 - finished
         */
        if($this->active == "0") {
            return '0';
        }else{
            if($this->active == "1" && ($this->expires_at > Carbon::now())) {
                return '1';
            }
            return '2';
        }
    }
}
