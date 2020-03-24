<?php

namespace Braddle\Person;

interface PersonRetriever
{
    public function findPersonById(int $id) : NamePreference;
}