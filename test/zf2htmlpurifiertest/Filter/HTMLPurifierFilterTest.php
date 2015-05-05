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
    
    /** @var HTMLPurifier */
    private $purifier;
    
    public function setUp()
    {
        $this->filter = new HTMLPurifierFilter();
    }
    
    public function testFilter()
    {
        $purifier = $this->getMockBuilder(HTMLPurifier::class)
            ->setMethods(['purify'])
            ->getMock();
            
        $purifier->expects($this->once())
            ->method('purify')
            ->with($this->equalTo('input'))
            ->will($this->returnValue('output'));
            
        $this->filter->setHtmlPurifier($purifier);
        $this->filter->filter('input');
    }
    
    public function testFilterWithoutConfigSchema()
    {
        $this->assertEquals('', $this->filter->filter(''));
    }
    
    public function testFilterWithConfigSchema()
    {
        $schema = $this->getMockBuilder(HTMLPurifier_ConfigSchema::class)
            #->setMethods(['purify'])
            ->getMock();
            
        $this->filter->setConfigSchema($schema);
        $this->filter->filter('input');
    }
}
