<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class CalendarElement implements ITemplateElement, ITemplateAttributes
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
		
		$calendarElement = $domDocument->createElementNS(self::namespaceURI, "div");
		$content = $domDocument->createElementNS(self::namespaceURI, "div");
		$h1 = $domDocument->createElementNS(self::namespaceURI, "h1");
		$title = $domDocument->createTextNode("Windhapper Kalender");
		
		$calendarElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "content");		

		$domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "<iframe id='calendar' class='' xmlns='http://www.w3.org/1999/xhtml' src='https://www.google.com/calendar/embed?title=%20&amp;wkst=2&amp;hl=nl&amp;bgcolor=%23FFFFFF&amp;src=dewindhappers%40gmail.com&amp;color=%232952A3&amp;src=nl.dutch%23holiday%40group.v.calendar.google.com&amp;color=%232F6309&amp;ctz=Europe%2FAmsterdam'> Windhapper Calendar </iframe>" );	
		
		$h1->appendChild($title);
		$content->appendChild($h1);
		$calendarElement->appendChild($content);				
		$calendarElement->appendChild($domDocumentFragment);
		
		$this->domElement = $calendarElement;
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
