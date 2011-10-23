<?php

namespace Silexor\Tests;

use Silexor\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $application = new Application();

        $this->assertEquals('silexor', $application->getName());
        $this->assertTrue($application->has('project:generate'));
    }
}
