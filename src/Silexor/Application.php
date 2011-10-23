<?php
/*
 * This file is part of the Symfony package.
 *
 * (c) Benjamin Grandfond <benjamin.grandfond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
    const VERSION = '0.0.1';

    public function __construct()
    {
        parent::__construct('silexor', self::VERSION);

        $this->add(new GenerateProjectCommand());

    }
}
