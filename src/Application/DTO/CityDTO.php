<?php

declare(strict_types=1);

namespace Kata\Application\DTO;

class CityDTO
{

    /**
     * @var int
     */
    public $cityLimitX;

    /**
     * @var int
     */
    public $cityLimitY;

    public function __construct(string $cityLimitX, string $cityLimitY)
    {
        $this->cityLimitX = $cityLimitX;
        $this->cityLimitY = $cityLimitY;
    }
}
