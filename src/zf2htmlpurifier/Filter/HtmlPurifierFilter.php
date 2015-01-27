<?php
namespace zf2htmlpurifier\Filter;

use Zend\Filter\FilterInterface;

final class HtmlPurifierFilter implements FilterInterface
{
    /**
     * Returns the result of filtering $value
     *
     * @param mixed $value
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {
        return $value;
    }
}
