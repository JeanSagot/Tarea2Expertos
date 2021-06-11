<?php
/* ==============================================

Template: Bayes para determinar valores
Author:	Jean Sagot
Date: 03/06/21
================================================ */
error_reporting(E_ERROR | E_PARSE);
#Including the db connection
include("connection.php");

if (isset($_POST["sendBtn"])) {

    $tipoRecinto = "";

    //Prior probability
    $priorP = 0.4935064935;
    $priorT = 0.5064935065;

    //variables del usuario
    $estiloInput = $_POST["Estilo"];
    $promedioInput = $_POST["Promedio"];
    $sexoInput = $_POST["Sexo"];

    //variables TURRIALBA de base de datos
    $resultsexoTDB = mysqli_query($connection, "SELECT sexo_probabilidadT FROM probabilidad_recinto WHERE sexoT = '$sexoInput'");
    $fetchsexoTDB =   mysqli_fetch_array($resultsexoTDB);
    $sexoTDB = $fetchsexoTDB['sexo_probabilidadT'];

    $resultpromedioTDB = mysqli_query($connection, "SELECT promedio_probabilidadT FROM probabilidad_recinto WHERE promedioT = CAST( $promedioInput AS DECIMAL) ");
    $fetchpromedioTDB =   mysqli_fetch_array($resultpromedioTDB);
    $promedioTDB = $fetchpromedioTDB['promedio_probabilidadT'];

    $resultestiloTDB = mysqli_query($connection, "SELECT estilo_probabilidadT FROM probabilidad_recinto WHERE estiloT = '$estiloInput'");
    $fetchestiloTDB =   mysqli_fetch_array($resultestiloTDB);
    $estiloTDB = $fetchestiloTDB['estilo_probabilidadT'];


    //variables PARAISO de base de datos
    $resultsexoPDB = mysqli_query($connection, "SELECT sexo_probabilidadP FROM probabilidad_recinto WHERE sexoP = '$sexoInput'");
    $fetchsexoPDB =   mysqli_fetch_array($resultsexoPDB);
    $sexoPDB = $fetchsexoPDB['sexo_probabilidadP'];

    $resultpromedioPDB = mysqli_query($connection, "SELECT promedio_probabilidadP FROM probabilidad_recinto WHERE promedioP = CAST( $promedioInput AS DECIMAL) ");
    $fetchpromedioPDB =   mysqli_fetch_array($resultpromedioPDB);
    $promedioPDB = $fetchpromedioPDB['promedio_probabilidadP'];

    $resultestiloPDB = mysqli_query($connection, "SELECT estilo_probabilidadP FROM probabilidad_recinto WHERE estiloP = '$estiloInput'");
    $fetchestiloPDB =   mysqli_fetch_array($resultestiloPDB);
    $estiloPDB = $fetchestiloPDB['estilo_probabilidadP'];


    //Obtenemos la probabilidad para cada categoria que se quiere encontrar
    $probabilidadTurrialba = $sexoTDB * $promedioTDB * $estiloTDB * $priorT;
    $probabilidadParaiso = $sexoPDB * $promedioPDB * $estiloPDB * $priorP;

    //Se encuentra el estilo segun los resultados que se obtuviero anteriormente
    if ($probabilidadTurrialba > $probabilidadParaiso) {
        $tipoRecinto = "Turrialba";
    } else {
        $tipoRecinto = "Paraiso";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" />

    <!-- Default css -->
    <link rel="stylesheet" type="text/css" href="../css/estiloAprendizaje.css" />

    <title>Tarea1-JeanSagot</title>

</head>

<!-- Hero Navbar-->
<header id="home">

    <div class="overlay"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand">
                <h3 class="my-heading">Tarea1</h3>
            </a>
            <!-- END Brand -->
            <!-- Navbar controls -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estiloAprendizaje.php">Estilos aprendizaje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estiloRecinto.php">Recinto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estiloSexo.php">Sexo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estiloAprendizaje2.php">Estilo aprendizaje2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estiloProfesor.php">Profesor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estiloRedes.php">Redes</a>
                </li>
            </ul>
            <!-- END Navbar controls -->
        </div>
    </nav>
    <!-- END Navbar -->
</header>
<!-- END Hero Navbar -->

<body>
    <!-- Information text-->
    <div class="container-fluid textDiv" style="margin-bottom: 2%;">
        <div class="row">
            <div>

                <h1 class="redText">
                    <b>Adivine su recinto de origen</b>
                </h1>

                <p>
                    <b>Instrucciones:</b>
                    <br>
                    Podra adivinar el recinto de procedencia de un estudiante:
                </p>
                <p>
                    Podrá seleccionar su estilo de aprendizaje de los cuatro usados(divergente, convergente, asimilador, acomodador)
                </p>
                <p>
                    El último promedio para matrícula, el cual es entre 0 y 10 (7.5 por ejemplo)
                </p>
                <p>
                    El sexo, masculino o femenino
                </p>
            </div>
        </div>
    </div>
    <!-- END Information text-->

    <!-- Information learning style panel-->
    <div class="container information-div">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 pb-5">

                <form name="studentInfo" action="estiloRecinto.php" method="post">
                    <div class="card border-primary rounded-0">

                        <div class="card-header p-0">
                            <div class="info-panel text-white text-center py-2">
                                <h3><i class="fa fa-info-circle"></i> Su informacion</h3>
                                <p class="m-0">Brindenos su informacion para adivinar</p>
                            </div>
                        </div>

                        <div class="card-body p-2">
                            <!--Body-->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Estilo" required disabled>
                                    <select class="form-control" name="Estilo">
                                        <option value="Divergente">Divergente</option>
                                        <option value="Convergente">Convergente</option>
                                        <option value="Asimilador">Asimilador</option>
                                        <option value="Acomodador">Acomodador</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-graduation-cap text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Promedio" name="Promedio" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-venus-mars text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Sexo" disabled>
                                        <select class="form-control" name="Sexo">
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">

                                <div class="text-center">
                                    <input value="Enviar" type="submit" class="btn info-btn btn-block rounded-0 py-2" name="sendBtn">
                                </div>

                                <div class="form-group" style="margin-top: 5%;">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-building text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Recinto" disabled value=<?php echo (isset($tipoRecinto)) ? $tipoRecinto : ''; ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Information learning style panel-->
</body>

</html>