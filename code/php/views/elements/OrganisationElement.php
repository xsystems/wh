<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class OrganisationElement implements ITemplateElement, ITemplateAttributes
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
                                            <h1>De Mensen achter De Windhappers</h1>
                                            <table>
                                              <tr>
                                                <th class='alt'>FUNCTIE</th>
                                                <th class='alt'>NAAM</th>
                                                <th class='alt'>TELEFOON</th>
                                                <th class='alt'>EMAIL</th>
                                              </tr>
                                              <tr>
                                                <th colspan='4' scope='col'>BESTUUR</th>
                                              </tr>
                                              <tr>
                                                <td>Voorzitter</td>
                                                <td>Sytse van der Zwan</td>
                                                <td>06-14216890</td>
                                                <td> </td>
                                              </tr>
                                              <tr class='alt'>
                                                <td>Secretaris</td>
                                                <td>Marianne Scheepstra</td>
                                                <td>070-3903165</td>
                                                <td> </td>
                                              </tr>
                                              <tr>
                                                <td>Penningmeester</td>
                                                <td>Guus Kanters</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>
                                              <tr class='alt'>
                                                <td>PR en vicevoorzitter</td>
                                                <td>Erik Rumpff</td>
                                                <td> </td>
                                                <td><a href='mailto:windhapperredactie@hotmail.com'>E-mail</a></td>
                                              </tr>
                                              <tr>
                                                <th colspan='4'>COORDINATOREN</th>
                                              </tr>
                                              <tr>
                                                <td>Toervaren</td>
                                                <td>Jan Weerdenburg</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>
                                              <tr class='alt'>
                                                <td>Zeevaren</td>
                                                <td>Willem Oosting</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>                                                                                            
                                              <tr>
                                                <td>Kanopolo</td>
                                                <td>Arie van Leeuwen </td>
                                                <td>0174-648016</td>
                                                <td> </td>
                                              </tr>
                                              <tr class='alt'>
                                                <td>Branding en wildwatervaren</td>
                                                <td>Jan de Koster</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>  
                                              <tr>
                                                <td>Winteractiviteiten</td>
                                                <td>Willie de Jong</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>   
                                              <tr class='alt'>
                                                <td>PR</td>
                                                <td>Jacques van der Toorn </td>
                                                <td>070-3684654</td>
                                                <td> </td>
                                              </tr>                                                                                                                                     
                                              <tr>
                                                <td>Jeugd</td>
                                                <td>Jan de Koster </td>
                                                <td>070-3912510</td>
                                                <td> </td>
                                              </tr>
                                              <tr class='alt'>
                                                <td>Introductiecursus</td>
                                                <td>Koen Tiel</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>
                                              <tr>
                                                <td>Kantine</td>
                                                <td>Bert Quist</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>
                                              <tr>
                                                <th colspan='4'>OVERIGE FUNCTIES</th>
                                              </tr>
                                              <tr>
                                                <td>Ledenadministratie</td>
                                                <td>Jacques van der Toorn </td>
                                                <td>070-3684654</td>
                                                <td><a href='mailto:jjmvdtoorn@ziggo.nl'>E-mail</a></td>
                                              </tr>
                                              <tr class='alt'>
                                                <td>Beheer boten en materieel</td>
                                                <td>Hans Smits</td>
                                                <td>070-3970983</td>
                                                <td><a href='mailto:stalling.sleutel@online.nl'>E-mail</a></td>
                                              </tr>
                                              <tr>
                                                <td>Onderhoud gebouw</td>
                                                <td>Hans Grottendieck</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>                                              
                                              <tr class='alt'>
                                                <td>Hoofdredacteur clubblad</td>
                                                <td>Erik Rumpff </td>
                                                <td> </td>
                                                <td><a href='mailto:windhapperredactie@hotmail.com'>E-mail</a></td>
                                              </tr>
                                              <tr>
                                                <td>Website</td>
                                                <td>Koen Boes</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>
                                            </table>

                                            Telefoon in het botenhuis: 070-3660789 <br/>
                                            Adres secretariaat: <br/>
                                            Hoornbruglaan 9 <br/>
                                            2281 at Rijswijk <br/> <br/>
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
