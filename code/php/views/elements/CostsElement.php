<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class CostsElement implements ITemplateElement, ITemplateAttributes
{
	private $rootElementClass;

	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
	}

	public function createTemplateElement()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$costsElement = $domDocument->createElementNS(self::namespaceURI, "div");			
		$costsElement->setAttribute("class", $this->rootElementClass);

		$domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "<div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>       
                                            <h1>Contributie</h1>
                                            <p>De contributie is voor volwassenen EUR 82,00 en voor jeugdleden beneden de 18 jaar EUR 58,00.</p>                                         
                                            <h2>Stalling</h2>
                                            <p>
                                                EUR 30,- per kajak<br/>
                                                EUR 40,- per kajak groot <br/>
                                                EUR 50,- per canadees <br/>  
                                                EUR 30,- per verenigingsboot waarvan een lid gebruik maakt. <br/>
                                                <span>Alle bovenstaande kosten zijn per kalenderjaar.</span> <br/>
                                                <span>Voor leden die na 1 juli lid worden geldt een kortings regeling.</span>
                                            </p>
                                            <p>
                                                De contributie voor de Nederlandse Kano Bond is in deze contributie begrepen.
                                                Een <span>opzegging</span> voor het volgende kalenderjaar, dient <span>voor 31 December</span> bekend te zijn bij de ledenadministrateur <a href='mailto:jjmvdtoorn@ziggo.nl'>Jacques van der Toorn</a>
                                            </p>
                                            <p>
                                                <i>update: 21-11-2011</i>
                                            </p>    
                                          </div>" );	
								
		$costsElement->appendChild($domDocumentFragment);			
		
		return $costsElement;
	}
}
?>
