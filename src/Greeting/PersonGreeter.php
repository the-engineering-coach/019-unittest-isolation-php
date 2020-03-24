<?php
declare(strict_types=1);

namespace Braddle\Greeting;

use Braddle\Person\PersonRetriever;
use Braddle\Time\TimeProvider;

class PersonGreeter
{

    private PersonRetriever $retriever;
    private TimeProvider $timeProvider;

    public function __construct(
        PersonRetriever $retriever,
        TimeProvider $timeProvider
    ) {
        $this->retriever = $retriever;
        $this->timeProvider = $timeProvider;
    }

    public function greet(int $id) :string
    {
        $person = $this->retriever->findPersonById($id);

        return "Hello, " . $person->getPreferredName();
    }

    public function timeGreet(int $id)
    {
        $person = $this->retriever->findPersonById($id);

        $time = $this->timeProvider->getCurrentTime();

        $moment = "Morning";

        if ($time->format("H") > 18) {
            $moment = "Evening";
        } elseif ($time->format("H") > 12) {
            $moment = "Afternoon";
        }

        return "Good " . $moment . ", " . $person->getPreferredName();
    }
}