HTML Generator Component
========================

With the HTML Generator component its possible to use various compiler to generate HTML code from 
a predefined input and set of parameters.

Resources
---------

You can run the unit tests with the following command:

.. code-block:: bash

    $ cd path/to/UCS/Component/HtmlGenerator/
    $ composer.phar install
    $ phpunit

Basic Usage
-----------

.. code-block:: php

    <?php
    // Create the markup object before generation
    $markup = new Markup();
    $markup->setContent('My brand new HTML from RST');

    // Use directly the generator
    $generator = new Rst2HtmlGenerator();
    $html = $generator->generate($markup);

    // Build the factory
    $factory = new GeneratorFactory();
    $factory->add('rst2html', $generator);

    $html = $factory->generate('rst2html', $markup);
    ?>

Available Generators
--------------------

HtmlToHtmlGenerator
+++++++++++++++++++

The HtmlToHtml generator doe mostly... nothing it returns the content, it is only avaialble
as a default behaviour.

Rst2HtmlGenerator
+++++++++++++++++

Rst2HtmlGenerator uses the python rst2html tool to generate proper HTML from a full restructured
text. Please check its documentation for further informations.