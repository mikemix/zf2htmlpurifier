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
     * @param string $value
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @return string
     */
    public function filter($value)
    {
        return $this->getHTMLPurifier()->purify($value);
    }

    /**
     * @return HTMLPurifier
     */
    private function getHTMLPurifier()
    {
        if ($this->htmlPurifier) {
            return $this->htmlPurifier;
        }
        
        if (! $this->configSchema) {
            $config = HTMLPurifier_Config::createDefault();
            $config->set('Cache.SerializerPath', sys_get_temp_dir());
            
            $this->configSchema = new HTMLPurifier_ConfigSchema($config);
        }

        $this->htmlPurifier = new HTMLPurifier($this->configSchema);
        return $this->htmlPurifier;
    }

    /**
     * @param HTMLPurifier_ConfigSchema $schema
     */
    public function setConfigSchema(HTMLPurifier_ConfigSchema $schema)
    {
        $this->configSchema = $schema;
    }

    /**
     * @param HTMLPurifier $purifier
     */
    public function setHtmlPurifier(HTMLPurifier $purifier)
    {
        $this->htmlPurifier = $purifier;
    }
}
