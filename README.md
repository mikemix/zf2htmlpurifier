# zf2htmlpurifier
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mikemix/zf2htmlpurifier/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mikemix/zf2htmlpurifier/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/mikemix/zf2htmlpurifier/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mikemix/zf2htmlpurifier/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/mikemix/zf2htmlpurifier/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mikemix/zf2htmlpurifier/build-status/master)

HTML Purifier as ZF2 filter. Protect yourself from XSS attacks with two simple steps.

Install
-------

Install with [Composer](https://packagist.org/packages/mikemix/zf2htmlpurifier) ```"mikemix/zf2htmlpurifier": "~1.0"```

Use
---

Include in form field's filter chain ```zf2htmlpurifier\Filter\HTMLPurifierFilter```, for example:

```php
<?php
namespace MyApp\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class ExampleForm extends Form implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add([
            'name' => 'field',
        ]);
    }
    
    public function getInputFilterSpecification()
    {
        return array(
            // other elements
            'field' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'zf2htmlpurifier\Filter\HTMLPurifierFilter'),
                ),
            ),
        );
    }

    // or with modern php

    public function getInputFilterSpecification()
    {
        return [
            // other elements
            'field' => [
                'required' => true,
                'filters' => [
                    ['name' => zf2htmlpurifier\Filter\HTMLPurifierFilter::class],
                ],
            ],
        ];
    }
}

// in controller (ugly code example without Dependency Injection)

$fm = $this->getServiceLocator()->get('FormElementManager');

$form = $fm->get(MyApp\Form\ExampleForm::class);
$form->setData(['field' => '<a href="#" onlick="javascript:alert(xss)">link</a>']);
$form->isValid();

// outputs: <a href="#">link</a>
echo $form->getData('field');

```

Fine tuning HTMLPurifier
------------------------

You can pass options to configure the HTMLPurifier library.

```php

// the form

    public function getInputFilterSpecification()
    {
        return [
            // other elements
            'field' => [
                'required' => true,
                'filters' => [
                    ['name' => zf2htmlpurifier\Filter\HTMLPurifierFilter::class, 'options' => ['config' => [
                        'Cache.SerializerPath' => '/other/path',
                        'Some.Setting' => 'Setting value',
                    ]]],
                ],
            ],
        ];
    }

```

Standalone usage
----------------

It can be used as standalone class as well:

```php
$purifier = new \zf2htmlpurifier\Filter\HTMLPurifierFilter();

echo $purifier->filter('<a href="#" onlick="javascript:alert(xss)">link</a>');
```

TODO
----

   * Convert this to Module and allow defining default HTMLPurifier config via the configuration files
