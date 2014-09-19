<?php

/*
 * This file is part of the UCS package.
 *
 * Copyright 2014 Nicolas Macherey (nicolas.macherey@gmail.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\HtmlGenerator\Generator;

/* imports */
use UCS\Component\HtmlGenerator\GeneratorInterface;
use UCS\Component\HtmlGenerator\MarkupInterface;
use HTMLPurifier;

/**
 * Main interface used to define a generator. The generator is the base class 
 * you have to implement in order to generate HTML code from a text given in 
 * input.
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class HtmlToHtmlGenerator implements GeneratorInterface 
{
    /** Purify html */
    private $purifier;

    /**
     * Constructor
     *
     * @param config the configuration to give to the purifier
     */
    public function __construct($config = null) {
        $this->purifier = new HTMLPurifier($config);
    }

    /**
     * {@inheritDoc}
     */
    public function getName() {
        return 'HTML_2_HTML';
    }

    /**
     * {@inheritDoc}
     */
    public function getLabel() {
        return 'HTML Purifier';
    }

    /**
     * {@inheritDoc}
     *
     * TODO: Check if we can purify the html... no script tags and so on...
     */
    public function generate($markup, $options = array()) {
        if( $markup instanceof MarkupInterface ) {
            $content = $markup->getContent();
        } else {
            $content = $markup;
        }

        $config = null;

        if( $options && count($otpions) > 0 )
            $config = $options;

        return $this->purifier->purify($content, $config);
    }
}
