<?php

namespace KkuetNet\SharindataBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ToolUnicodeTest extends WebTestCase {
    
    /**
     * 
     * @var EntityManager
     */
    private $em;
    private $container;

    public function setUp() {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->container    = $kernel->getContainer();
        $this->em           = $this->container->get('doctrine')->getManager();
    }
    
    public function testUtf8ToHtml(){
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHtml("français")=="fran&#x00e7;ais");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHtml("العربية")=="&#x0627;&#x0644;&#x0639;&#x0631;&#x0628;&#x064a;&#x0629;");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHtml("日本人")=="&#x65e5;&#x672c;&#x4eba;");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHtml("语言列表")=="&#x8bed;&#x8a00;&#x5217;&#x8868;");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHtml('français " efzef ')=="fran&#x00e7;ais &#x0022; efzef ");
    }
    
    public function testUnicodetoUtf8(){
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->UnicodetoUtf8("fran\u00e7ais")=="français");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->UnicodetoUtf8("\u00e7")=="ç");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->UnicodetoUtf8("\u0627\u0644\u0639\u0631\u0628\u064a\u0629")=="العربية");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->UnicodetoUtf8("\u65e5\u672c\u4eba")=="日本人");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->UnicodetoUtf8("\u8bed\u8a00\u5217\u8868")=="语言列表");
    }
    
    public function testUtf8ToUnicode(){
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToUnicode('français " efzef ')=="fran\u00e7ais \u0022 efzef ");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToUnicode("français \u0022 efzef ")=="fran\u00e7ais \u0022 efzef ");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToUnicode("ç")=="\u00e7");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToUnicode("العربية")=="\u0627\u0644\u0639\u0631\u0628\u064a\u0629");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToUnicode("日本人")=="\u65e5\u672c\u4eba");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToUnicode("语言列表")=="\u8bed\u8a00\u5217\u8868");
    }
    
    public function testUtf8ToHex(){
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHex("&")=="26");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHex("_")=="5f");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHex('français " efzef ')=="6672616ec3a761697320222065667a656620");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHex("français \u0022 efzef ")=="6672616ec3a7616973205c75303032322065667a656620");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHex("ç")=="c3a7");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHex("العربية")=="d8a7d984d8b9d8b1d8a8d98ad8a9");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHex("日本人")=="e697a5e69cace4baba");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->Utf8ToHex("语言列表")=="e8afade8a880e58897e8a1a8");
    }
    
    public function testHexToUtf8(){
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->HexToUtf8("26")=="&");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->HexToUtf8("5f")=="_");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->HexToUtf8("6672616ec3a761697320222065667a656620")=='français " efzef ');
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->HexToUtf8("6672616ec3a7616973205c75303032322065667a656620")=="français \u0022 efzef ");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->HexToUtf8("c3a7")=="ç");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->HexToUtf8("d8a7d984d8b9d8b1d8a8d98ad8a9")=="العربية");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->HexToUtf8("e697a5e69cace4baba")=="日本人");
        $this->assertTrue($this->container->get("sharindata_tool_unicode")->HexToUtf8("e8afade8a880e58897e8a1a8")=="语言列表");
    }
    
        
}