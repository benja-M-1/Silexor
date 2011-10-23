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
 * ProjectGeneratorTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/2011
 */

namespace Silexor\Tests\Generator;

use Silexor\Tests\Generator\GeneratorTest;
use Silexor\Generator\ProjectGenerator;

class ProjectGeneratorTest extends GeneratorTest
{
    public function testGenerate()
    {
        $generator = new ProjectGenerator('test', $this->tmpDir);
        $generator->generate();

        $files = array(
            'phpunit.xml.dist',
            'src/app.php',
            'tests/bootstrap.php',
            'tests/ControllerTest.php',
            'vendor/silex.phar',
            'web/index.php',
        );

        foreach ($files  as $file) {
            $this->assertTrue(file_exists($this->tmpDir.'/test/'.$file), sprintf('"%s" has been generated in "%s"', $file, $this->tmpDir));
        }

        $this->assertContains('$app = new Silex\Application();', file_get_contents($this->tmpDir.'/test/src/app.php'));
        $this->assertContains('$app->run()', file_get_contents($this->tmpDir.'/test/web/index.php'));
        $this->assertContains('class ControllerTest extends WebTestCase', file_get_contents($this->tmpDir.'/test/tests/ControllerTest.php'));
        $this->assertContains('require_once __DIR__.\'/../vendor/silex.phar\';', file_get_contents($this->tmpDir.'/test/tests/bootstrap.php'));
        $this->assertContains('bootstrap="tests/bootstrap.php"', file_get_contents($this->tmpDir.'/test/phpunit.xml.dist'));
        $this->assertNotContains('{{ name }}', file_get_contents($this->tmpDir.'/test/phpunit.xml.dist'));
    }
}
