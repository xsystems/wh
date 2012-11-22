<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class BoodschapElement implements ITemplateElement, ITemplateAttributes
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
		                                    <h1>Stel hier uw verhaal op</h1>
		                                    <form id='bdsch' action='http://www.windhappers.nl/bdsch-cntrl.php' method='post'>
                                                <label form='bdsch' for='bdsch_name'>Naam</label>
                                                <input id='bdsch_name' name='naam' form='bdsch' type='text' maxlength='50' required='required'> </input>
                                                <label form='bdsch' for='bdsch_email'>E-mail adres</label>
                                                <input id='bdsch_email' name='email' form='bdsch' type='text' maxlength='60'> </input>
                                                <label form='bdsch' for='bdsch_tel'>Telefoon</label>
                                                <input id='bdsch_tel' name='telf' form='bdsch' type='text' maxlength='20'> </input>
                                                <label form='bdsch' for='bdsch_ondw'>Onderwerp</label>
                                                <input id='bdsch_onderw' name='onderw' form='bdsch' type='text' maxlength='80' required='required'> </input>
                                                <label form='bdsch' for='bdsch_verhaal'>Verhaal</label>
                                                <span>(max 1000 tekens.)</span>
                                                <textarea id='bdsch_verhaal' form='bdsch' name='verhaal' maxlength='1000' required='required'> </textarea>
                                                <input name='submit' form='bdsch' type='submit' value='Toevoegen'> </input>
                                                <input name='reset' form='bdsch' type='reset' value='Leegmaken'> </input>
                                            </form>
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
