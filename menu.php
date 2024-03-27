<?php
    session_start();
    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/index.php");
        exit;
    }
    
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/index.php");
        exit;
    }

?>



<html>
	<head>
		<title>
			PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP
		</title>
	</head>
	<body>
		<h2> MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</h2>
		<h3> <b>En construcció!!!!!!!!!!!</b> </h3>
		<a href="?logout">Tanca la sessió</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/index.php">Torna a la pàgina inicial</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/visualitza.php">Visualitza dades d'un usuari</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/afegeix.php">Nou registre</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/esborrar.php">Esborrar registre</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="http://zend-orgoca.fjeclot.net/daw2_m08uf23_projecte_gonzalez_oriol/modificar.php">Modificar registre</a>
		
	</body>
</html>