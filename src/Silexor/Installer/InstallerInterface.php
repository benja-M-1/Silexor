<?php

/**
 * InstallerInterface Interface
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 31/10/11
 */

namespace Silexor\Installer;

interface InstallerInterface
{
    /**
     * Download the library into the $path.
     *
     * @abstract
     * @param $path
     * @return void
     */
    function download($path);
}
