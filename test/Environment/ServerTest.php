<?php
declare(strict_types = 1);

/**
 * Tests for the \Maleficarum\Environment\Server class.
 */

namespace Maleficarum\Environment\Tests;

class ServerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Internal storage for env data mock
     *
     * @var array
     */
    private $envDataMock = [
        'APPLICATION_ENVIRONMENT' => 'local',
        'testKey' => 'testValue'
    ];

    /* ------------------------------------ Method: getCurrentEnvironment START ------------------------ */
    /**
     * @expectedException \RuntimeException
     */
    public function testGetCurrentEnvironmentFailure() {
        (new \Maleficarum\Environment\Server([]))->getCurrentEnvironment();
    }

    public function testGetCurrentEnvironmentSuccess() {
        $this->assertSame('local', (new \Maleficarum\Environment\Server($this->envDataMock))->getCurrentEnvironment());
    }
    /* ------------------------------------ Method: getCurrentEnvironment END -------------------------- */

    /* ------------------------------------ Method: offsetExists START --------------------------------- */
    public function testOffsetExistsSuccess() {
        $this->assertTrue((new \Maleficarum\Environment\Server($this->envDataMock))->offsetExists('testKey'));
    }

    public function testOffsetExistsFailure() {
        $this->assertFalse((new \Maleficarum\Environment\Server($this->envDataMock))->offsetExists(uniqid()));
    }
    /* ------------------------------------ Method: offsetExists END ----------------------------------- */

    /* ------------------------------------ Method: offsetUnset START ---------------------------------- */
    /**
     * @expectedException \RuntimeException
     */
    public function testOffsetUnsetException() {
        (new \Maleficarum\Environment\Server($this->envDataMock))->offsetUnset(uniqid());
    }
    /* ------------------------------------ Method: offsetUnset END ------------------------------------ */

    /* ------------------------------------ Method: offsetGet START ------------------------------------ */
    public function testOffsetGetExisting() {
        $this->assertSame('testValue', (new \Maleficarum\Environment\Server($this->envDataMock))->offsetGet('testKey'));
    }

    public function testOffsetGetNonExisting() {
        $this->assertNull((new \Maleficarum\Environment\Server($this->envDataMock))->offsetGet(uniqid()));
    }
    /* ------------------------------------ Method: offsetGet END -------------------------------------- */

    /* ------------------------------------ Method: offsetSet START ------------------------------------ */
    /**
     * @expectedException \RuntimeException
     */
    public function testOffsetSetException() {
        (new \Maleficarum\Environment\Server($this->envDataMock))->offsetSet(uniqid(), uniqid());
    }
    /* ------------------------------------ Method: offsetSet END -------------------------------------- */
}
