<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class MeteorologyElement implements ITemplateElement, ITemplateAttributes
{	
    private $domElement;

	private $rootElementClass;

	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->init();
	}
	
	public function init()
	{
        $domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$meteorologyElement = $domDocument->createElementNS(self::namespaceURI, "div");
		$content = $domDocument->createElementNS(self::namespaceURI, "div");
		$meteorologyBox = $domDocument->createElementNS(self::namespaceURI, "div");
		$meteorologyBox2 = $domDocument->createElementNS(self::namespaceURI, "div");
		$weergadgetBox = $domDocument->createElementNS(self::namespaceURI, "div");
		$h1 = $domDocument->createElementNS(self::namespaceURI, "h1");
				
		$title = $domDocument->createTextNode("Meteorologische Informatie");
		
		$meteorologyElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "content");
		$meteorologyBox->setAttribute("class", "meteorology_box");
		$meteorologyBox2->setAttribute("class", "meteorology_box2");
		$weergadgetBox->setAttribute("class", "weergadget");

		$domDocumentFragmentBuienradar = $domDocument->createDocumentFragment();
		$domDocumentFragmentBuienradar->appendXML( "<iframe class='buienradar' src='http://www2.buienradar.nl/display.php?width=1024&amp;height=1000&amp;country=nl&amp;maptype=2&amp;opacity=75' scrolling='no' frameborder='0' hspace='0' vspace='0' marginheight='0' marginwidth='0'> </iframe>" );	
	
		$domDocumentFragmentWeatherstation = $domDocument->createDocumentFragment();
		$domDocumentFragmentWeatherstation->appendXML( "<iframe class='' src='http://gratisweerdata.buienradar.nl/weergadget/index6330.html' scrolling='no' frameborder='0' hspace='0' vspace='0' marginheight='0' marginwidth='0'> </iframe>" );	
		
		$domDocumentFragmentTideChart = $domDocument->createDocumentFragment();
		$domDocumentFragmentTideChart->appendXML( "<img alt='Hoek van Holland, Netherlands tide times for the next 7 days' src='http://www.tide-forecast.com/tides/Hoek-van-Holland-Netherlands.png'></img>" );	
		
		$h1->appendChild($title);
		$content->appendChild($h1);
#		$meteorologyElement->appendChild($content);	
		$meteorologyElement->appendChild($meteorologyBox2);	
		$meteorologyElement->appendChild($meteorologyBox);	
		$weergadgetBox->appendChild($domDocumentFragmentWeatherstation);
		$meteorologyBox->appendChild($domDocumentFragmentBuienradar);
		$meteorologyBox->appendChild($weergadgetBox);
		$meteorologyBox2->appendChild($domDocumentFragmentTideChart);
		
		$this->domElement = $meteorologyElement;
	}
	
    public function add( $iTemplateElement )
    {
        // Stub
    }	
	
	public function create()
	{
		return $this->domElement;
	}
}
?>
