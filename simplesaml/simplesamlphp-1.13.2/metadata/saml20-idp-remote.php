<?php
$metadata['https://sts.kdg.be/adfs/services/trust'] = array (
  'entityid' => 'https://sts.kdg.be/adfs/services/trust',
  'sign.logout' => true,
  'contacts' => 
  array (
    0 => 
    array (
      'contactType' => 'support',
    ),
  ),
  'metadata-set' => 'saml20-idp-remote',
  'SingleSignOnService' => 
  array (
    0 => 
    array (
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://sts.kdg.be/adfs/ls/',
    ),
    1 => 
    array (
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => 'https://sts.kdg.be/adfs/ls/',
    ),
  ),
  'SingleLogoutService' => 
  array (
    0 => 
    array (
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://sts.kdg.be/adfs/ls/',
    ),
    1 => 
    array (
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => 'https://sts.kdg.be/adfs/ls/',
    ),
  ),
  'ArtifactResolutionService' => 
  array (
  ),
  'keys' => 
  array (
    0 => 
    array (
      'encryption' => true,
      'signing' => false,
      'type' => 'X509Certificate',
      'X509Certificate' => 'MIIC1jCCAb6gAwIBAgIQeOT/QtCxx4ZE4fh0+L3xnDANBgkqhkiG9w0BAQsFADAnMSUwIwYDVQQDExxBREZTIEVuY3J5cHRpb24gLSBzdHMua2RnLmJlMB4XDTE1MDIxODA3MzIxMVoXDTI1MDIxNTA3MzIxMVowJzElMCMGA1UEAxMcQURGUyBFbmNyeXB0aW9uIC0gc3RzLmtkZy5iZTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAKGtjIXvlpk+FIgkiARU6LaM1iJaGf/Kyg458ApA4C8/Rgwv5/CxiC1hPn4CkQlsh3ga7qxGxc6IJe7wrf7VJsGDJZ1Q4+cvWt6lPruD8KFnfeLqA7zxjE9BnzSTDGjoeOlOG75PkdDsVnG5xl1m9QFre/bUHF6LhP5FSUHtcr9etd9sPOGHrW4NSI5fa4HhSZr66ayUNVhmqLvao/ApZi8uWFsFO6bfwTTuAPGjP5TVa2qR332+wbpAaUtOpM04aQB6H9bDNPsQ3iwwTR1BRzeItNJD/Sv20YocvXH2W2h5Glw9reYcnijM7WW4gD1BgsRltBP6cRYqEtRNWtF8hXMCAwEAATANBgkqhkiG9w0BAQsFAAOCAQEAa9+F+bg6MKjlZ2QCK7rK3gXTvOk1JmencwUkQx4cZoQrrCGXoYSnsZYjAHKUiXECjc+EZ/G0qK0ceGA4svw3x1mTd5mPdyABgQH+2jWbn+Nx6+Olo6S+pVEyCo/hSOoh68BGEhfKWUlsGw2Xpo6JsjCZ9oy8CEaU8PoAVRRFDzHSaQOOsJSPngvEJwvp9obJPMdujUy8/HbGA7AWvZhbz3D+ZUB8WMitFtif+JGtsGTW+WC8zhE5iIlhZWFfYVKFyHRiiW/0JML8Np6y+GfUbTPTzYbjQiWNnYy0mmkkh1jqc8UjAMu7XMMrl3d5GusJHfqE3Ldx2NPgQ03x7svnyg==',
    ),
    1 => 
    array (
      'encryption' => false,
      'signing' => true,
      'type' => 'X509Certificate',
      'X509Certificate' => 'MIIC0DCCAbigAwIBAgIQFq9rjaqePI5BEBiM8FST4DANBgkqhkiG9w0BAQsFADAkMSIwIAYDVQQDExlBREZTIFNpZ25pbmcgLSBzdHMua2RnLmJlMB4XDTE1MDIxODA3MzExOFoXDTI1MDIxNTA3MzExOFowJDEiMCAGA1UEAxMZQURGUyBTaWduaW5nIC0gc3RzLmtkZy5iZTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAOKefa2DB5IsAvrEuSt+Un788cxM/Qq7GPaWuzXbrzHS7dOJOgITa5hO+O48Mogpyf+pE1ci1QzEkbd301SOovXJcxgYWxa3el1bEfA3LXpY79nAEYVIdI05LMZUZwqqbgvNrQN6wNL1s+482V8BkDzDQFlrS5zOA/3eENsRcJS5v7jJnPH8mVw+hLSrrTHeNqgp4wQKPk0S1UYKy6V7jS1ZefSjxjpJA9ffGxA1K5rtVa9UxoZbE8wDAcfqbPywkBJ1dxy8Fw+MOwxv0Le+fzzBomksl+AQYQ5l0Sg3PzMnzb4hR4BXQn6zyLwnagT2GSnzwSLVY5Kf+7j0UoxsWw8CAwEAATANBgkqhkiG9w0BAQsFAAOCAQEAgbNyP1x1TffsfII1evj3DLQuie65Nm6wR4EUOj4EDso8LcKv6Di/rIvmqbHYFIKNXivJlLmpHqixgmREKDNwbyXd+j3pdaX3Z8H+shGoVDScYNwO53f1woDuBD8eBj8hpwLHzpoLknq1zRQd69jQOXtj7NZyIllINJCEiRvPABsccY6pLkifndPxlrlfUj8s+JxpH3Yj+PkoYjh23CpNXbYuZ85CM2zbK89FtK+ydXv3Y1AC3VnYfoV3COArrWA6CheICempQrX7OnNiqo/QacOX/H3MC6iQYRicbc6Z/PPp2rs35GkDDUWMWDYdgZ9LSWd+cUjP9yNuNeAQYtuLyg==',
    ),
  ),
);

?>