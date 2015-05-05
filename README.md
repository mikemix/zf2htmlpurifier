# zf2htmlpurifier
HTML Purifier as ZF2 filter. Protect yourself from XSS attacks with two simple steps.

Install
-------

Install with composer ```"mikemix/zf2htmlpurifier": "~0.5"```

Use
---

Include in form field's filter chain ```zf2htmlpurifier\Filter\HTMLPurifierFilter```, for example:

```php
<?php
namespace MyApp\Form;

use Zend\Form\Form;

class ExampleForm extends Form
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
}

// in controller (ugly code example without Dependency Injection)

$fm = $this->getServiceLocator()->get('FormManager');
$form = $fm->get(MyApp\Form\ExampleForm::class);

$form->setData(['field' => '<a href="#" onlick="javascript:alert(xss)">link</a>']);
$form->isValid();

// outputs: <a href="#">link</a>
echo $form->getData('field');

```
