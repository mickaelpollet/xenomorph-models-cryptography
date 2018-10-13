<?php
/*************************************
 * @project: 	Xenomorph - Models - XCertificate
 * @file:		CLASS XCertificate
 * @author: 	Mickaël POLLET
 *************************************/

class XCertificate extends XClass
{

/******************************************************/
/*****************     PARAMETRES     *****************/
/******************************************************/

	//use XSystem;

	// Propriétés par défaut

	// Déclaration des propriétés
  public function setClassProperties() {
    $this->property(array('name' => 'certificate', 'type' => 'string'));    // Hash du bloc
    $this->property(array('name' => 'autority', 'type' => 'XCertificate'));    // Hash du bloc
    $this->property(array('name' => 'dn', 'type' => 'array'));    // Hash du bloc
    $this->property(array('name' => 'csr', 'type' => 'string'));    // Hash du bloc
    $this->property(array('name' => 'publicKey', 'type' => 'string'));    // Hash du bloc
    $this->property(array('name' => 'privateKey', 'type' => 'string'));    // Hash du
    $this->property(array('name' => 'password', 'type' => 'string'));    // Hash du
    $this->property(array('name' => 'validity', 'type' => 'string', 'defaultValue' => 365));    // Hash du bloc
    $this->property(array('name' => 'serial', 'type' => 'string', 'defaultValue' => 0));    // Hash du bloc
    $this->property(array('name' => 'openSslConfig', 'type' => 'array'));    // Hash du
    $this->property(array('name' => 'ressources', 'type' => 'array', 'defaultValue' => array("keyPaire" => NULL, "csr" => NULL, "signedCsr" => NULL)));    // Hash du
  }


/**********************************************************/
/*****************     FIN PARAMETRES     *****************/
/**********************************************************/

/********************************************************/
/*****************     CONSTRUCTEUR     *****************/
/********************************************************/

	public function __construct(array $certificate = array()) {			// Constructeur dirigé vers la méthode d'hydratation
		parent::__construct($certificate);
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/

/*******************************************************/
/*****************     HYDRATATION     *****************/
/*******************************************************/
/***********************************************************/
/*****************     FIN HYDRATATION     *****************/
/***********************************************************/

/***************************************************/
/*****************     GETTERS     *****************/
/***************************************************/
/*******************************************************/
/*****************     FIN GETTERS     *****************/
/*******************************************************/

/***************************************************/
/*****************     SETTERS     *****************/
/***************************************************/

  // Création des clés privée et publique
  public function setRessources($ressourceKey, $ressourceValue) {

    $certificateRessources = $this->ressources();
    $certificateRessources[$ressourceKey] = $ressourceValue;

    parent::setRessources($certificateRessources);

  }

/*******************************************************/
/*****************     FIN SETTERS     *****************/
/*******************************************************/
}
?>
