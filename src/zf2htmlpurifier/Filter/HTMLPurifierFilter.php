<?php
namespace zf2htmlpurifier\Filter;

use Zend\Filter\AbstractFilter;
use Zend\Filter\Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use HTMLPurifier_ConfigSchema;

class HTMLPurifierFilter extends AbstractFilter
{
    /** @var HTMLPurifier */
    protected $htmlPurifier;

    /** @var array */
    protected $settings = [];

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
    protected function getHTMLPurifier()
    {
        if ($this->htmlPurifier) {
            return $this->htmlPurifier;
        }
        
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', sys_get_temp_dir());
        
        foreach ($this->settings as $key => $value) {
            $config->set($key, $value);
        }
        
        $this->htmlPurifier = new HTMLPurifier(new HTMLPurifier_ConfigSchema($config));
        
        return $this->htmlPurifier;
    }

    /**
     * @param array $settings
     */
    public function setSettings(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param HTMLPurifier $purifier
     */
    public function setHtmlPurifier(HTMLPurifier $purifier)
    {
        $this->htmlPurifier = $purifier;
    }
}
