<?php
    session_start();
    include("clases/BaseDeDatosmysqli.php");
    $con = new BaseDeDatosmysqli();

    if ($con->connect_errno){
        exit("Failed to connect to MySQL: $con->connect_error");
    }

    // Verificamos que se relleno la información del formulario de login.
    if ( !isset($_POST["usuario"], $_POST["password"]) ) {
        // En caso de que no.
        exit("Por favor rellene los campos de usuario y contraseña.");
    }
    
    // Preparamos la consulta SQL, para prevenir inyección SQL.
    // https://www.php.net/manual/es/mysqli.quickstart.prepared-statements.php
    // https://www.php.net/manual/es/security.database.sql-injection.php#security.database.avoiding
    // https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    if ($stmt = $con->prepare("SELECT idusuario, password FROM usuario WHERE correo = ?")) {
        $stmt->bind_param("s", $_POST["usuario"]);
        $stmt->execute();
        
        // Guardamos el resultado para verificar si existe la cuenta.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            
            /*
            La cuenta existe, asi que verificamos el password
            La contraseña guardada en la BD es el hash de la misma, creada con la funcion de php password_hash
            https://www.php.net/manual/es/function.password-hash.php
            Al momento de verificar podemos usar también la funcion que provee php
            https://www.php.net/manual/es/function.password-verify.php
            */

            if (password_verify($_POST["password"], $password)) {
                // Verificación correcta
                // Creamos la sesión, para saber que el usuario esta logeado.
                session_regenerate_id();
                $_SESSION["loggedin"] = true;
                $_SESSION["usuario"] = $_POST["usuario"];
                $_SESSION["id"] = $id;
                header("Location: home.php");
            } else {
                // Contraseña incorrecta.
                echo "Usuario o contraseña incorrecta!";
            }
        } else {
            // Usuario incorrecto.
            echo "Usuario o contraseña incorrecta!";
        }

        $stmt->close();
    }
?>