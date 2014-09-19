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
 * Base class to implement as a storage layer for markup code
 * generation.
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
interface MarkupInterface 
{   
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();
    
    /**
     * Set title
     *
     * @param string $title
     *
     * @return MarkupInterface
     */
    public function setTitle($title);
    
    /**
     * Get permalink/slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set the permalink.
     *
     * @param string $slug
     *
     * @return MarkupInterface
     */
    public function setSlug($slug);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();
    
    /**
     * Set content
     *
     * @param string $content
     *
     * @return MarkupInterface
     */
    public function setContent($content);

    /**
     * Get HTML
     *
     * @return string
     */
    public function getHtml();
    
    /**
     * Set html
     *
     * @param string $html
     *
     * @return MarkupInterface
     */
    public function setHtml($html);

    /**
     * Get generator name
     *
     * @return string
     */
    public function getGenerator();

    /**
     * Set generator name
     *
     * @param string $generator
     *
     * @return MarkupInterface
     */
    public function setGenerator($generator);

    /**
     * Get meta keywords.
     *
     * @return string
     */
    public function getMetaKeywords();

    /**
     * Set meta keywords for the news.
     *
     * @param string $metaKeywords
     *
     * @return MarkupInterface
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * Get meta description.
     *
     * @return string
     */
    public function getMetaDescription();

    /**
     * Set meta description for the news.
     *
     * @param string $metaDescription
     *
     * @return MarkupInterface
     */
    public function setMetaDescription($metaDescription);

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt();

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return MarkupInterface
     */
    public function setPublishedAt(\DateTime $publishedAt = null);

    /**
     * Check if the news is published or not
     *
     * @return boolean
     */
    public function isPublished();

    /**
     * Set the publication flag
     *
     * @param boolean isPublished
     *
     * @return MarkupInterface
     */
    public function setIsPublished($isPublished);
}
