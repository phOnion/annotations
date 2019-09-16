<?php
namespace Onion\Framework\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;
use Onion\Framework\Annotations\Interfaces\AnnotationInterface;

/**
 * @Annotation
 * @Target({'CLASS'})
 */
class Route implements AnnotationInterface
{
    private $pattern;
    private $methods;
    private $headers;

    public function __construct(string $pattern, array $methods, array $headers = [])
    {
        $this->pattern = $pattern;
        $this->methods = $methods;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}
