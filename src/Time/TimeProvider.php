<?php
declare(strict_types=1);

namespace Braddle\Time;

interface TimeProvider
{
    public function getCurrentTime() : \DateTime;
}