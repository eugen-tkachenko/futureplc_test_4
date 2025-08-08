<?php

namespace App\DTO;

interface DTOInterface {

    /**
     * @param string $key
     * 
     * @return string|null
     */
    public function getAppCode($key): ?string;

    /**
     * @param string $data
     * 
     * @return array
     */
    public function process(string $data): array;
}