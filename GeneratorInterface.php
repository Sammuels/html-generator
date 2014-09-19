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

/**
 * Main interface used to define a generator. The generator is the base class 
 * you have to implement in order to generate HTML code from a text given in 
 * input.
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
interface GeneratorInterface 
{
    /**
     * Get Name
     *
     * @return string
     */
    public function getName();

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel();

    /**
     * Generate code
     *
     * @param MarkupInterface|string $markup the content to generate HTML for
     * @param array $params optional parameters that can be given to the generator
     *
     * @return string the HTML code generated
     */
    public function generate($markup, $options = array());
}
