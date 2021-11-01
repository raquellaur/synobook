<?php

namespace App\Mysql;

use PDO;

class Connection
{
    protected $pdo;

    function __construct($host, $user, $password, $dbname, $port)
    {
        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port",$user,$password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function request($request, $data = [], $fetch = true)
    {
        $stmt = $this->pdo->prepare($request);

        foreach($data as $key => $value)
        {
            $stmt->bindValue(':'.$key,$value);
        }

        $stmt->execute();

        return ($fetch) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->errorCode();

    }

}