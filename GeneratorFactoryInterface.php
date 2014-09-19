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
interface GeneratorFactoryInterface extends \IteratorAggregate, \Countable
{
    /**
     * Adds a generator.
     *
     * @param string $name  The generator name
     * @param GeneratorInterface  $generator A GeneratorInterface instance
     *
     * @api
     */
    public function add($name, GeneratorInterface $generator);

    /**
     * Returns all generators in this collection.
     *
     * @return GeneratorInterface[] An array of actions
     */
    public function all();

    /**
     * Gets a generator by name.
     *
     * @param string $name The generator name
     *
     * @return GeneratorInterface|null A GeneratorInterface instance or null when not found
     */
    public function get($name);

    /**
     * Check if the Collection contains the given generator
     *
     * @param string $name The generator name
     *
     * @return boolean
     */
    public function has($name);

    /**
     * Removes a generator or an array of actions by name from the collection
     *
     * @param string|array $name The generator name or an array of generator names
     */
    public function remove($name);

    /**
     * Generate code
     *
     * @param string $genertor generator to use
     * @param MarkupInterface $markup the content to generate HTML for
     * @param array $params optional parameters that can be given to the generator
     *
     * @return string the HTML code generated
     *
     * @throws NoGeneratorFoundException if no generator was found for the 
     * given markup
     */
    public function generate($generator, MarkupInterface $markup, $options = array());
}
