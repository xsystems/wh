<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class CostsElement implements ITemplateElement, ITemplateAttributes
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
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "div");			
		$this->domElement->setAttribute("class", $this->rootElementClass);

		$domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "<div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>       
                                            <h1> </h1>
                                            <table>
                                              <tr>
                                                <th class='alt'>Omschrijving</th>
                                                <th class='alt'>Bedrag (1-okt-2012 tot 1-jul-2013)*</th>
                                              </tr>
                                              <tr>
                                                <th colspan='2' scope='col'>Contributie**</th>
                                              </tr>
                                              <tr>
                                                <td>Senioren</td>
                                                <td>&#8364; 84.00</td>
                                              </tr>
                                              <tr class='alt'>
                                                <td>Junioren (&lt;18)</td>
                                                <td>&#8364; 59.00</td>
                                              </tr>
                                              <tr>
                                                <th colspan='2'>Stalling</th>
                                              </tr>
                                              <tr>
                                                <td>Kajak klein</td>
                                                <td>&#8364; 30.00</td>
                                              </tr>
                                              <tr class='alt'>
                                                <td>Kajak groot</td>
                                                <td>&#8364; 40.00</td>
                                              </tr>                                                                                            
                                              <tr>
                                                <td>Canadees</td>
                                                <td>&#8364; 50.00</td>
                                              </tr>
                                              <tr>
                                                <th colspan='4'>Overige</th>
                                              </tr>
                                              <tr>
                                                <td>Gebruik verenigingskajak of canadees</td>
                                                <td>&#8364; 30.00</td>
                                              </tr>
                                            </table>                                            
                                            <p>      
                                                * Voor leden die na 1 juli lid worden geldt een kortings regeling. <br/>    
                                                * Bij inschrijvingen tussen 1 oktober en 31 december is de contributie gratis als de contributie voor het daarop volgende jaar wordt betaald. <br/>      
                                                ** De contributie voor de Nederlandse Kano Bond is in deze contributie begrepen. <br/>
                                                Een <span>opzegging</span> voor het volgende kalenderjaar, dient <span>voor 31 December</span> bekend te zijn bij de ledenadministrateur <a href='mailto:jjmvdtoorn@ziggo.nl'>Jacques van der Toorn</a>
                                            </p>                          
                                          </div>" );	
								
		$this->domElement->appendChild($domDocumentFragment);
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
