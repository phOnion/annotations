<?php
/**
 * PHP Version 5.6.0
 *
 * @category Unknown Category
 * @package  Tests\Annotations
 * @author   Dimitar Dimitrov <daghostman.dd@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/phOnion/framework
 */

namespace Tests\Annotations;

use Onion\Framework\Annotations\Annotated;

class AnnotatedTest extends \PHPUnit_Framework_TestCase
{
    public function testMethodRetrieval()
    {
        $annotated = new Annotated();
        $annotated->methods[] = 'test';


        $this->assertSame(['test'], $annotated->getMethods());
        $this->assertTrue($annotated->isMethodAnnotated('test'));
    }

    public function testPropertyRetrieval()
    {
        $annotated = new Annotated();
        $annotated->properties[] = 'test';

        $this->assertSame(['test'], $annotated->getProperties());
        $this->assertTrue($annotated->isPropertyAnnotated('test'));
    }
}
