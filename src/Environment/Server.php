<?php
/**
 * This class is responsible for providing a wrapper access to the $_SERVER superglobal.
 *
 * @implements \ArrayAccess
 */

namespace Maleficarum\Environment;

class Server implements \ArrayAccess
{
    /**
     * Internal storage for environmental variables.
     *
     * @var array|null
     */
    private $data = null;

    /* ------------------------------------ Magic methods START ---------------------------------------- */
    /**
     * Create a new Server object.
     *
     * @param array $serverData
     */
    public function __construct(array $serverData) {
        $this->data = $serverData;
    }
    /* ------------------------------------ Magic methods END ------------------------------------------ */

    /* ------------------------------------ Server methods START --------------------------------------- */
    /**
     * This method tries to return set environment for both CLI and FPM context
     *
     * @return string
     * 
     * @throws \RuntimeException
     */
    public function getCurrentEnvironment() {
        if (array_key_exists('APPLICATION_ENVIRONMENT', $this->data)) {
            return $this->data['APPLICATION_ENVIRONMENT'];
        }

        throw new \RuntimeException('Application environment has not been set!!! \Maleficarum\Environment\Server::getCurrentEnvironment()');
    }
    /* ------------------------------------ Server methods END ----------------------------------------- */

    /* ------------------------------------ ArrayAccess methods START ---------------------------------- */
    /**
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, $this->data);
    }

    /**
     * This method will always throw a RuntimeException. It's not allowed to set env data from the execution context.
     *
     * @see ArrayAccess::offsetUnset()
     * 
     * @throws \RuntimeException
     */
    public function offsetUnset($offset) {
        throw new \RuntimeException('Environment data is read-only. \Maleficarum\Environment\Server::offsetUnset()');
    }

    /**
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset) {
        if (array_key_exists($offset, $this->data)) {
            return $this->data[$offset];
        } else {
            return null;
        }
    }

    /**
     * This method will always throw a RuntimeException. It's not allowed to set env data from the execution context.
     *
     * @see ArrayAccess::offsetSet()
     * 
     * @throws \RuntimeException
     */
    public function offsetSet($offset, $value) {
        throw new \RuntimeException('Environment data is read-only. \Maleficarum\Environment\Server::offsetSet()');
    }
    /* ------------------------------------ ArrayAccess methods END ------------------------------------ */
}
