<?php
/**
 * This class is responsible for providing a wrapper access to the $_SERVER superglobal.
 */
declare (strict_types=1);

namespace Maleficarum\Environment\Server;

class Server implements \ArrayAccess {
    
    /* ------------------------------------ Class Property START --------------------------------------- */
    
    /**
     * Internal storage for environmental variables.
     *
     * @var array
     */
    private $data = [];

    /* ------------------------------------ Class Property END ----------------------------------------- */

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

    /* ------------------------------------ Class Methods START ---------------------------------------- */
    
    /**
     * This method tries to return set environment for both CLI and FPM context
     *
     * @return string
     * @throws \RuntimeException
     */
    public function getCurrentEnvironment() : string {
        if (empty($this->data['APPLICATION_ENVIRONMENT'])) {
            throw new \RuntimeException(sprintf('Application environment has not been set! \%s::getCurrentEnvironment()', static::class));
        }

        return $this->data['APPLICATION_ENVIRONMENT'];
    }
    
    /* ------------------------------------ Class Methods END ------------------------------------------ */

    /* ------------------------------------ ArrayAccess methods START ---------------------------------- */
    
    /**
     * @see \ArrayAccess::offsetExists()
     */
    public function offsetExists($offset) : bool {
        return array_key_exists($offset, $this->data);
    }

    /**
     * @see \ArrayAccess::offsetGet()
     */
    public function offsetGet($offset) {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->data[$offset];
    }

    /**
     * @see \ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value) {
        throw new \RuntimeException(sprintf('Environment data is read-only. \%s::offsetSet()', static::class));
    }

    /**
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset) {
        throw new \RuntimeException(sprintf('Environment data is read-only. \%s::offsetUnset()', static::class));
    }
    
    /* ------------------------------------ ArrayAccess methods END ------------------------------------ */
}
