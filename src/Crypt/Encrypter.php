<?php

namespace App\Crypt;

class Encrypter
{
    public function encrypt($data): string
    {
        return sha1($data);
    }
}
