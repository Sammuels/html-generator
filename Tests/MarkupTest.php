<?php

/*
 * This file is part of the UCS package.
 *
 * (c) Nicolas Macherey <nicolas.macherey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\HtmlGenerator\Tests;

/* imports */
use UCS\Component\HtmlGenerator\Markup;

/**
 * Unit Test Suite for Markup
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class MarkupTest extends \PHPUnit_Framework_TestCase
{
    protected $instance;
    
    protected function setup() {
        $this->instance = new Markup();
    }
    
    public function testId() {
        $this->assertNull($this->instance->getId());
    }
    
    public function testTitle() {
        $this->assertNull($this->instance->getTitle());

        $value = 'title';
        $this->instance->setTitle($value);
        $this->assertEquals($value, $this->instance->getTitle());
    }
    
    public function testSlug() {
        $this->assertNull($this->instance->getSlug());

        $value = 'slug-product';
        $this->instance->setSlug($value);
        $this->assertEquals($value, $this->instance->getSlug());
    }
    
    public function testContent() {
        $this->assertNull($this->instance->getContent());

        $value = 'content';
        $this->instance->setContent($value);
        $this->assertEquals($value, $this->instance->getContent());
    }
    
    public function testHtml() {
        $this->assertNull($this->instance->getHtml());

        $value = 'html';
        $this->instance->setHtml($value);
        $this->assertEquals($value, $this->instance->getHtml());
    }
    
    public function testMetaKeywords() {
        $this->assertNull($this->instance->getMetaKeywords());

        $value = 'meta1, metta2, meta3';
        $this->instance->setMetaKeywords($value);
        $this->assertEquals($value, $this->instance->getMetaKeywords());
    }
    
    public function testMetaDescription() {
        $this->assertNull($this->instance->getMetaDescription());

        $value = 'meta description could be very long';
        $this->instance->setMetaDescription($value);
        $this->assertEquals($value, $this->instance->getMetaDescription());
    }
    
    public function testPublishedAt() {
        $this->assertNull($this->instance->getPublishedAt());

        $value = new \DateTime();
        $this->instance->setPublishedAt($value);
        $this->assertEquals($value, $this->instance->getPublishedAt());
    }
    
    public function testIsPublished() {
        $this->assertNull($this->instance->isPublished());

        $value = false;
        $this->instance->setIsPublished($value);
        $this->assertEquals($value, $this->instance->isPublished());
        $this->assertEquals($value, $this->instance->getIsPublished());
    }
    
    public function testGenerator() {
        $this->assertNull($this->instance->getGenerator());

        $value = 'generator';
        $this->instance->setGenerator($value);
        $this->assertEquals($value, $this->instance->getGenerator());
    }
}
