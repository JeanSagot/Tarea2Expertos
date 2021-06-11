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

    $tipoEstilo = "";

    //Prior probability
    $priorAS = 0.2727272727;
    $priorAC = 0.1818181818;
    $priorDI = 0.2727272727;
    $priorCO = 0.2727272727;

    //variables del usuario
    $sexoInput = $_POST["Sexo"];
    $promedioInput = $_POST["Promedio"];
    $recintoInput = $_POST["Recinto"];

    //variables ASIMILADOR de base de datos
    $resultsexoASDB = mysqli_query($connection, "SELECT sexo_probabilidadAS FROM probabilidad_estilo WHERE sexoAS = '$sexoInput'");
    $fetchsexoASDB =   mysqli_fetch_array($resultsexoASDB);
    $sexoASDB = $fetchsexoASDB['sexo_probabilidadAS'];

    $resultpromedioASDB = mysqli_query($connection,"SELECT promedio_probabilidadAS FROM probabilidad_estilo WHERE promedioAS = CAST( $promedioInput AS DECIMAL) ");
    $fetchpromedioASDB =   mysqli_fetch_array($resultpromedioASDB);
    $promedioASDB = $fetchpromedioASDB['promedio_probabilidadAS'];

    $resultrecintoASDB = mysqli_query($connection, "SELECT recinto_probabilidadAS FROM  probabilidad_estilo WHERE recintoAS = '$recintoInput'");
    $fetchrecintoASDB =   mysqli_fetch_array($resultrecintoASDB);
    $recintoASDB = $fetchrecintoASDB['recinto_probabilidadAS'];

    //variables ACOMODADOR de base de datos
    $resultsexoACDB = mysqli_query($connection, "SELECT sexo_probabilidadAC FROM  probabilidad_estilo WHERE sexoAC = '$sexoInput'");
    $fetchsexoACDB =   mysqli_fetch_array($resultsexoACDB);
    $sexoACDB = $fetchsexoACDB['sexo_probabilidadAC'];

    $resultpromedioACDB = mysqli_query($connection,"SELECT promedio_probabilidadAC FROM  probabilidad_estilo WHERE promedioAC = CAST( $promedioInput AS DECIMAL) ");
    $fetchpromedioACDB =   mysqli_fetch_array($resultpromedioACDB);
    $promedioACDB = $fetchpromedioACDB['promedio_probabilidadAC'];

    $resultrecintoACDB = mysqli_query($connection,"SELECT recinto_probabilidadAC FROM  probabilidad_estilo WHERE recintoAC = '$recintoInput'");
    $fetchrecintoACDB =   mysqli_fetch_array($resultrecintoACDB);
    $recintoACDB = $fetchrecintoACDB['recinto_probabilidadAC'];

    //variables DIVERGENTE de base de datos
    $resultsexoDIDB = mysqli_query($connection,"SELECT sexo_probabilidadDI FROM  probabilidad_estilo WHERE sexoDI = '$sexoInput'");
    $fetchsexoDIDB =   mysqli_fetch_array($resultsexoDIDB);
    $sexoDIDB = $fetchsexoDIDB['sexo_probabilidadDI'];

    $resultpromedioDIDB = mysqli_query($connection,"SELECT promedio_probabilidadDI FROM  probabilidad_estilo WHERE promedioDI = CAST( $promedioInput AS DECIMAL) ");
    $fetchpromedioDIDB =   mysqli_fetch_array($resultpromedioDIDB);
    $promedioDIDB = $fetchpromedioDIDB['promedio_probabilidadDI'];

    $resultrecintoDIDB = mysqli_query($connection,"SELECT recinto_probabilidadDI FROM  probabilidad_estilo WHERE recintoDI = '$recintoInput'");
    $fetchrecintoDIDB =   mysqli_fetch_array($resultrecintoDIDB);
    $recintoDIDB = $fetchrecintoDIDB['recinto_probabilidadDI'];

    //variables CONVERGENTE de base de datos
    $resultsexoCODB = mysqli_query($connection,"SELECT sexo_probabilidadCO FROM  probabilidad_estilo WHERE sexoCO = '$sexoInput'");
    $fetchsexoCODB =   mysqli_fetch_array($resultsexoCODB);
    $sexoCODB = $fetchsexoCODB['sexo_probabilidadCO'];
    
    $resultpromedioCODB = mysqli_query($connection,"SELECT promedio_probabilidadCO FROM  probabilidad_estilo WHERE promedioCO = CAST( $promedioInput AS DECIMAL) ");
    $fetchpromedioCODB =   mysqli_fetch_array($resultpromedioCODB);
    $promedioCODB = $fetchpromedioCODB['promedio_probabilidadCO'];

    $resultrecintoCODB = mysqli_query($connection,"SELECT recinto_probabilidadCO FROM  probabilidad_estilo WHERE recintoCO = '$recintoInput'");
    $fetchrecintoCODB =   mysqli_fetch_array($resultrecintoCODB);
    $recintoCODB = $fetchrecintoCODB['recinto_probabilidadCO'];

    //Obtenemos la probabilidad para cada categoria que se quiere encontrar
    $probabilidadAsimilador  = $sexoASDB * $promedioASDB * $recintoASDB * $priorAS;
    $probabilidadAcomodador  = $sexoACDB * $promedioACDB * $recintoACDB * $priorAC;
    $probabilidadDivergente  = $sexoDIDB * $promedioDIDB * $recintoDIDB * $priorDI;
    $probabilidadConvergente = $sexoCODB * $promedioCODB * $recintoCODB * $priorCO;

    

    //Se encuentra el estilo segun los resultados que se obtuviero anteriormente
    if($probabilidadAsimilador > $probabilidadAcomodador && $probabilidadAsimilador > $probabilidadDivergente &&
    $probabilidadAsimilador > $probabilidadConvergente){
        $tipoEstilo = "Asimilador";

    }else if($probabilidadAcomodador > $probabilidadAsimilador && $probabilidadAcomodador > $probabilidadDivergente && 
    $probabilidadAcomodador > $probabilidadConvergente){
        $tipoEstilo = "Acomodador";

    }else if($probabilidadDivergente > $probabilidadAsimilador && $probabilidadDivergente > $probabilidadAcomodador && 
    $probabilidadDivergente > $probabilidadConvergente){
        $tipoEstilo = "Divergente";

    }else {
        $tipoEstilo = "Convergente";
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
                    <b>Adivine su estilo de aprendizaje 2 </b>
                </h1>

                <p>
                    <b>Instrucciones:</b>
                    <br>
                    Podra adivinar el estilo de aprendizaje de un estudiante:
                </p>
                <p>
                    Podrá seleccionar el recinto de procedencia del estudiante
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
                <form name="studentInfo" action="estiloAprendizaje2.php" method="post">
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
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-building text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="Recinto" name="recinto" placeholder="Recinto" disabled>
                                        <select class="form-control" name="Recinto">
                                            <option value="Paraiso">Paraiso</option>
                                            <option value="Turrialba">Turrialba</option>
                                        </select>
                                    </div>
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

                                <div class="card-body p-2" style="margin-top: 5%;">
                                    <!--Body-->
                                    <div class="form-group">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="Estilo" name="ESTILO" placeholder="Estilo" disabled value=<?php echo (isset($tipoEstilo)) ? $tipoEstilo : ''; ?>>
                                        </div>
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