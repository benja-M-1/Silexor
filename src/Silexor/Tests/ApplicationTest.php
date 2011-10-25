<?php
/**
 * ApplicationTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/2011
 */

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
