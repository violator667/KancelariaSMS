<?php
namespace App\Services;

use App\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ClientService
{
    public $client;
    /**
     * @param $phoneNumber
     * @return bool
     */
    public function checkIfClientExistsByPhoneNumber($phoneNumber): bool
    {
        return Client::where('phone_number' , $phoneNumber)->get()->isNotEmpty();
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $phoneNumber
     * @param null $notes
     * @return bool
     */
    public function addClient($firstName, $lastName, $phoneNumber, $notes = null): bool
    {
        if($this->checkIfClientExistsByPhoneNumber($phoneNumber) === false)
        {
            $newClient = new Client();
            $newClient->name = $firstName;
            $newClient->surname = $lastName;
            $newClient->phone_number = $phoneNumber;
            $newClient->notes = $notes;
            $newClient->save();
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return Client|false|Builder|Model|object|null
     */
    public function getClient($id)
    {
        return Client::whereId($id)->first();
    }

    /**
     * @param $request
     * @return bool
     */
    public function updateClient($request): bool
    {
        Client::where('id',$request->id)->update(
            [
                'name' => $request->name,
                'surname' => $request->surname,
                'phone_number' => $request->phone_number,
                'notes' => $request->notes
            ]);
        return true;
    }

    public function removeClient($id): bool
    {
        if(Client::destroy($id))
        {
            return true;
        }
        return false;
    }
}
