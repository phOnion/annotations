<?php
/**
 * PHP Version 5.6.0
 *
 * @category Annotations
 * @package  Onion\Framework\Annotations
 * @author   Dimitar Dimitrov <daghostman.dd@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/phOnion/framework
 */
namespace Onion\Framework\Annotations;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class Annotated
 *
 * @package Onion\Framework\Annotations
 *
 * @Annotation
 * @Target({"CLASS"})
 */
class Annotated
{
    public $methods = [];
    public $properties = [];

    public function getMethods()
    {
        return $this->methods;
    }

    public function isMethodAnnotated($methodName)
    {
        return in_array($methodName, $this->methods, true);
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function isPropertyAnnotated($propertyName)
    {
        return in_array($propertyName, $this->properties, true);
    }
}
