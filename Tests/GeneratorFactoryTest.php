<?php

/*
 * This file is part of the UCS package.
 *
 * Copyright 2014 Nicolas Macherey (nicolas.macherey@gmail.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\HtmlGenerator\Tests;

/* Imports */
use UCS\Component\HtmlGenerator\GeneratorFactory;

/**
 * Unit Test Suite for GeneratorFactory
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class GeneratorFactoryTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGenerator()
    {        
        $factory = new GeneratorFactory();
        $generator = $this->getGeneratorMock('foo');
        $factory->add('foo', $generator);
        $this->assertEquals(array('foo' => $generator), $factory->all(), '->add() adds an generator');
        $this->assertEquals($generator, $factory->get('foo'), '->get() returns an generator by name');
        $this->assertTrue($factory->has('foo'), '->has() returns true if the generator exists');
        $this->assertNull($factory->get('bar'), '->get() returns null if an generator does not exist');
        $this->assertFalse($factory->has('bar'), '->has() returns false if the generator does not exists');
    }

    public function testOverriddengenerator()
    {
        $factory = new GeneratorFactory();
        $factory->add('foo', $generator1 = $this->getGeneratorMock('foo'));
        $factory->add('foo', $generator2 = $this->getGeneratorMock('foo1'));

        $this->assertEquals($generator2, $factory->get('foo'));
    }

    public function testDeepOverriddengenerator()
    {
        $factory = new GeneratorFactory();
        $factory->add('foo' , $generator1 = $this->getGeneratorMock('foo'));

        $factory1 = new GeneratorFactory();
        $factory1->add('foo',$generator2 = $this->getGeneratorMock('foo1'));

        $factory2 = array('foo' => $generator3 = $this->getGeneratorMock('foo2'));

        $factory1->addCollection($factory2);
        $factory->addCollection($factory1->all());

        $this->assertEquals($generator3, $factory1->get('foo'));
        $this->assertEquals($generator3, $factory->get('foo'));
    }

    public function testIterator()
    {
        $factory = new GeneratorFactory();
        $factory->add('foo', $this->getGeneratorMock('foo'));

        $factory1 = array(
            'bar' => $bar = $this->getGeneratorMock('bar'),
            'foo' => $foo = $this->getGeneratorMock('foo-new'),
        );

        $factory->addCollection($factory1);
        $factory->add('last', $last = $this->getGeneratorMock('last'));

        $this->assertInstanceOf('\ArrayIterator', $factory->getIterator());
        $this->assertSame(array('bar' => $bar, 'foo' => $foo, 'last' => $last), $factory->getIterator()->getArrayCopy());
    }

    public function testCount()
    {
        $factory = new GeneratorFactory();
        $factory->add('foo', $this->getGeneratorMock('foo'));
        $factory1 = array('bar' => $this->getGeneratorMock('bar'));
        $factory->addCollection($factory1);

        $this->assertCount(2, $factory);
    }

    public function testAddCollection()
    {
        $factory = new GeneratorFactory();
        $factory->add('foo', $this->getGeneratorMock('foo'));

        $factory1 = new GeneratorFactory();
        $factory1->add('bar', $bar = $this->getGeneratorMock('bar'));
        $factory1->add('foo', $foo = $this->getGeneratorMock('foo-new'));

        $factory2 = new GeneratorFactory();
        $factory2->add('grandchild', $grandchild = $this->getGeneratorMock('grandchild'));

        $factory1->addCollection($factory2->all());
        $factory->addCollection($factory1->all());
        $factory->add('last', $last = $this->getGeneratorMock('last'));

        $this->assertSame(array('bar' => $bar, 'foo' => $foo, 'grandchild' => $grandchild, 'last' => $last), $factory->all(),
            '->addCollection() imports generators of another factory, overrides if necessary and adds them at the end');
    }

    public function testUniquegeneratorWithGivenName()
    {
        $factory1 = new GeneratorFactory();
        $factory1->add('foo', $this->getGeneratorMock('old'));
        $factory2 = new GeneratorFactory();
        $factory3 = new GeneratorFactory();
        $factory3->add('foo', $new = $this->getGeneratorMock('new'));

        $factory2->addCollection($factory3->all());
        $factory1->addCollection($factory2->all());

        $this->assertSame($new, $factory1->get('foo'), '->get() returns new generator that overrode previous one');
        // size of 1 because factory1 contains /new but not /old anymore
        $this->assertCount(1, $factory1->getIterator(), '->addCollection() removes previous generators when adding new generators with the same name');
    }

    public function testGet()
    {
        $factory1 = new GeneratorFactory();
        $factory1->add('a', $a = $this->getGeneratorMock('a'));
        $factory2 = new GeneratorFactory();
        $factory2->add('b', $b = $this->getGeneratorMock('b'));
        $factory1->addCollection($factory2->all());
        $factory1->add('$péß^a|', $c = $this->getGeneratorMock('special'));

        $this->assertSame($b, $factory1->get('b'), '->get() returns correct generator in child factory');
        $this->assertSame($c, $factory1->get('$péß^a|'), '->get() can handle special characters');
        $this->assertNull($factory2->get('a'), '->get() does not return the generator defined in parent factory');
        $this->assertNull($factory1->get('non-existent'), '->get() returns null when generator does not exist');
        $this->assertNull($factory1->get(0), '->get() does not disclose internal child GeneratorFactory');
    }

    public function testRemove()
    {
        $factory = new GeneratorFactory();
        $factory->add('foo', $foo = $this->getGeneratorMock('foo'));

        $factory1 = new GeneratorFactory();
        $factory1->add('bar', $bar = $this->getGeneratorMock('bar'));
        $factory->addCollection($factory1->all());
        $factory->add('last', $last = $this->getGeneratorMock('last'));

        $factory->remove('foo');
        $this->assertSame(array('bar' => $bar, 'last' => $last), $factory->all(), '->remove() can remove a single generator');
        $factory->remove(array('bar', 'last'));
        $this->assertSame(array(), $factory->all(), '->remove() accepts an array and can remove multiple generators at once');
    }

    public function testClone()
    {
        $factory = new GeneratorFactory();
        $factory->add('a', $this->getGeneratorMock('a'));
        $factory->add('b', $this->getGeneratorMock('b', array('placeholder' => 'default'), array('placeholder' => '.+')));

        $clonedFactory = clone $factory;

        $this->assertCount(2, $clonedFactory);
        $this->assertEquals($factory->get('a'), $clonedFactory->get('a'));
        $this->assertNotSame($factory->get('a'), $clonedFactory->get('a'));
        $this->assertEquals($factory->get('b'), $clonedFactory->get('b'));
        $this->assertNotSame($factory->get('b'), $clonedFactory->get('b'));
    }

    public function testGenerateWithGeneratorFound() {
        $factory = new GeneratorFactory();
        $factory->add('foo', $generator = $this->getGeneratorMock('foo'));

        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');
        $generator->expects($this->once())
            ->method('generate')
            ->with($this->equalTo($markup));

        $factory->generate('foo', $markup);
    }

    /**
     * @expectedException \UCS\Component\HtmlGenerator\Exception\NoGeneratorFoundException
     */
    public function testGenerateWithGeneratorNotFound() {
        $factory = new GeneratorFactory();
        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');

        $factory->generate('foo', $markup);
    }

    private function getGeneratorMock($name) {
        $generator = $this->
          getMock('UCS\Component\HtmlGenerator\GeneratorInterface');
                      
        return $generator;
    }
}
