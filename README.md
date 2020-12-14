DDD Generator Bundle
=====================
Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
 composer require 201created/ddd-generator-bundle --dev
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
  composer require 201created/ddd-generator-bundle --dev
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    C201\DddGeneratorBundle\C201DddGeneratorBundle::class => ['dev' => true],
];
```

Creating your own Generator/Maker
----------------------------------------

When you want to create your own Generator based on the DddMaker
you'll need to extend either of the abstract Maker classes.  

Be sure not to extend a non-abstract class unless you can ensure that 
their implementation will never change.  

If you can't ensure that it would be a better idea to use oe of the following:
 - DddMaker: The most general abstraction. In only provides functionality
    without having a base implementation.

 - DddEntityMaker: This is the easiest to use for implementing a generator based
    on some input options. In fact most generator of this bundle use the DddEntityMaker.

 - DddEntityTestMaker: A specialized DddEntityMaker for generating Test files.
 
 - DddEntityCommandMaker: A specialized DddEntityMaker for generating Command and CommandHandler classes.

All you need to do to generate your own Generator is to create a class,
that extends a Maker in `src/Maker` and to create a template file.  

The template file may be placed in `res/skeleton/ddd` or 
`src/Resources/skeleton/ddd` and use the file extension `.tpl.php`. 
If you cannot place the templates there you can also override the Makers `getTemplatePath()`.  

The template files itself are plain text files that get php variables injected using  
`<?= $variableName; ?>`.

Lastly you need to register your Maker as a Maker in your service configuration file.  
This is done by providing the `maker.command` tag to the service.

A word about i18n
----------------------------------------
If you want to use the localization feature you should provide it using the 
`getExtraVariables()` method and use as `$extra`  in the template.  

Alternatively you can override the `internationalize()` method, but you'll need to 
provide any key the bundle defines internally to continue to use the pre-defined features.
Because these keys can change between every patch version it could be very hard for you 
to ensure that no functionality breaks.
