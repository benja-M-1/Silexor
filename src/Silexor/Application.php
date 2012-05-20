<?php
/**
 * Application class
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

namespace Silexor;

use Symfony\Component\Console\Application as BaseApplication;
use Silexor\Command\GenerateProjectCommand;

class Application extends BaseApplication
{
    const VERSION = '0.0.2';

    public function __construct()
    {
        parent::__construct('silexor', self::VERSION);

        $this->add(new GenerateProjectCommand());
    }
}
