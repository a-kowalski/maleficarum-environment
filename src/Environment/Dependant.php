<?php
/**
 * This trait defines common functionality for all \Maleficarum\Environment dependant classes.
 */
declare (strict_types=1);

namespace Maleficarum\Environment;

trait Dependant {
    /* ------------------------------------ Class Property START --------------------------------------- */

    /**
     * Internal storage for the environment object.
     *
     * @var \Maleficarum\Environment\Server\Server
     */
    protected $environment = null;

    /* ------------------------------------ Class Property END ----------------------------------------- */

    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * Get the currently set environment object.
     *
     * @return \Maleficarum\Environment\Server\Server|null
     */
    public function getEnvironment(): ?\Maleficarum\Environment\Server\Server {
        return $this->environment;
    }

    /**
     * Set environment.
     *
     * @param \Maleficarum\Environment\Server\Server $environment
     *
     * @return \Maleficarum\Environment\Dependant
     */
    public function setEnvironment(\Maleficarum\Environment\Server\Server $environment) {
        $this->environment = $environment;

        return $this;
    }

    /**
     * Detach the current environment object.
     *
     * @return \Maleficarum\Environment\Dependant
     */
    public function detachEnvironment() {
        $this->environment = null;

        return $this;
    }

    /* ------------------------------------ Class Methods END ------------------------------------------ */
}
