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
    $this->property('certificate',    'string');    // Hash du bloc
    $this->property('autority',       'XCertificate');    // Hash du bloc
    $this->property('dn',             'array');    // Hash du bloc
    $this->property('csr',            'string');    // Hash du bloc
    $this->property('publicKey',      'string');    // Hash du bloc
    $this->property('privateKey',     'string');    // Hash du
    $this->property('password',       'string');    // Hash du
    $this->property('validity',       'string');    // Hash du bloc
    $this->property('serial',         'string');    // Hash du bloc
    $this->property('openSslConfig',  'array');    // Hash du
    $this->property('ressources',     'array');    // Hash du
  }


/**********************************************************/
/*****************     FIN PARAMETRES     *****************/
/**********************************************************/

/********************************************************/
/*****************     CONSTRUCTEUR     *****************/
/********************************************************/

	public function __construct(array $certificate = array()) {			// Constructeur dirigé vers la méthode d'hydratation
		parent::__construct($certificate);

    if (is_array($certificate) || is_a($certificate, get_class($this))) {
      $this->hydrate($certificate);

      $ressources = array(
        "keyPaire" => NULL,
        "csr" => NULL,
        "signedCsr" => NULL
      );

      foreach ($ressources as $ressourcesKey => $ressourcesValue) {
        $this->setRessources($ressourcesKey, $ressourcesValue);
      }

      if ($this->validity() === NULL) {
        $this->setValidity(365);
      }

      if ($this->serial() === NULL) {
        $this->setSerial(0);
      }

    } else {
      //throw new XException('00010002', 4, array( 0 => get_class($this) ));
    }
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/

/*******************************************************/
/*****************     HYDRATATION     *****************/
/*******************************************************/

  private function hydrate($certificate_datas) {
    if (is_array($certificate_datas)) {
      foreach ($certificate_datas as $datas_key => $datas_value) {
        $this->{'set'.ucfirst($datas_key)}($datas_value);
      }
    } else if (is_a($certificate_datas, get_class($this))) {
      foreach ($this->properties() as $properties_key => $properties_value) {
        $this->{'set'.ucfirst($properties_value)}($certificate_datas->$properties_value());
      }
    } else {
      //throw new XException('00010003', 4, array( 0 => get_class($this) ));
    }
  }

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
