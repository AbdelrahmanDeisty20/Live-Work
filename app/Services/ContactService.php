<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public  function createContact(array $data){
            $contacts=Contact::create($data);
            return $contacts;
        }
}
