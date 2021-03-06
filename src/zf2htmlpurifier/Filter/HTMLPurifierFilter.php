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
    protected $config = array();

    /**
     * Returns the result of filtering $value
     *
     * @param string $value
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @return string
     */
    public function filter($value)
    {
        return $this->getHtmlPurifier()->purify($value);
    }

    /**
     * @return HTMLPurifier
     */
    public function getHtmlPurifier()
    {
        if (!$this->htmlPurifier) {
            if (!isset($this->config['Cache.SerializerPath'])) {
                $this->config['Cache.SerializerPath'] = sys_get_temp_dir();
            }

            $this->htmlPurifier = new HTMLPurifier($this->config);
        }

        return $this->htmlPurifier;
    }

    /**
     * @param HTMLPurifier $purifier
     */
    public function setHtmlPurifier(HTMLPurifier $purifier)
    {
        $this->htmlPurifier = $purifier;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}
