<?php
declare(strict_types=1);

namespace model;

class Data
{
    public array $data;

    public function __construct()
    {
        $this->data = [];
    }




    public function getFullData(): array
    {
        return $this->data;
    }

    public function setData(array $value)
    {
        $this->data = $value;
    }

    public function addData(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function removeData(string $key)
    {
        unset($this->data[$key]);
    }

    public function getData(string $key) {
        return $this->data[$key] ?? null;
    }
}