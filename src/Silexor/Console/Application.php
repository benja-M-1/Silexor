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
    }

    /**
     * Runs the current application.
     *
     * @param InputInterface  $input  An Input instance
     * @param OutputInterface $output An Output instance
     *
     * @return integer 0 if everything went fine, or an error code
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->registerCommands();

        return parent::doRun($input, $output);
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
