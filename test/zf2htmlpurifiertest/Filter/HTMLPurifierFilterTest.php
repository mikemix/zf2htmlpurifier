<?php
namespace zf2htmlpurifiertest\Filter;

use HTMLPurifier;
use PHPUnit_Framework_TestCase as TestCase;
use zf2htmlpurifier\Filter\HTMLPurifierFilter;
use HTMLPurifier_ConfigSchema;

class HTMLPurifierFilterTest extends TestCase
{
    /** @var HTMLPurifierFilter */
    private $filter;

    public function setUp()
    {
        $this->filter = new HTMLPurifierFilter();
    }
    
    public function testFilter()
    {
        $purifier = $this->getMock('HTMLPurifier', array('purify'));
        $purifier->expects($this->once())
            ->method('purify')
            ->with($this->equalTo('input'))
            ->will($this->returnValue('output'));

        $this->filter->setHtmlPurifier($purifier);

        $this->assertEquals('output', $this->filter->filter('input'));
    }

    public function testCacheSerializerPathSetWhenNotProvidedWithConfig()
    {
        $purifier = $this->filter->getHtmlPurifier();

        $this->assertEquals(sys_get_temp_dir(), $purifier->config->get('Cache.SerializerPath'));
    }

    public function testSetConfig()
    {
        $this->filter->setConfig(array(
            'Cache.SerializerPath' => '/dev/null',
        ));

        $purifier = $this->filter->getHtmlPurifier();

        $this->assertEquals('/dev/null', $purifier->config->get('Cache.SerializerPath'));
    }
}
