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


if (isset($_POST['usr']) && isset($_POST['ou']) && isset($_POST['uidNumber']) && isset($_POST['gidNumber']) && isset($_POST['directoriPersonal']) && isset($_POST['shell'])
    && isset($_POST['cn']) && isset($_POST['sn']) && isset($_POST['nom']) && isset($_POST['adreça']) && isset($_POST['mobil']) && isset($_POST['telefon'])
    && isset($_POST['titol']) && isset($_POST['descripcio'])){

#Dades de la nova entrada
#
        $usr=$_POST['usr'];
        $ou=$_POST['ou'];
        $num_id=$_POST['uidNumber'];
        $grup=$_POST['gidNumber'];
        $dir_pers=$_POST['directoriPersonal'];
        $sh=$_POST['shell'];
        $cn=$_POST['cn'];
        $sn=$_POST['sn'];
        $nom=$_POST['nom'];
        $mobil=$_POST['mobil'];
        $adressa=$_POST['adreça'];
        $telefon=$_POST['telefon'];
        $titol=$_POST['titol'];
        $descripcio=$_POST['descripcio'];
        $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
        #
        #Afegint la nova entrada
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
        $nova_entrada = [];
        Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
        Attribute::setAttribute($nova_entrada, 'uid', $uid);
        Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
        Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
        Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
        Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
        Attribute::setAttribute($nova_entrada, 'cn', $cn);
        Attribute::setAttribute($nova_entrada, 'sn', $sn);
        Attribute::setAttribute($nova_entrada, 'givenName', $nom);
        Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
        Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
        Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
        Attribute::setAttribute($nova_entrada, 'title', $titol);
        Attribute::setAttribute($nova_entrada, 'description', $descripcio);
        $dn = 'uid='.$usr.',ou='.$ou.',dc=fjeclot,dc=net';
        if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";
        else echo "Error de creació";
    }
    
?>



<html>
	<head>
           <title>
           		MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP
           </title>
    </head>
    <body>
          <h2>Formulari de creacio d'usuari</h2>
          	<form action="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/afegeix.php" method="POST">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Usuari: <input type="text" name="usr"><br>
            Uid number: <input type="text" name="uidNumber"><br>
            Gid number: <input type="text" name="gidNumber"><br>
            Directori personal: <input type="text" name="directoriPersonal"><br>
            Shell: <input type="text" name="shell"><br>
            Cn: <input type="text" name="cn"><br>
            Sn: <input type="text" name="sn"><br>
            Nom: <input type="text" name="nom"><br>
            Adreça: <input type="text" name="adreça"><br>
            Mòbil: <input type="text" name="mobil"><br>
            Telèfon: <input type="text" name="telefon"><br>
            Títol: <input type="text" name="titol"><br>
            Descripcio: <input type="text" name="descripcio"><br>
            <input type="submit"/>
            <input type="reset"/>
            </form>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/menu.php">Torna al menu</a>
            
    </body>
</html>