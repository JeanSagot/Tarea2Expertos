<?php
/* ==============================================

Template: Bayes para determinar valores
Author:	Jean Sagot
Date: 10/06/21
================================================ */
error_reporting(E_ERROR | E_PARSE);
#Including the db connection
include("connection.php");

if (isset($_POST["sendBtn"])) {

    $tipoProfesor = "";

    //Prior probability
    $priorBEG = 0.45;
    $priorINT = 0.3;
    $priorADV = 0.25;

    //variables del usuario
    $profEdadInput = $_POST["ProfEdad"];
    $sexoInput = $_POST["Sexo"];
    $autoevaluacionInput = $_POST["Autoevaluacion"];
    $cantidadImpartidoInput = $_POST["CantidadImpartido"];
    $especializacionInput = $_POST["Especializacion"];
    $habilidadCompInput = $_POST["HabilidadComp"];
    $ensenanzaInput = $_POST["Ensenanza"];
    $webProfInput = $_POST["WebProf"];

    //variables BEGGINER de base de datos
    $resultprofEdadDBBEG = mysqli_query($connection, "SELECT probabilidad_aBEG FROM probabilidad_profesores WHERE aBEG = '$profEdadInput'");
    $fetchprofEdadDBBEG =   mysqli_fetch_array($resultprofEdadDBBEG);
    $profEdadDBBEG = $fetchprofEdadDBBEG['probabilidad_aBEG'];

    $resultsexoDBBEG = mysqli_query($connection, "SELECT probabilidad_bBEG FROM probabilidad_profesores WHERE bBEG = '$sexoInput'");
    $fetchsexoDBBEG =   mysqli_fetch_array($resultsexoDBBEG);
    $sexoDBBEG = $fetchsexoDBBEG['probabilidad_bBEG'];
    
    $resultautoevaluacionDBBEG = mysqli_query($connection, "SELECT probabilidad_cBEG FROM probabilidad_profesores WHERE cBEG = '$autoevaluacionInput'");
    $fetchautoevaluacionDBBEG =   mysqli_fetch_array($resultautoevaluacionDBBEG);
    $autoevaluacionDBBEG = $fetchautoevaluacionDBBEG['probabilidad_cBEG'];

    $resultcantidadImpartidoDBBEG = mysqli_query($connection, "SELECT probabilidad_dBEG FROM probabilidad_profesores WHERE dBEG = '$cantidadImpartidoInput'");
    $fetchcantidadImpartidoDBBEG =   mysqli_fetch_array($resultcantidadImpartidoDBBEG);
    $cantidadImpartidoDBBEG = $fetchcantidadImpartidoDBBEG['probabilidad_dBEG'];

    $resultespecializacionDBBEG = mysqli_query($connection, "SELECT probabilidad_eBEG FROM probabilidad_profesores WHERE eBEG = '$especializacionInput'");
    $fetchespecializacionDBBEG =   mysqli_fetch_array($resultespecializacionDBBEG);
    $especializacionDBBEG = $fetchespecializacionDBBEG['probabilidad_eBEG'];

    $resulthabilidadCompDBBEG = mysqli_query($connection, "SELECT probabilidad_fBEG FROM probabilidad_profesores WHERE fBEG = '$habilidadCompInput'");
    $fetchhabilidadCompDBBEG =   mysqli_fetch_array($resulthabilidadCompDBBEG);
    $habilidadCompDBBEG = $fetchhabilidadCompDBBEG['probabilidad_fBEG'];

    $resultensenanzaDBBEG = mysqli_query($connection, "SELECT probabilidad_gBEG FROM probabilidad_profesores WHERE gBEG = '$ensenanzaInput'");
    $fetchensenanzaDBBEG =   mysqli_fetch_array($resultensenanzaDBBEG);
    $ensenanzaDBBEG = $fetchensenanzaDBBEG['probabilidad_gBEG'];

    $resultwebProfDBBEG = mysqli_query($connection, "SELECT probabilidad_hBEG FROM probabilidad_profesores WHERE hBEG = '$webProfInput'");
    $fetchwebProfDBBEG =   mysqli_fetch_array($resultwebProfDBBEG);
    $webProfDBBEG = $fetchwebProfDBBEG['probabilidad_hBEG'];


    //variables INTERMEDIATE de base de datos
    $resultprofEdadDBINT = mysqli_query($connection, "SELECT probabilidad_aINT FROM probabilidad_profesores WHERE aINT = '$profEdadInput'");
    $fetchprofEdadDBINT =  mysqli_fetch_array($resultprofEdadDBINT);
    $profEdadDBINT = $fetchprofEdadDBINT['probabilidad_aINT'];

    $resultsexoDBINT = mysqli_query($connection, "SELECT probabilidad_bINT FROM probabilidad_profesores WHERE bINT = '$sexoInput'");
    $fetchsexoDBINT =   mysqli_fetch_array($resultsexoDBINT);
    $sexoDBINT = $fetchsexoDBINT['probabilidad_bINT'];
    
    $resultautoevaluacionDBINT = mysqli_query($connection, "SELECT probabilidad_cINT FROM probabilidad_profesores WHERE cINT = '$autoevaluacionInput'");
    $fetchautoevaluacionDBINT =   mysqli_fetch_array($resultautoevaluacionDBINT);
    $autoevaluacionDBINT = $fetchautoevaluacionDBINT['probabilidad_cINT'];

    $resultcantidadImpartidoDBINT = mysqli_query($connection, "SELECT probabilidad_dINT FROM probabilidad_profesores WHERE dINT = '$cantidadImpartidoInput'");
    $fetchcantidadImpartidoDBINT =   mysqli_fetch_array($resultcantidadImpartidoDBINT);
    $cantidadImpartidoDBINT = $fetchcantidadImpartidoDBINT['probabilidad_dINT'];

    $resultespecializacionDBINT = mysqli_query($connection, "SELECT probabilidad_eINT FROM probabilidad_profesores WHERE eINT = '$especializacionInput'");
    $fetchespecializacionDBINT =   mysqli_fetch_array($resultespecializacionDBINT);
    $especializacionDBINT = $fetchespecializacionDBINT['probabilidad_eINT'];

    $resulthabilidadCompDBINT = mysqli_query($connection, "SELECT probabilidad_fINT FROM probabilidad_profesores WHERE fINT = '$habilidadCompInput'");
    $fetchhabilidadCompDBINT =   mysqli_fetch_array($resulthabilidadCompDBINT);
    $habilidadCompDBINT = $fetchhabilidadCompDBINT['probabilidad_fINT'];

    $resultensenanzaDBINT = mysqli_query($connection, "SELECT probabilidad_gINT FROM probabilidad_profesores WHERE gINT = '$ensenanzaInput'");
    $fetchensenanzaDBINT =   mysqli_fetch_array($resultensenanzaDBINT);
    $ensenanzaDBINT = $fetchensenanzaDBINT['probabilidad_gINT'];

    $resultwebProfDBINT = mysqli_query($connection, "SELECT probabilidad_hINT FROM probabilidad_profesores WHERE hINT = '$webProfInput'");
    $fetchwebProfDBINT =   mysqli_fetch_array($resultwebProfDBINT);
    $webProfDBINT = $fetchwebProfDBINT['probabilidad_hINT'];


    //variables ADVANCED de base de datos
    $resultprofEdadDBADV = mysqli_query($connection, "SELECT probabilidad_aADV FROM probabilidad_profesores WHERE aADV = '$profEdadInput'");
    $fetchprofEdadDBADV =   mysqli_fetch_array($resultprofEdadDBADV);
    $profEdadDBADV = $fetchprofEdadDBADV['probabilidad_aADV'];

    $resultsexoDBADV = mysqli_query($connection, "SELECT probabilidad_bADV FROM probabilidad_profesores WHERE bADV = '$sexoInput'");
    $fetchsexoDBADV =   mysqli_fetch_array($resultsexoDBADV);
    $sexoDBADV = $fetchsexoDBADV['probabilidad_bADV'];
    
    $resultautoevaluacionDBADV = mysqli_query($connection, "SELECT probabilidad_cADV FROM probabilidad_profesores WHERE cADV = '$autoevaluacionInput'");
    $fetchautoevaluacionDBADV =   mysqli_fetch_array($resultautoevaluacionDBADV);
    $autoevaluacionDBADV = $fetchautoevaluacionDBADV['probabilidad_cADV'];

    $resultcantidadImpartidoDBADV = mysqli_query($connection, "SELECT probabilidad_dADV FROM probabilidad_profesores WHERE dADV = '$cantidadImpartidoInput'");
    $fetchcantidadImpartidoDBADV =   mysqli_fetch_array($resultcantidadImpartidoDBADV);
    $cantidadImpartidoDBADV = $fetchcantidadImpartidoDBADV['probabilidad_dADV'];

    $resultespecializacionDBADV = mysqli_query($connection, "SELECT probabilidad_eADV FROM probabilidad_profesores WHERE eADV = '$especializacionInput'");
    $fetchespecializacionDBADV =   mysqli_fetch_array($resultespecializacionDBADV);
    $especializacionDBADV = $fetchespecializacionDBADV['probabilidad_eADV'];

    $resulthabilidadCompDBADV = mysqli_query($connection, "SELECT probabilidad_fADV FROM probabilidad_profesores WHERE fADV = '$habilidadCompInput'");
    $fetchhabilidadCompDBADV =   mysqli_fetch_array($resulthabilidadCompDBADV);
    $habilidadCompDBADV = $fetchhabilidadCompDBADV['probabilidad_fADV'];

    $resultensenanzaDBADV = mysqli_query($connection, "SELECT probabilidad_gADV FROM probabilidad_profesores WHERE gADV = '$ensenanzaInput'");
    $fetchensenanzaDBADV =   mysqli_fetch_array($resultensenanzaDBADV);
    $ensenanzaDBADV = $fetchensenanzaDBADV['probabilidad_gADV'];

    $resultwebProfDBADV = mysqli_query($connection, "SELECT probabilidad_hADV FROM probabilidad_profesores WHERE hADV = '$webProfInput'");
    $fetchwebProfDBADV =   mysqli_fetch_array($resultwebProfDBADV);
    $webProfDBADV = $fetchwebProfDBADV['probabilidad_hADV'];


    //Obtenemos la probabilidad para cada categoria que se quiere encontrar
    $probabilidadBeginner = $profEdadDBBEG * $sexoDBBEG * $autoevaluacionDBBEG * $cantidadImpartidoDBBEG * $especializacionDBBEG * $habilidadCompDBBEG * $ensenanzaDBBEG * $webProfDBBEG * $priorBEG;
    $probabilidadIntermediate = $profEdadDBINT * $sexoDBINT * $autoevaluacionDBINT * $cantidadImpartidoDBINT * $especializacionDBINT * $habilidadCompDBINT * $ensenanzaDBINT * $webProfDBINT * $priorINT;
    $probabilidadAdvanced = $profEdadDBADV * $sexoDBADV * $autoevaluacionDBADV * $cantidadImpartidoDBADV * $especializacionDBADV * $habilidadCompDBADV * $ensenanzaDBADV * $webProfDBADV * $priorADV;


    //Se encuentra el estilo segun los resultados que se obtuviero anteriormente
    if($probabilidadBeginner > $probabilidadIntermediate && $probabilidadBeginner > $probabilidadAdvanced ){
        $tipoProfesor = "Beginner";

    }else if($probabilidadIntermediate > $probabilidadBeginner && $probabilidadIntermediate > $probabilidadAdvanced){
        $tipoProfesor = "Intermediate";

    }else{
        $tipoProfesor = "Advanced";
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
                    <b>Adivine el tipo de profesor (Principiante, Intermedio o Avanzado) </b>
                </h1>

                <p>
                    <b>Instrucciones:</b>
                    <br>
                    Podra adivinar el tipo de profesor:
                </p>
                <p>
                    Edad, menor o igual a 30, mayor a 30 - menor a 55, mayor a 55
                </p>
                <p>
                    El sexo del profesor (Masculino o Femenino)
                </p>
                <p>
                    Autoevaluacion del profesor impartiendo el curso seleccionado
                </p>
                <p>
                    Numero de veces que ha impartido el curso
                </p>
                <p>
                    Disciplina o área de especialización
                </p>
                <p>
                    Habilidad utilizando computadoras:
                </p>
                <p>
                    ¿Que tan seguido utiliza tecnología web para la enseñanza?
                </p>
                <p>
                    ¿Que tan seguido utiliza sitios web?
                </p>
            </div>
        </div>
    </div>
    <!-- END Information text-->

    <!-- Information learning style panel-->
    <div class="container information-div">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 pb-5">
                <form name="studentInfo" action="estiloProfesor.php" method="post">
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
                                        <div class="input-group-text"><i class="fa fa-birthday-cake text-info"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="ProfEdad" name="ProfEdad" placeholder="Edad" required disabled>
                                    <select class="form-control" id="ProfEdad" name="ProfEdad">
                                        <option value="1">Menor o igual a 30 años</option>
                                        <option value="2">Mayor que 30, pero menor o igual a 55 años</option>
                                        <option value="3">Mayor a 55 años</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-venus-mars text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="Sexo" name="Sexo" placeholder="Sexo" disabled>
                                        <select class="form-control" id="Sexo" name="Sexo">
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                            <option value="NA">Prefiero no decir</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-question text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="Autoevaluacion" name="Autoevaluacion" placeholder="Autoevaluacion impartiendo" disabled>
                                        <select class="form-control" id="Autoevaluacion" name="Autoevaluacion">
                                            <option value="B">Principiante</option>
                                            <option value="I">Intermedio</option>
                                            <option value="A">Avanzado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-sort-numeric-asc text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="CantidadImpartido" name="CantidadImpartido" placeholder="Veces impartidas" disabled>
                                        <select class="form-control" id="CantidadImpartido" name="CantidadImpartido">
                                            <option value="1">Nunca</option>
                                            <option value="2">De 1 a 5 veces</option>
                                            <option value="3">Mas de 5 veces</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-vcard text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="Especializacion" name="Especializacion" placeholder="Disciplina o especialización" disabled>
                                        <select class="form-control" id="Especializacion" name="Especializacion">
                                            <option value="DM">Toma de decisiones</option>
                                            <option value="ND">Diseño de redes</option>
                                            <option value="O">Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-laptop text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="HabilidadComp" name="HabilidadComp" placeholder="Habilidad utilizando PC" disabled>
                                        <select class="form-control" id="HabilidadComp" name="HabilidadComp">
                                            <option value="L">Baja</option>
                                            <option value="A">Media</option>
                                            <option value="H">Alta</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-microchip text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="WebProf" name="WebProf" placeholder="Utiliza web para enseñanza" disabled>
                                        <select class="form-control" id="WebProf" name="WebProf">
                                            <option value="N">Nunca</option>
                                            <option value="S">A veces</option>
                                            <option value="O">Con frecuencia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-code text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="Ensenanza" name="Ensenanza" placeholder="Utiliza sitios web" disabled>
                                        <select class="form-control" id="Ensenanza" name="Ensenanza">
                                            <option value="N">Nunca</option>
                                            <option value="S">A veces</option>
                                            <option value="O">Con frecuencia</option>
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
                                            <div class="input-group-text"><i class="fa fa-users text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Tipo de profesor" disabled value=<?php echo (isset($tipoProfesor)) ? $tipoProfesor : ''; ?>>
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