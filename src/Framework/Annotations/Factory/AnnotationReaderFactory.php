<?php
/**
 * PHP Version 5.6.0
 *
 * @category Object Factory
 * @package  Onion\Framework\Annotations\Factory
 * @author   Dimitar Dimitrov <daghostman.dd@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/phOnion/framework
 */
namespace Onion\Framework\Annotations\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Interop\Container\ContainerInterface;
use Onion\Framework\Configuration;
use Onion\Framework\Interfaces\ObjectFactoryInterface;

class AnnotationReaderFactory implements ObjectFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return Reader
     */
    public function __invoke(ContainerInterface $container)
    {
        /**
         * @var ContainerInterface $configuration
         */
        $configuration = $container->get(Configuration::class);
        if ($configuration->has('annotations')) {
            $annotationConfig = $configuration->get('annotations');

            if (array_key_exists('namespaces', $annotationConfig)) {
                AnnotationRegistry::registerAutoloadNamespaces($annotationConfig['namespaces']);
            }

            if (array_key_exists('files', $annotationConfig)) {
                foreach ($annotationConfig['files'] as $file) {
                    AnnotationRegistry::registerFile($file);
                }
            }

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
