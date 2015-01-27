<?php
namespace zf2htmlpurifier\Filter;

use Zend\Filter\FilterInterface;
use HTMLPurifier;

final class HTMLPurifierFilter implements FilterInterface
{
	/** @var HTMLPurifier */
	private $htmlPurifier;

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
			$this->htmlPurifier = new HTMLPurifier();
		}
		
		return $this->htmlPurifier;
	}
}
