<?php
/**
 * Created by JetBrains PhpStorm.
 * User: benjamin
 * Date: 23/10/11
 * Time: 19:42
 * To change this template use File | Settings | File Templates.
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
