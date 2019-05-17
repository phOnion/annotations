<?php declare(strict_types=1);
namespace Onion\Framework\Annotations\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Onion\Framework\Dependency\Interfaces\FactoryInterface;
use Psr\Container\ContainerInterface;

class AnnotationReaderFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return Reader
     */
    public function build(ContainerInterface $container)
    {
        if ($container->has('annotations')) {
            $annotationConfig = $container->get('annotations');
            AnnotationRegistry::registerLoader('class_exists');

            if (array_key_exists('cache', $annotationConfig)) {
                return new CachedReader(
                    new AnnotationReader(),
                    $container->get($annotationConfig['cache'])
                );
            }
        }

        return new AnnotationReader();
    }
}
