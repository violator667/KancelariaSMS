<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = [
        'first_response_status',
        'recipient',
        'text'
    ];

    /**
     * @return string
     */
    public function firstResponseStatusTxt(): string
    {
        if($this->first_response_status == "0") {
            return __('wysłano');
        }else{
            return __('błąd wysyłki');
        }
    }

    /**
     * @return string
     */
    public function lastResponseStatusTxt(): string
    {
        /*
         * Status from PromoSMS (different than the first_response):
         *  0 - pending
         *  1 - delivered
         *  4 or 8 - sent
         *  2 or 16 - not delivered
         */
        switch ($this->last_response_status) {
            case null:
                return __('brak raportu');
            case 0:
                return __('oczekuje');
            case 1:
                return __('dostarczono');
            case 8:
            case 4:
                return __('wysłano');
            case 16:
            case 2:
                return __('niedostarczono');
        }
    }
}
