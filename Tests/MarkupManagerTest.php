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
use UCS\Component\HtmlGenerator\MarkupManager;

/**
 * Unit Test Suite for MarkupManager
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class MarkupManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $instance;
    
    protected function setup() {
        $this->instance = $this
            ->getMockForAbstractClass('UCS\Component\HtmlGenerator\MarkupManager');
    }
    
    public function testCreateMarkup() {
        $this->instance->expects($this->once())
          ->method('getClass')
          ->will($this->returnValue('UCS\Component\HtmlGenerator\Markup'));
          
        $markup = $this->instance->createMarkup();
        $this->assertTrue($markup instanceof \UCS\Component\HtmlGenerator\Markup,
          '->createMarkup() must create a valid markup instance');
    }
    
    public function testFindMarkupByTitle() {
        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');
        $this->instance->expects($this->once())
          ->method('findMarkupBy')
          ->with($this->equalTo(array('title'=>'markup')))
          ->will($this->returnValue($markup));
          
        $this->assertEquals($markup, $this->instance->findMarkupByTitle('markup'), 
          '->findMarkupByTitle() must return a markup or null');
    }
    
    public function testFindMarkupBySlug() {
        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');
        $this->instance->expects($this->once())
          ->method('findMarkupBy')
          ->with($this->equalTo(array('slug'=>'markup')))
          ->will($this->returnValue($markup));
          
        $this->assertEquals($markup, $this->instance->findMarkupBySlug('markup'), 
          '->findMarkupBySlug() must return a markup or null');
    }
    
    /**
     * @expectedException UCS\Component\HtmlGenerator\Exception\UnsupportedMarkupException
     */
    public function testRefreshWrongClass() {
        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');
        $this->instance->expects($this->once())
          ->method('getClass')
          ->will($this->returnValue('UCS\Component\HtmlGenerator\Markup'));
        
        // Wrong expected markup got Mock
        $this->instance->reloadMarkup($markup);
    }
    
    /**
     * @expectedException UCS\Component\HtmlGenerator\Exception\UnsupportedMarkupException
     */
    public function testRefreshWrongInherit() {
        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');
        $this->instance->expects($this->once())
          ->method('getClass')
          ->will($this->returnValue('UCS\Component\HtmlGenerator\MarkupInterface'));
        
        // Wrong expected Markup got Mock
        $this->instance->reloadMarkup($markup);
    }
    
    /**
     * @expectedException UCS\Component\HtmlGenerator\Exception\MarkupNotFoundException
     */
    public function testRefreshMarkupNotFound() {
        $markup = $this->getMock('UCS\Component\HtmlGenerator\Markup');
        $markup->expects($this->exactly(2))
          ->method('getSlug')
          ->will($this->returnValue('markup'));
        
        $this->instance->expects($this->once())
          ->method('getClass')
          ->will($this->returnValue('UCS\Component\HtmlGenerator\Markup'));
        
        $this->instance->expects($this->once())
          ->method('findMarkupBy')
          ->with($this->equalTo(array('slug'=>'markup')));
          
        // Wrong expected Markup got Mock
        $this->instance->reloadMarkup($markup);
    }
    
    public function testRefreshComplete() {
        $markup = $this->getMock('UCS\Component\HtmlGenerator\Markup');
        $markup->expects($this->once())
          ->method('getSlug')
          ->will($this->returnValue('markup'));
        
        $this->instance->expects($this->once())
          ->method('getClass')
          ->will($this->returnValue('UCS\Component\HtmlGenerator\Markup'));
        
        $this->instance->expects($this->once())
          ->method('findMarkupBy')
          ->with($this->equalTo(array('slug'=>'markup')))
          ->will($this->returnValue($markup));
          
        // Wrong expected Markup got Mock
        $this->assertEquals($markup, $this->instance->reloadMarkup($markup),
          '->reloadMarkup() the markup reference must be returned');
    }
}
