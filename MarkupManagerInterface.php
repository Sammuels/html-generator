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
 * Interface to be implemented by markup managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to markup should happen through this interface.
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
interface MarkupManagerInterface
{
    /**
     * Creates an empty markup instance.
     *
     * @return MarkupInterface
     */
    public function createMarkup();

    /**
     * Deletes a markup.
     *
     * @param MarkupInterface $markup
     *
     * @return void
     */
    public function deleteMarkup(MarkupInterface $markup);

    /**
     * Finds one markup by the given criteria.
     *
     * @param array $criteria
     *
     * @return MarkupInterface
     */
    public function findMarkupBy(array $criteria);

    /**
     * Find a markup by its title.
     *
     * @param string $title
     *
     * @return MarkupInterface or null if markup does not exist
     */
    public function findMarkupByTitle($title);

    /**
     * Finds a markup by its slug.
     *
     * @param string $slug
     *
     * @return MarkupInterface or null if markup does not exist
     */
    public function findMarkupBySlug($reference);

    /**
     * Returns a collection with all markup instances.
     *
     * @return \Traversable
     */
    public function findMarkup();

    /**
     * Returns the markup's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Reloads a markup.
     *
     * @param MarkupInterface $markup
     *
     * @return void
     *
     * @throws UnsupportedMarkupException
     * @throws MarkupNotFoundException
     */
    public function reloadMarkup(MarkupInterface $markup);

    /**
     * Updates a markup.
     *
     * @param MarkupInterface $markup
     *
     * @return void
     */
    public function updateMarkup(MarkupInterface $markup);
}
