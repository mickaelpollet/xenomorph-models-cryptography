<?php

// Déclaration de l'autoload
require __DIR__ . '/vendor/autoload.php';

echo "<h1>XENOMORPH - Models : Cryptography</h1>";


////////////////////////////// TEST CERTIFICATS ////////////////////////////
$certTest = new XCertificate();

$dn = array(
    "countryName"             => "FR",
    "stateOrProvinceName"     => "FRANCE",
    "localityName"            => "LABARTHE SUR LEZE",
    "organizationName"        => "KODIX",
    "organizationalUnitName"  => "KODIX",
    "commonName"              => "mickaelpollet@gmail.com",
    "emailAddress"            => "mickaelpollet@gmail.com"
);

$certTest->setDn($dn);
$certTest->setPassword("test");

$certTestManager = new XCertificateManager($certTest);
$certTestManager->generateCertificate();


var_dump($certTest);

////////////////////////////// FIN TEST CERTIFICATS ////////////////////////////
?>
