<?php
/**
 * Generator class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

namespace Silexor\Tests\Generator;

use Symfony\Component\HttpKernel\Util\Filesystem;

abstract class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected $filesystem;
    protected $tmpDir;

    public function setUp()
    {
        $this->tmpDir = __DIR__.'/../../tmp';
        $this->filesystem = new Filesystem();
        $this->filesystem->remove($this->tmpDir);
    }

    public function tearDown()
    {
        $this->filesystem->remove($this->tmpDir);
    }
}
