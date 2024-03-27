<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Ldap;
    
    session_start();
    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/index.php");
        exit;
    }
    
    
    ini_set('display_errors',0);
    
    if (isset($_POST['usr']) && isset($_POST['ou'])){
        $uid = $_POST['usr'];
        $unorg = $_POST['ou'];
        $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
        #
        #Opcions de la connexió al servidor i base de dades LDAP
        $opcions = [
            'host' => 'zend-orgoca.fjeclot.net',
            'username' => 'cn=admin,dc=fjeclot,dc=net',
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];
        #
        # Esborrant l'entrada
        #
        $ldap = new Ldap($opcions);
        $ldap->bind();
        try{
            $ldap->delete($dn);
            echo "<b>Entrada esborrada</b><br>";
        } catch (Exception $e){
            echo "<b>Aquesta entrada no existeix</b><br>";
        }
    }
?>

<html>
	<head>
           <title>
           		ESBORRANT DADES
           </title>
    </head>
    <body>
          <h2>Formulari d'esborrament d'usuari</h2>
          	<form action="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/esborrar.php" method="POST">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Usuari: <input type="text" name="usr"><br>
            <input type="submit"/>
            <input type="reset"/>
            </form>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/menu.php">Torna al menu</a>
            
    </body>
</html>