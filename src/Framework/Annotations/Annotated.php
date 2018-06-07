<?php declare(strict_types=1);
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
class Annotated implements Interfaces\AnnotationInterface
{
    public $methods = [];

    public function getMethods(): iterable
    {
        return $this->methods;
    }

    public function isMethodAnnotated($methodName): bool
    {
        return in_array($methodName, $this->methods, true);
    }
}
