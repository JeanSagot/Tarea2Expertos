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

    $tipoRed= "";

    //Prior probability
    $priorA = 0.4571428571;
    $priorB = 0.5428571429;

    //variables del usuario
    $fiabilidadInput = $_POST["Fiabilidad"];
    $enlacesInput = $_POST["Enlaces"];
    $capacidadInput = $_POST["Capacidad"];
    $costoInput = $_POST["Costo"];
    
    //variables categoria A de base de datos
    $resultfiabilidadADB = mysqli_query($connection, "SELECT probabilidad_reliabilityA FROM  probabilidad_redes WHERE reliabilityA = '$fiabilidadInput'");
    $fetchfiablidadADB =   mysqli_fetch_array($resultfiabilidadADB);
    $fiablidadADB = $fetchfiablidadADB['probabilidad_reliabilityA'];

    $resultenlacesADB = mysqli_query($connection, "SELECT probabilidad_linksA FROM  probabilidad_redes WHERE linksA = '$enlacesInput'");
    $fetchenlacesADB =   mysqli_fetch_array($resultenlacesADB);
    $enlacesADB = $fetchenlacesADB['probabilidad_linksA'];

    $resultcapacidadADB = mysqli_query($connection, "SELECT probabilidad_capacityA FROM  probabilidad_redes WHERE capacityA = '$capacidadInput'");
    $fetchcapacidadADB =   mysqli_fetch_array($resultcapacidadADB);
    $capacidadADB = $fetchcapacidadADB['probabilidad_capacityA'];

    $resultcostoADB = mysqli_query($connection, "SELECT probabilidad_costoA FROM  probabilidad_redes WHERE costoA = '$costoInput'");
    $fetchcostoADB =   mysqli_fetch_array($resultcostoADB);
    $costoADB = $fetchcostoADB['probabilidad_costoA'];

    //variables categoria B de base de datos
    $resultfiabilidadBDB = mysqli_query($connection, "SELECT probabilidad_reliabilityB FROM  probabilidad_redes WHERE reliabilityB = '$fiabilidadInput'");
    $fetchfiablidadBDB =   mysqli_fetch_array($resultfiabilidadBDB);
    $fiablidadBDB = $fetchfiablidadBDB['probabilidad_reliabilityB'];

    $resultenlacesBDB = mysqli_query($connection, "SELECT probabilidad_linksB FROM  probabilidad_redes WHERE linksB = '$enlacesInput'");
    $fetchenlacesBDB =   mysqli_fetch_array($resultenlacesBDB);
    $enlacesBDB = $fetchenlacesBDB['probabilidad_linksB'];

    $resultcapacidadBDB = mysqli_query($connection, "SELECT probabilidad_capacityB FROM  probabilidad_redes WHERE capacityB = '$capacidadInput'");
    $fetchcapacidadBDB =   mysqli_fetch_array($resultcapacidadBDB);
    $capacidadBDB = $fetchcapacidadBDB['probabilidad_capacityB'];

    $resultcostoBDB = mysqli_query($connection, "SELECT probabilidad_costoB FROM  probabilidad_redes WHERE costoB = '$costoInput'");
    $fetchcostoBDB =   mysqli_fetch_array($resultcostoBDB);
    $costoBDB = $fetchcostoBDB['probabilidad_costoB'];

    //Obtenemos la probabilidad para cada categoria que se quiere encontrar
    $probabilidadA = $fiablidadADB * $enlacesADB * $capacidadADB * $costoADB * $priorA ;
    $probabilidadB = $fiablidadBDB * $enlacesBDB * $capacidadBDB * $costoBDB * $priorB ;

    //Se encuentra el estilo segun los resultados que se obtuviero anteriormente
    if($probabilidadA > $probabilidadB){
        $tipoRed = "A";
    }else{
        $tipoRed = "B";
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
                    <b>Adivine el tipo de red</b>
                </h1>

                <p>
                    <b>Instrucciones:</b>
                    <br>
                    Podra adivinar el tipo de red, si es clase A o B:
                </p>
                <p>
                    Fiabilidad, de 2 a 5
                </p>
                <p>
                    El numero de links, 7 a 20
                </p>
                <p>
                    La Capacidad total de la red, baja-media-alta
                </p>
                <p>
                    El coste de la red, baja-media-alta
                </p>
            </div>
        </div>
    </div>
    <!-- END Information text-->

    <!-- Information learning style panel-->
    <div class="container information-div">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 pb-5">
                <form name="studentInfo" action="estiloRedes.php" method="post">
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
                                            <div class="input-group-text"><i class="fa fa-chain-broken text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="Fiabilidad" name="Fiabilidad" placeholder="Fiabilidad" disabled>
                                        <select class="form-control" id="Fiabilidad" name="Fiabilidad">
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-link text-info"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="Enlaces" name="Enlaces" placeholder="Número de Enlaces" disabled>
                                            <select class="form-control" id="Enlaces" name="Enlaces">
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-archive text-info"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="Capacidad" name="Capacidad" placeholder="Capacidad" disabled>
                                                <select class="form-control" id="Capacidad" name="Capacidad">
                                                    <option value="Low">Baja</option>
                                                    <option value="Medium">Media</option>
                                                    <option value="High">Alta</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-archive text-info"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="Costo" name="Costo" placeholder="Costo" disabled>
                                                <select class="form-control" id="Costo" name="Costo">
                                                    <option value="Low">Baja</option>
                                                    <option value="Medium">Media</option>
                                                    <option value="High">Alta</option>
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
                                                    <div class="input-group-text"><i class="fa fa-linode text-info"></i></div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Tipo de red" disabled value=<?php echo (isset($tipoRed)) ? $tipoRed : ''; ?>>
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