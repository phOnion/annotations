<?php
/**
 * PHP Version 5.6.0
 *
 * @category Unknown Category
 * @package  Tests\Factory
 * @author   Dimitar Dimitrov <daghostman.dd@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/phOnion/framework
 */

namespace Tests\Annotations\Factory;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\Cache;
use Psr\Container\ContainerInterface;
use Onion\Framework\Configuration;
use Onion\Framework\Annotations\Factory\AnnotationReaderFactory;

class AnnotationReaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $container;
    protected $configuration;
    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->configuration = $this->prophesize(ContainerInterface::class);
    }

    public function testMinimalObjectFromFactory()
    {
        $this->configuration->has('annotations')->willReturn(false);
        $this->container->get(Configuration::class)->willReturn($this->configuration->reveal());

        $factory = new AnnotationReaderFactory();

        $this->assertInstanceOf(Reader::class, $factory->build($this->container->reveal()));
        $this->configuration->has('annotations')->shouldHaveBeenCalled();
        $this->container->get(Configuration::class)->shouldHaveBeenCalled();
    }

    public function testWithConfiguration()
    {
        /**
         * @var $cache Cache
         */
        $cache = $this->prophesize(Cache::class);
        $this->configuration->has('annotations')->willReturn(true);
        $this->configuration->get('annotations')->willReturn([
            'namespaces' => [
                'Onion\Framework\Annotations'
            ],
            'files' => [
                __DIR__ . '/../../../src/Framework/Annotations/Annotated.php'
            ],
            'cache' => Cache::class
        ]);
        $this->container->get(Cache::class)->willReturn($cache->reveal());
        $this->container->get(Configuration::class)
            ->willReturn($this->configuration->reveal());

        $factory = new AnnotationReaderFactory();

        $this->assertInstanceOf(Reader::class, $factory->build($this->container->reveal()));
        $this->configuration->get('annotations')->shouldHaveBeenCalled();
        $this->container->get(Configuration::class)->shouldHaveBeenCalled();
    }
}
