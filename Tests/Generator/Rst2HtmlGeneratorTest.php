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
use UCS\Component\HtmlGenerator\Generator\Rst2HtmlGenerator;

/**
 * Unit Test Suite for Rst2HtmlGenerator
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class Rst2HtmlGeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected $instance;
    
    protected function setup() {
        $this->instance = new Rst2HtmlGenerator(
            __DIR__ . '/../../Templates/default.txt'
        );
    }

    public function testName() {
        $this->assertEquals('RST_2_HTML', $this->instance->getName());
    }

    public function testLabel() {
        $this->assertEquals('Restructured Text', $this->instance->getLabel());
    }

    public function testGenerate() {
        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');
        $markup->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue('HTML'));

        $html = $this->instance->generate($markup);
        $this->assertEquals("\n\n<p>HTML</p>", $html);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGenerateException() {
        $instance = new Rst2HtmlGenerator(
            __DIR__ . '/../../Templates/default.txt papapapapappa'
        );

        $markup = $this->getMock('UCS\Component\HtmlGenerator\MarkupInterface');
        $markup->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue('HTML'));

        $html = $instance->generate($markup);
    }
}