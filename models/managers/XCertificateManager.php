<?php
/*************************************
 * @project: 	Xenomorph - Models - XCertificateManager
 * @file:		MANAGER de la calsse XCertificate
 * @author: 	Mickaël POLLET
 *************************************/

class XCertificateManager
{

  /******************************************************/
  /*****************     PARAMETRES     *****************/
  /******************************************************/

    private $_openSslConf = array(  'private_key_bits' => 384,                  // Spécifie la longueur en bits de la clé privée
                                    'private_key_type' => OPENSSL_KEYTYPE_RSA,  // Spécifie le type de clé privée à créer. Les valeurs possibles sont OPENSSL_KEYTYPE_DSA, OPENSSL_KEYTYPE_DH ou OPENSSL_KEYTYPE_RSA. La valeur par défaut est OPENSSL_KEYTYPE_RSA qui est actuellement le seul type de clé supporté.
                                    //'digest_alg' => NULL,                     // Sélectionne l'algorithme de hachage à utiliser (string)
                                    //'x509_extensions' => NULL,                // Sélectionne quelle extension utiliser lors de la création d'un certificat x509 (string)
                                    //'req_extensions'  => NULL,                // Sélectionne quelle extension utiliser lors de la création d'une CSR  (string)
                                    //'encrypt_key' => TRUE,                    // La clé (avec mot de passe) exportée doit-elle être chiffrée ? (boolean)
                                    //'encrypt_key_cipher'  => NULL,            // Une des constantes cipher. (integer)
                                    'config' => 'D:\wamp64\bin\apache\apache2.4.25\conf\openssl.cnf');
    private $_certificate = NULL;

  /**********************************************************/
  /*****************     FIN PARAMETRES     *****************/
  /**********************************************************/


  /********************************************************/
  /*****************     CONSTRUCTEUR     *****************/
  /********************************************************/

    public function __construct(XCertificate $certificate = NULL) {
      if ($certificate !== NULL) {
        $certificate->setOpenSslConfig($this->openSslConfig());
        $this->setCertificate($certificate);
      }
    }

  /************************************************************/
  /*****************     FIN CONSTRUCTEUR     *****************/
  /************************************************************/


  /***************************************************/
  /*****************     SETTERS     *****************/
  /***************************************************/

    // Setter d'attribution de la BlockChain en cours
    private function setOpenSslConfig($openSslConf) {
      $this->_openSslConf = $openSslConf;
    }

    // Setter d'attribution de la BlockChain en cours
    private function setCertificate(XCertificate $certificate) {
      $this->_certificate = $certificate;
    }

  /*******************************************************/
  /*****************     FIN SETTERS     *****************/
  /*******************************************************/


  /***************************************************/
  /*****************     GETTERS     *****************/
  /***************************************************/

    // Getter de récupération de la BlockChain en cours
    private function openSslConfig() {
      return $this->_openSslConf;
    }

    // Setter d'attribution de la BlockChain en cours
    private function certificate() {
      return $this->_certificate;
    }

  /*******************************************************/
  /*****************     FIN GETTERS     *****************/
  /*******************************************************/


  /************************************************************/
  /*********************     METHODES     ********************/
  /************************************************************/

    // Création des clés privée et publique
    public function createKeys() {

      // Création de la paire de clés
      $keyPaire = openssl_pkey_new($this->certificate()->openSslConfig());
      $this->certificate()->setRessources('keyPaire', $keyPaire);

      // Création de la clé privée
      openssl_pkey_export($keyPaire, $privateKey, $this->certificate()->password(), $this->certificate()->openSslConfig());

      // Extraction de la clé publique
      $publicKeyExport = openssl_pkey_get_details($keyPaire);

      $this->certificate()->setPrivateKey($privateKey);
      $this->certificate()->setPublicKey($publicKeyExport["key"]);

      if (openssl_error_string() !== FALSE) {
        var_dump("Création des clés du Certificat : ".openssl_error_string());
      }

      return TRUE;
    }

    // Création de la CSR
    public function createCsr() {

      $dn = $this->certificate()->dn();
      $pkey = $this->certificate()->privateKey();

      $csr = openssl_csr_new($dn, $pkey, $this->certificate()->openSslConfig());

      $this->certificate()->setRessources('csr', $csr);

      openssl_csr_export($this->certificate()->ressources()['csr'], $realCsr);

      $this->certificate()->setCsr($realCsr);

      if (openssl_error_string() !== FALSE) {
        var_dump("Génération de la CSR du Certificat : ".openssl_error_string());
      }

      return TRUE;
    }

    // Signature du certificat
    public function signCertificate() {

      // $autority = NULL implique un certificat Auto-signé

      // Récupération de la ressource CSR
      $csr = $this->certificate()->ressources()['csr'];

      if ($this->certificate()->autority() !== NULL) {
        $autority = $this->certificate()->autority()->certificate();
        $pkey = array ($this->certificate()->autority()->privateKey(), $this->certificate()->autority()->password());
      } else {
        $autority = NULL;
        $pkey = array ($this->certificate()->privateKey(), $this->certificate()->password());
      }

      // Signature de la CRL
      $signedCsr = openssl_csr_sign($csr, $autority, $pkey, $this->certificate()->validity(), $this->certificate()->openSslConfig());
      $this->certificate()->setRessources('signedCsr', $signedCsr);

      // Export du certificat
      openssl_x509_export($signedCsr, $certOut);

      $this->certificate()->setCertificate($certOut);

      if (openssl_error_string() !== FALSE) {
        var_dump("Signature du Certificat : ".openssl_error_string());
      }

      return TRUE;
    }

    // Génération d'un certificat
    public function generateCertificate() {

      // Création des clés
      $this->createKeys();
      // Création de la CSR
      $this->createCsr();
      // Création du certificat
      $this->signCertificate();

      return TRUE;
    }



  /************************************************************/
  /*******************     FIN METHODES     *******************/
  /************************************************************/

}

?>
