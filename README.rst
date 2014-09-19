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