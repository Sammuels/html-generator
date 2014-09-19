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
 * Default markup implementation
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class Markup implements MarkupInterface 
{
    /**
     * @var mixed
     */
    protected $id;
    
    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var string
     */
    protected $content;
    
    /**
     * @var string
     */
    protected $html;
    
    /**
     * @var string
     */
    protected $slug;
    
    /**
     * @var string
     */
    protected $metaDescription;
    
    /**
     * @var string
     */
    protected $metaKeywords;
    
    /**
     * @var \DateTime
     */
    protected $publishedAt;
    
    /**
     * @var boolean
     */
    protected $isPublished;
    
    /**
     * @var string
     */
    protected $generator;
    
    /**
     * Get the markup id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setContent($content)
    {
        $this->content = $content;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getHtml()
    {
        return $this->html;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setHtml($html)
    {
        $this->html = $html;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setPublishedAt(\DateTime $publishedAt = null)
    {
        $this->publishedAt = $publishedAt;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isPublished()
    {
        return $this->isPublished;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getGenerator()
    {
        return $this->generator;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;
        
        return $this;
    }
}
