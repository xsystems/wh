<?php
/**
 * This file includes all src files
 */

// Configuration
require_once("models/ModelConfiguration.php");
Configuration::getInstance();

// Models
require_once(Configuration::$DOCUMENT_ROOT."/src/php/models/ModelDiscipline.php");

// Views
require_once("src/php/views/ViewDeWindhappers.php");
require_once("src/php/views/ViewElementHome.php");
require_once("src/php/views/ViewElementHomeEnglish.php");
require_once("src/php/views/ViewElementHomeGerman.php");
require_once("src/php/views/ViewElementCalendar.php");
require_once("src/php/views/ViewElementDiscipline.php");
require_once("src/php/views/ViewElementGalleryClubMagazine.php");
require_once("src/php/views/ViewElementGalleryImage.php");
require_once("src/php/views/ViewElementGalleryVideo.php");
require_once("src/php/views/ViewElementCanoetours.php");
require_once("src/php/views/ViewElementMeteorology.php");
require_once("src/php/views/ViewElementOrganisation.php");
require_once("src/php/views/ViewElementLocation.php");
require_once("src/php/views/ViewElementCosts.php");
require_once("src/php/views/ViewElementVertel.php");
require_once("src/php/views/ViewElementBoodschap.php");

// Not used.
require_once("src/php/views/ViewElementShowIFrame.php");
require_once("src/php/views/ViewElementShowObject.php");

?>
