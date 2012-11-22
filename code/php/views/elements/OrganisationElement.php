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
                                                <th colspan='3' scope='col'>BESTUUR</th>
                                              </tr>
                                              <tr>
                                                <th><div align='center'>FUNCTIE</div></th>
                                                <th><div align='center'>NAAM</div></th>
                                                <th><div align='center'>TELEFOON</div></th>
                                              </tr>
                                              <tr>
                                                <td>Voorzitter</td>
                                                <td>Sytse van der Zwan</td>
                                                <td>06-14216890</td>
                                              </tr>
                                              <tr>
                                                <td>Secretaris</td>
                                                <td>Marianne van der Kleij</td>
                                                <td>070-3658178</td>
                                              </tr>
                                              <tr>
                                                <td>Penningmeester</td>
                                                <td>Vacature</td>
                                                <td> </td>
                                              </tr>
                                              <tr>
                                                <td>Algemeen bestuurslid</td>
                                                <td> </td>
                                                <td> </td>
                                              </tr>
                                              <tr>
                                                <td>Coordinator activiteiten</td>
                                                <td>Vacature</td>
                                                <td> </td>
                                              </tr>
                                              <tr>
                                                <th colspan='3'>OVERIGE FUNCTIES</th>
                                              </tr>
                                              <tr>
                                                <td rowspan='2' valign='top'>Ledenadministratie</td>
                                                <td rowspan='2' valign='top'>Jacques van der Toorn </td>
                                                <td>070-3684654</td>
                                              </tr>
                                              <tr>
                                                <td><a href='mailto:jjmvdtoorn@ziggo.nl'>E-mail</a></td>
                                              </tr>
                                              <tr>
                                                <td>PR</td>
                                                <td>Jacques van der Toorn </td>
                                                <td>070-3684654</td>
                                              </tr>
                                              <tr>
                                                <td rowspan='2' valign='top'>Botenstalling</td>
                                                <td rowspan='2' valign='top'>Hans Smits</td>
                                                <td>070-3970983</td>
                                              </tr>
                                              <tr>
                                                <td><a href='mailto:stalling.sleutel@online.nl'>E-mail</a></td>
                                              </tr>
                                              <tr>
                                                <td>Coordinator kanopolo</td>
                                                <td>Arie van Leeuwen </td>
                                                <td>0174-648016</td>
                                              </tr>
                                              <tr>
                                                <td>Coordinator jeugd </td>
                                                <td>Jan de Koster </td>
                                                <td>070-3912510</td>
                                              </tr>
                                              <tr>
                                                <td>Coordinator introductiecursus </td>
                                                <td>Jacques van der Toorn </td>
                                                <td>070-3684654</td>
                                              </tr>
                                              <tr>
                                                <td>Coordinator kantine:</td>
                                                <td><span>Vacature</span></td>
                                                <td> </td>
                                              </tr>
                                              <tr>
                                                <td valign='top'>Clubblad:</td>
                                                <td>Erik Rumpff </td>
                                                <td><a href='mailto:windhapperredactie@hotmail.com'>E-mail</a></td>
                                              </tr>
                                              <tr>
                                                <td valign='top'>Website</td>
                                                <td>Gerrit Verkooij</td>
                                                <td>070-3675448</td>
                                              </tr>
                                            </table>
                                            <br/>                                    
                                            <TABLE>
                                            <TR>
                                               <td>Telefoon in het botenhuis: 070-3660789 <br/>
                                                   Adres secretariaat: <br/>
                                                   De Ruijterstraat 69 <br/>
                                                   2518 AR Den Haag
                                                 </td>
                                            </TR>
                                            </TABLE>  
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
