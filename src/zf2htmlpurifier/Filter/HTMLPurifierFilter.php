<?php
namespace zf2htmlpurifier\Filter;

use Zend\Filter\AbstractFilter;
use Zend\Filter\Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use HTMLPurifier_ConfigSchema;

final class HTMLPurifierFilter extends AbstractFilter
{
    /** @var HTMLPurifier */
    private $htmlPurifier;

    /** @var HTMLPurifier_ConfigSchema */
    private $configSchema;

    /**
     * Returns the result of filtering $value
     *
     * @param mixed $value
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {
        $purifier = $this->getHTMLPurifier();
        return $purifier->purify($value);
    }

    /**
     * @return HTMLPurifier
     */
    private function getHTMLPurifier()
    {
        if (! $this->htmlPurifier) {
            if ($this->configSchema) {
                $config = new HTMLPurifier_Config($this->configSchema);
            } else {
                $config = null;
            }

            $this->htmlPurifier = new HTMLPurifier($config);
        }

        return $this->htmlPurifier;
    }

    /**
     * @param HTMLPurifier_ConfigSchema $schema
     */
    public function setConfigSchema($schema)
    {
        $this->configSchema = $schema;
    }

    /**
     * @param HTMLPurifier $purifier
     */
    public function setHtmlPurifier($purifier)
    {
        $this->htmlPurifier = $purifier;
    }
}
