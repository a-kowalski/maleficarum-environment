<?php
/**
 * This class carries ioc initialization functionality used by this component.
 */
declare (strict_types=1);

namespace Maleficarum\Environment\Initializer;

class Initializer {
    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * This method will initialize the entire package.
     *
     * @param array $opts
     *
     * @return string
     */
    static public function initialize(array $opts = []): string {
        // load default builder if skip not requested
        $builders = $opts['builders'] ?? [];
        is_array($builders) or $builders = [];
        if (!isset($builders['environment']['skip'])) {
            \Maleficarum\Ioc\Container::register('Maleficarum\Environment\Server\Server', function () {
                return (new \Maleficarum\Environment\Server\Server($_SERVER));
            });
        }

        /* @var $environment \Maleficarum\Environment\Server */
        $environment = \Maleficarum\Ioc\Container::get('Maleficarum\Environment\Server\Server');
        \Maleficarum\Ioc\Container::registerDependency('Maleficarum\Environment', $environment);
        error_reporting(-1);

        return __METHOD__;
    }

    /* ------------------------------------ Class Methods END ------------------------------------------ */
}
