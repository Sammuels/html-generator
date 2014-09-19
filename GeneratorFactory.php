<?php

/*
 * This file is part of the UCS package.
 *
 * Copyright 2014 Nicolas Macherey (nicolas.macherey@gmail.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\HtmlGenerator;

/* imports */
use UCS\Component\HtmlGenerator\Exception\NoGeneratorFoundException;

/**
 * The generator factory is the base class to be implemented to be able to
 * generate HTML code from a MarkupInterface without having to instanciate the
 * generator.
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class GeneratorFactory implements GeneratorFactoryInterface
{
    /**
     * @var GeneratorInterface[]
     */
    private $generators = array();

    /**
     * Clone method override
     */
    public function __clone()
    {
        foreach ($this->generators as $name => $generator) {
            $this->generators[$name] = clone $generator;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->generators);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->generators);
    }

    /**
     * {@inheritdoc}
     */
    public function add($name, GeneratorInterface $generator)
    {
        unset($this->generators[$name]);

        $this->generators[$name] = $generator;
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->generators;
    }

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        return isset($this->generators[$name]) ? $this->generators[$name] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return isset($this->generators[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($name)
    {
        foreach ((array) $name as $n) {
            unset($this->generators[$n]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addCollection(array $collection)
    {
        // we need to remove all generators with the same names first because just replacing them
        // would not place the new generator at the end of the merged array
        foreach ($collection as $name => $generator) {
            unset($this->generators[$name]);
            $this->generators[$name] = $generator;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function generate($name, $markup, $options = array()) {

        if( !isset($this->generators[$name])) {
            throw new NoGeneratorFoundException("The generator $name for the given markup was not found...");
        }

        $generator = $this->generators[$name];
        return $generator->generate($markup, $options);
    }
}
