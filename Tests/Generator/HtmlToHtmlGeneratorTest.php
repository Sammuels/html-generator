<?php

/*
 * This file is part of the UCS package.
 *
 * (c) Nicolas Macherey <nicolas.macherey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\HtmlGenerator\Tests\Generator;

/* imports */
use UCS\Component\HtmlGenerator\Generator\HtmlToHtmlGenerator;

/**
 * Unit Test Suite for HtmlToHtmlGenerator
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class HtmlToHtmlGeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected $instance;
    
    protected function setup() {
        $this->instance = new HtmlToHtmlGenerator();
    }

    public function testName() {
        $this->assertEquals('HTML_2_HTML', $this->instance->getName());
    }

    public function testLabel() {
        $this->assertEquals('HTML Purifier', $this->instance->getLabel());
    }

    public function testGenerate() {
        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');
        $markup->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue('HTML'));

        $html = $this->instance->generate($markup);
        $this->assertEquals('HTML', $html);
    }
}