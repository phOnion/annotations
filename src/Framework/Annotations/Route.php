<?php
namespace Onion\Framework\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;
use Onion\Framework\Annotations\Interfaces\AnnotationInterface;

/**
 * @Annotation
 * @Target({"CLASS"})
 */
class Route implements AnnotationInterface
{
    private $pattern;
    private $methods = [];
    private $headers = [];
    private $middleware = [];

    public function __construct($values)
    {
        $values['value'][] = [];
        $values['value'][] = [];
        $values['value'][] = [];
        list($pattern, $methods, $headers, $middleware) = $values['value'];

        $this->pattern = $pattern;
        $this->methods = $methods;
        $this->headers = $headers;
        $this->middleware = $middleware;
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

    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}
