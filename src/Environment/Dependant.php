<?php
/**
 * This trait defines common functionality for all \Maleficarum\Environment dependant classes.
 */

namespace Maleficarum\Environment;

trait Dependant
{
    /**
     * Internal storage for the environment object.
     *
     * @var \Maleficarum\Environment\Server|null
     */
    protected $environment = null;

    /* ------------------------------------ Dependant methods START ------------------------------------ */
    /**
     * Get the currently set environment object.
     *
     * @return \Maleficarum\Environment\Server|null
     */
    public function getEnvironment() {
        return $this->environment;
    }

    /**
     * Set environment.
     *
     * @param \Maleficarum\Environment\Server $environment
     *
     * @return $this
     */
    public function setEnvironment(\Maleficarum\Environment\Server $environment) {
        $this->environment = $environment;

        return $this;
    }

    /**
     * Detach the current environment object.
     *
     * @return $this
     */
    public function detachEnvironment() {
        $this->environment = null;

        return $this;
    }
    /* ------------------------------------ Dependant methods END -------------------------------------- */
}
