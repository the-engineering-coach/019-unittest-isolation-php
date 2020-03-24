<?php
declare(strict_types=1);

namespace Braddle\Greeting;

use Braddle\Person\NamePreference;
use Braddle\Person\PersonRetriever;
use Braddle\Time\TimeProvider;
use Mockery as m;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

class PersonGreeterTest extends TestCase
{
    const ID = 123;

    private $timeProvider;
    private PersonGreeter $greeter;

    protected function setUp() : void
    {
        parent::setUp();

        $person = m::Mock(NamePreference::class);
        $person->shouldReceive("getPreferredName")
            ->andReturn("Dave");

        $retriever = m::Mock(PersonRetriever::class);
        $retriever->shouldReceive("findPersonById")
            ->with(self::ID)
            ->andReturn($person);

        $this->timeProvider = m::Mock(TimeProvider::class);

        $this->greeter = new PersonGreeter($retriever, $this->timeProvider);
    }


    public function testSimpleGreetingForUser()
    {
        $this->assertEquals(
            "Hello, Dave",
            $this->greeter->greet(self::ID)
        );
    }

    public function testTimeSpecificMorningGreeting()
    {
        $this->timeProvider->shouldReceive("getCurrentTime")
            ->andReturn(
                \DateTime::createFromFormat(
                    "d-m-Y H:i:s",
                    "21-03-2020 09:00:00"
                )
            );

        $this->assertEquals(
            "Good Morning, Dave",
            $this->greeter->timeGreet(self::ID)
        );
    }

    public function testTimeSpecificGreetingAfternoon()
    {
        $this->timeProvider->shouldReceive("getCurrentTime")
            ->andReturn(
                \DateTime::createFromFormat(
                    "d-m-Y H:i:s",
                    "21-03-2020 13:00:00"
                )
            );

        $this->assertEquals(
            "Good Afternoon, Dave",
            $this->greeter->timeGreet(self::ID)
        );
    }

    public function testTimeSpecificEveningGreeting()
    {
        $this->timeProvider->shouldReceive("getCurrentTime")
            ->andReturn(
                \DateTime::createFromFormat(
                    "d-m-Y H:i:s",
                    "21-03-2020 20:00:00"
                )
            );

        $this->assertEquals(
            "Good Evening, Dave",
            $this->greeter->timeGreet(self::ID)
        );
    }


}