<?php

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
  $certTest->generateCertificate();

  var_dump($certTest);

?>
