<?php
declare(strict_types=1);

namespace Braddle\Person;

interface NamePreference
{
    public function getPreferredName() : string;
}