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
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use UCS\Component\HtmlGenerator\GeneratorInterface;
use UCS\Component\HtmlGenerator\MarkupInterface;

/**
 * Main interface used to define a generator. The generator is the base class 
 * you have to implement in order to generate HTML code from a text given in 
 * input.
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class Rst2HtmlGenerator implements GeneratorInterface 
{

    /**
     * @var string
     */
    protected $templatePath;

    /**
     * @var string
     */
    protected $tempDirectory;

    /**
     * @var string
     */
    protected $syntaxHighlight;

    /**
     * @var boolean
     */
    protected $noSourceLinks;

    /**
     * @var boolean
     */
    protected $quiet;

    /**
     * @var boolean
     */
    protected $noDebug;

    /**
     * Construct
     *
     * @param string $templatePath template path for generation
     * @param string $tempDirectory temp directory if you want to customize
     */
    public function __construct(
        $templatePath,
        $tempDirectory = '/tmp',
        $syntaxHighlight = 'short',
        $noSourceLinks = true,
        $stripComments = true,
        $quiet = true,
        $noDebug = true
        ) {
        $this->templatePath = $templatePath;
        $this->tempDirectory = $tempDirectory;
        $this->syntaxHighlight = $syntaxHighlight;
        $this->noSourceLinks = $noSourceLinks;
        $this->quiet = $quiet;
        $this->noDebug = $noDebug;
    }

    /**
     * {@inheritDoc}
     */
    public function getName() {
        return 'RST_2_HTML';
    }

    /**
     * {@inheritDoc}
     */
    public function getLabel() {
        return 'Restructured Text';
    }

    /**
     * {@inheritDoc}
     * @throws \RuntimeException
     *
     * TODO: Do a better implementation look at sphinx...
     */
    public function generate($markup, $options = array()) {
        // 1 - write the content to the temp file
        $tempPath = $this->tempDirectory . '/' . uniqid();
        $tempPathOut = $tempPath . '-output';

        if( $markup instanceof MarkupInterface ) {
            $content = $markup->getContent();
        } else {
            $content = $markup;
        }

        // Store the content to the proper file
        file_put_contents($tempPath, $content);

        // Start building the command line
        $arguments = array('rst2html');

        if( $this->templatePath !== null ) {
            $arguments []= '--template=' . $this->templatePath;
        }

        if( $this->syntaxHighlight !== null ) {
            $arguments []= '--syntax-highlight=' . $this->syntaxHighlight;
        }

        if( $this->noSourceLinks != false ) {
            $arguments []= '--no-source-link';
        }

        if( $this->quiet != false ) {
            $arguments []= '--quiet';
        }

        if( $this->noDebug != false ) {
            $arguments []= '--no-debug';
        }

        $arguments []= $tempPath;
        $arguments []= $tempPathOut;

        // Get the builder
        $builder = new ProcessBuilder($arguments);

        // Build the process
        $process = $builder->getProcess();
        $process->setTimeout(3600);

        // Execute
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return file_get_contents($tempPathOut);
    }
}
