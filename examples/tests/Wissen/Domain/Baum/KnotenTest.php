<?php

namespace App\Tests\Wissen\Domain\Baum;

use App\Wissen\Domain\Baum\Knoten;
use App\Wissen\Domain\Baum\KnotenErzeugt;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Wissen\Domain\Baum\Knoten
 * @covers \App\Wissen\Domain\Baum\KnotenErzeugt
 * @covers \App\Wissen\Domain\Baum\KnotenEvent
 */
class KnotenTest extends TestCase
{
    use KnotenTestTrait;

    public function testErzeugenGibtKnotenMitAngegebenenWertenZurueck(): void
    {
        $id = $this->angenommenEinKnotenId();
        // TODO implement additional properties

        $knoten = Knoten::erzeugen($id);

        $this->assertTrue($id->equals($knoten->id()));
        // TODO implement asserts for additional properties which have getters
    }

    public function testCreateErzeugtKnotenErzeugtEvent(): void
    {
        $id = $this->angenommenEinKnotenId();
        // TODO implement additional properties

        $knoten = Knoten::erzeugen($id);

        $events = $knoten->dequeueEvents();
        $this->assertCount(1, $events);
        $this->assertContainsOnly(KnotenErzeugt::class, $events);

        /** @var KnotenErzeugt $event */
        $event = $events[0];
        $this->assertTrue($id->equals($event->aggregateId()));
        $this->assertEquals(Knoten::class, $event->aggregateType());
        // TODO implement asserts for additional properties in event
    }
}
