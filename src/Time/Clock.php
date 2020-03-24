<?php
declare(strict_types=1);

namespace Braddle\Time;

class Clock implements TimeProvider
{

    public function getCurrentTime(): \DateTime
    {
        return new \DateTime();
    }
}