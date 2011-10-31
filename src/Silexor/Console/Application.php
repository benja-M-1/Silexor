<?php
/**
 * Application class
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

namespace Silexor\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Silexor\Command\GenerateProjectCommand;

class Application extends BaseApplication
{
    const VERSION = '0.0.1';

    public function __construct()
    {
        parent::__construct('silexor', self::VERSION);

        $this->registerCommands();
    }

    /**
     * Register Silexor commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->add(new GenerateProjectCommand());
    }
}
