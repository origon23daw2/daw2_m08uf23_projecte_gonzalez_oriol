<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/index.php");
    exit;
}


ini_set('display_errors',0);
if (isset($_GET['usr']) && isset($_GET['ou'])){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-orgoca.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}    


?>
<html>
	<head>
           <title>
           		MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP
           </title>
    </head>
    <body>
          <h2>Formulari de selecció d'usuari</h2>
          	<form action="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/visualitza.php" method="GET">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Usuari: <input type="text" name="usr"><br>
            <input type="submit"/>
            <input type="reset"/>
            </form>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/menu.php">Torna al menu</a>
            
    </body>
</html>