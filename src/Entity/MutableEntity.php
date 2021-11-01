<?php

namespace App\Entity;

class MutableEntity
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * MutableEntity constructor.
     */
    public function __construct()
    {
        $this->data = [
            'type' => self::class
        ];
    }

    public function getDataWithKey($key)
    {
        return $this->data[$key] ?? null;
    }

    public function setDataWithKey($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return print_r($this->data, true);
    }

    /**
     *
     * @param $method
     * @param $parameters
     * @return mixed|string|void|null
     */
    public function __call($method, $parameters)
    {
        $action = substr($method, 0, 3);
        $dataName = lcfirst(substr($method, 3, strlen($method)));

        switch ($action) {
            case 'set':
                $this->setDataWithKey($dataName, $parameters);
                break;
            case 'get':
                return $this->getDataWithKey($dataName);
                break;
        }
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
