<?php


namespace App\Services;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Sms;
use App\Balance;


class SmsService
{
    protected $hash = '';
    /**
     * @return array
     */
    public function getAuthorizationHeader(): array
    {
        return [
            'Authorization' => 'Basic '.base64_encode(env('SMS_LOGIN').':'.env('SMS_PASS'))
        ];
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return env('SMS_API_URL');
    }

    /**
     * @return integer
     */
    public function getSmsType(): int
    {
        return env('SMS_TYPE');
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        if($this->getSmsType() == "3") {
            return env('SMS_NAME');
        }
        return '';

    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return env('SMS_LINK');
    }

    /**
     * @param $vocative
     * @param $sex
     * @return string
     */
    public function getMessage($vocative, $sex): string
    {
        //hardcode now, then move this to DB
        $default_text = "Dziekujemy za skorzystanie z usług kancelarii. Zapraszamy do wystawienia opinii. ".$this->getLink();
        if($sex == "f") {
            return "Pani " . $vocative . "! " . $default_text;
        }elseif ($sex == "m") {
            return "Panie " . $vocative . "! " . $default_text;
        }else {
            return "Drogi Kliencie! " . $default_text;
        }
    }

    /**
     * @param $vocative
     * @param $sex
     * @param $recipient
     * @return array
     */
    public function getPostInput($vocative, $sex, $recipient): array
    {
        return [
            'text' => $this->getMessage($vocative, $sex),
            'type' => $this->getSmsType(),
            'recipients' => $recipient,
            'sender' => $this->getSender(),
            'user-indexes' => $this->getHash(),
            'delivery-url' => env('APP_URL').'/getreport?smsId=%smsId&number=%number&report=%report&ownID=%ownID&timestamp=%timestamp',
        ];
    }

    /**
     * @return mixed
     */
    public function getSmsPrice()
    {
        return env('SMS_PRICE');
    }

    /**
     * @param $statusCode
     * @return bool
     */
    public function checkHttpStatusCode($statusCode): bool
    {
        //@todo think about handling other status codes here
        if($statusCode == "200") {
            return true;
        }
        return false;
    }

    /**
     * @param $apiStatusCode
     * @return bool
     */
    public function checkApiStatusCode($apiStatusCode): bool
    {
        //@todo think about handling other status codes here
        if($apiStatusCode == "0") {
            //PromoSms API "success" status is set to "0" - LOL ;-)
            return true;
        }
        return false;
    }

    public function reduceBalance()
    {
        //this will require another Service in the future
        try {
            $balanceReduction = Balance::first();
            $balanceReduction->balance = $balanceReduction->balance - $this->getSmsPrice();
            $balanceReduction->save();

            return true;
        }catch (\Illuminate\Database\QueryException $exception) {
            return false;
        }

    }

    public function setHash($recipient)
    {
        $this->hash = md5($recipient.time());
    }
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param $vocative
     * @param $sex
     * @param $recipientsPhoneNumber
     * @return bool
     */
    public function sendSms($vocative, $sex, $recipientsPhoneNumber): bool
    {
        //make the API call
        $this->setHash($recipientsPhoneNumber);
        $apiResponse = Http::withHeaders($this->getAuthorizationHeader())->post($this->getApiUrl(), $this->getPostInput($vocative, $sex, $recipientsPhoneNumber));
        //Log::debug('Set API request. Hash: '.$this->getHash());
        if($this->checkHttpStatusCode($apiResponse->status())) {
            //get response body from external API
            $responseBody = json_decode($apiResponse->getBody(), true);
            //store the data in DB
            $storeSms = new Sms();
            $storeSms->text = $this->getMessage($vocative,$sex);
            $storeSms->recipient = $recipientsPhoneNumber;
            $storeSms->first_response_status = $responseBody['response']['status'];
            $storeSms->hash = $this->getHash();
            $storeSms->save();

            //check for API first response to update account balance in DB
            if($this->checkApiStatusCode($responseBody['response']['status'])) {
                $this->reduceBalance();
            }
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function storeExternalReport(Request $request): bool
    {
        /*
         * Status from PromoSMS (different than the first_response):
         *  0 - pending
         *  1 - delivered
         *  4 or 8 - sent
         *  2 or 16 - not delivered
         */
        $date = Carbon::createFromTimestamp($request->timestamp);
        Sms::where('hash', '=', $request->ownID)->update(['last_response_status' => $request->report, 'delivered_at' => $date]);
        return true;
    }
}
