<?php
/**
 * Tests for the \Maleficarum\Environment\Server class.
 */

namespace Test\Maleficarum\Environment;

class ServerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * ATTRIBUTES
     */

    private $envDataMock = [
        'APPLICATION_ENVIRONMENT' => 'local',
        'testKey' => 'testValue'
    ];

    /**
     * TESTS
     */

    /**  METHOD: \Maleficarum\Environment\Server::getCurrentEnvironment() */

    /**
     * @expectedException \RuntimeException
     */
    public function testGetcurrentenvironmentFailure() {
        (new \Maleficarum\Environment\Server([]))->getCurrentEnvironment();
    }

    public function testGetcurrentenvironmentSuccess() {
        $this->assertSame('local', (new \Maleficarum\Environment\Server($this->envDataMock))->getCurrentEnvironment());
    }

    /** METHOD: \Maleficarum\Environment\Server::offsetExists() */

    public function testOffsetexistsSuccess() {
        $this->assertTrue((new \Maleficarum\Environment\Server($this->envDataMock))->offsetExists('testKey'));
    }

    public function testOffsetexistsFailure() {
        $this->assertFalse((new \Maleficarum\Environment\Server($this->envDataMock))->offsetExists(uniqid()));
    }

    /** METHOD: \Maleficarum\Environment\Server::offsetUnset() */

    /**
     * @expectedException \RuntimeException
     */
    public function testOffsetunsetException() {
        (new \Maleficarum\Environment\Server($this->envDataMock))->offsetUnset(uniqid());
    }

    /** METHOD: \Maleficarum\Environment\Server::offsetGet() */

    public function testOffsetGetExisting() {
        $this->assertSame('testValue', (new \Maleficarum\Environment\Server($this->envDataMock))->offsetGet('testKey'));
    }

    public function testOffsetGetNonExisting() {
        $this->assertNull((new \Maleficarum\Environment\Server($this->envDataMock))->offsetGet(uniqid()));
    }

    /** METHOD: \Maleficarum\Environment\Server::offsetSet() */

    /**
     * @expectedException \RuntimeException
     */
    public function testOffsetsetException() {
        (new \Maleficarum\Environment\Server($this->envDataMock))->offsetSet(uniqid(), uniqid());
    }
}
