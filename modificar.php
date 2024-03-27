<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/index.php");
    exit;
}

ini_set('display_errors', 0);

if (isset($_POST['ou']) && isset($_POST['usr']) && isset($_POST['modificar']) && isset($_POST['nou_valor'])) {
    $unorg = $_POST['ou'];
    $uid = $_POST['usr'];
    $atribut = $_POST['modificar'];
    $nou_valor = $_POST['nou_valor'];
    
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    
    
    $opcions = [
        'host' => 'zend-orgoca.fjeclot.net',
        'username' => "cn=admin,dc=fjeclot,dc=net",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    
    $entrada = $ldap->getEntry($dn);
    
    if ($entrada){
        Attribute::setAttribute($entrada, $atribut, $nou_valor);
        if ($ldap->update($dn, $entrada)) {
            echo "Atribut $atribut modificat correctament a $nou_valor";
        } else {
            echo "Error en la modificació de l'atribut $atribut";
        }
    } else {
        echo "<b>Aquesta entrada no existeix</b><br><br>";
    }
}    

?>


<html>
<head>
    <title>MODIFICANT DADES</title>
</head>
<body>
    <h2>Formulari de modificacio d'atributs d'usuari</h2>
    <form action="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/modificar.php" method="POST">
        Unitat organitzativa: <input type="text" name="ou"><br>
        Usuari: <input type="text" name="usr"><br>

        <input type="radio" name="modificar" value="uidNumber"> Modificar uidNumber<br>
        <input type="radio" name="modificar" value="gidNumber"> Modificar gidNumber<br>
        <input type="radio" name="modificar" value="homeDirectory"> Modificar Directori personal<br>
        <input type="radio" name="modificar" value="loginShell"> Modificar Shell<br>
        <input type="radio" name="modificar" value="cn"> Modificar Cn<br>
        <input type="radio" name="modificar" value="sn"> Modificar Sn<br>
        <input type="radio" name="modificar" value="givenName"> Modificar Nom<br>
        <input type="radio" name="modificar" value="postalAddress"> Modificar Adreça<br>
        <input type="radio" name="modificar" value="mobile"> Modificar Mòbil<br>
        <input type="radio" name="modificar" value="telephoneNumber"> Modificar Telèfon<br>
        <input type="radio" name="modificar" value="title"> Modificar Títol<br>
        <input type="radio" name="modificar" value="description"> Modificar Descripcio<br>
        

           

        Nou valor: <input type="text" name="nou_valor"><br>

        <input type="submit" value="Enviar">
        <input type="reset" value="Netejar">
    </form>
    <a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/menu.php">Torna al menu</a>
</body>
</html>
