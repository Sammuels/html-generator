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

/* Imports */
use UCS\Component\HtmlGenerator\Exception\UnsupportedMarkupException;
use UCS\Component\HtmlGenerator\Exception\MarkupNotFoundException;

/**
 * Abstract Markup Manager implementation which can be used as base class for your
 * concrete manager.
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
abstract class MarkupManager implements MarkupManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function createMarkup()
    {
        $class = $this->getClass();
        $markup = new $class;

        return $markup;
    }

    /**
     * {@inheritdoc}
     */
    public function findMarkupByTitle($title)
    {
        return $this->findMarkupBy(array('title' => $title));
    }

    /**
     * {@inheritdoc}
     */
    public function findMarkupBySlug($slug)
    {
        return $this->findMarkupBy(array('slug' => $slug));
    }

    /**
     * {@inheritdoc}
     */
    public function reloadMarkup(MarkupInterface $markup) {
        $class = $this->getClass();
        
        if (!$markup instanceof $class) {
            throw new UnsupportedMarkupException('Markup class is not supported.');
        }
        
        if (!$markup instanceof Markup) {
            throw new UnsupportedMarkupException(sprintf('Expected an instance of UCS\Component\Markup\Markup, but got "%s".', get_class($markup)));
        }

        $reloadedMarkup = $this->findMarkupBy(array('slug' => $markup->getSlug()));
        
        if (null === $reloadedMarkup) {
            throw new MarkupNotFoundException(sprintf('Markup with Slug "%d" could not be reloaded.', $markup->getSlug()));
        }

        return $reloadedMarkup;
    }
}
