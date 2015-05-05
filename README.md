# zf2htmlpurifier
HTML Purifier as ZF2 filter. Protect yourself from XSS attacks with two simple steps.

Install
-------

Install with composer ```"mikemix/zf2htmlpurifier": "~0.*"```

Use
---

Include in form field's filter chain ```zf2htmlpurifier\Filter\HTMLPurifierFilter```, for example:

```php
// SomeFormClass.php

    public function getInputFilterSpecification()
    {
      return array(
          // other elements
          'someField' => array(
              'filters' => array(
                  array('name' => 'zf2htmlpurifier\Filter\HTMLPurifierFilter'),
              ),
          ),
      );
    }
```
