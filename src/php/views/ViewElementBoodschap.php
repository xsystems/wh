<?php	

require_once("IViewElement.php");

class ViewElementBoodschap implements IViewElement
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


        $naam = "";
        $email = "";
        $telf = "";
        $onderw = "";
        $verhaal = " ";

        if( isset($_POST['naam']) )
        {
            $naam = $_POST['naam'];
            $email = $_POST['email'];
            $telf = $_POST['telf'];
            $onderw = $_POST['onderw'];
            $verhaal = $_POST['verhaal'];
        }

		$domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "<div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>
		                                    <h1>Stel hier uw verhaal op</h1>
		                                    <form id='bdsch' action='?action=bdsch_cntrl' method='post'>
                                                <label form='bdsch' for='bdsch_name'>Naam</label>
                                                <input id='bdsch_name' name='naam' form='bdsch' type='text' maxlength='50' required='required' value='$naam'> </input>
                                                <label form='bdsch' for='bdsch_email'>E-mail adres</label>
                                                <input id='bdsch_email' name='email' form='bdsch' type='text' maxlength='60' value='$email'> </input>
                                                <label form='bdsch' for='bdsch_tel'>Telefoon</label>
                                                <input id='bdsch_tel' name='telf' form='bdsch' type='text' maxlength='20' value='$telf'> </input>
                                                <label form='bdsch' for='bdsch_ondw'>Onderwerp</label>
                                                <input id='bdsch_onderw' name='onderw' form='bdsch' type='text' maxlength='80' required='required' value='$onderw'> </input>
                                                <label form='bdsch' for='bdsch_verhaal'>Verhaal</label>
                                                <span>(max 1000 tekens.)</span>
                                                <textarea id='bdsch_verhaal' form='bdsch' name='verhaal' maxlength='1000' required='required'>$verhaal</textarea>
                                                <input name='submit' form='bdsch' type='submit' value='Submit'> </input>
                                                <input name='reset' form='bdsch' type='reset' value='Reset'> </input>
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
