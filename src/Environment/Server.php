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
     * @var array
     */
    private $data = [];

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
    public function getCurrentEnvironment() : string {
        if (empty($this->data['APPLICATION_ENVIRONMENT'])) {
            throw new \RuntimeException(sprintf('Application environment has not been set! \%s::getCurrentEnvironment()', static::class));
        }

        return $this->data['APPLICATION_ENVIRONMENT'];
    }
    /* ------------------------------------ Server methods END ----------------------------------------- */

    /* ------------------------------------ ArrayAccess methods START ---------------------------------- */
    /**
     * Checks if the given key exists in the array
     *
     * @see \ArrayAccess::offsetExists()
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset) : bool {
        return array_key_exists($offset, $this->data);
    }

    /**
     * Gets the element with the given key
     *
     * @see \ArrayAccess::offsetGet()
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset) {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->data[$offset];
    }

    /**
     * This method will always throw a RuntimeException. It's not allowed to set env data from the execution context.
     *
     * @see \ArrayAccess::offsetSet()
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     * @throws \RuntimeException
     */
    public function offsetSet($offset, $value) {
        throw new \RuntimeException(sprintf('Environment data is read-only. \%s::offsetSet()', static::class));
    }

    /**
     * This method will always throw a RuntimeException. It's not allowed to unset env data from the execution context.
     *
     * @see \ArrayAccess::offsetUnset()
     *
     * @param mixed $offset
     *
     * @return void
     * @throws \RuntimeException
     */
    public function offsetUnset($offset) {
        throw new \RuntimeException(sprintf('Environment data is read-only. \%s::offsetUnset()', static::class));
    }
    /* ------------------------------------ ArrayAccess methods END ------------------------------------ */
}
