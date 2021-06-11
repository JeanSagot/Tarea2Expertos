<!----------------------------------------------------------------------PHP----------------------------------------------------------------------------->
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

    $estiloAprendizaje = "";

    //Prior probability
    $priorPAC = 0.1818181818;
    $priorPAS = 0.2727272727;
    $priorPCO = 0.2727272727;
    $priorPDI = 0.2727272727;

    //variables del usuario
    $ecInput = (int)$_POST["c5"] + (int)$_POST["c9"] + (int)$_POST["c13"] + (int)$_POST["c17"] + (int)$_POST["c25"] + (int)$_POST["c29"];
    $orInput = (int)$_POST["c2"] + (int)$_POST["c10"] + (int)$_POST["c22"] + (int)$_POST["c26"] + (int) $_POST["c30"] + (int)$_POST["c34"];
    $caInput = (int)$_POST["c7"] + (int)$_POST["c11"] + (int)$_POST["c15"] + (int)$_POST["c19"] + (int) $_POST["c31"] + (int)$_POST["c35"];
    $eaInput = (int)$_POST["c4"] + (int)$_POST["c12"] + (int)$_POST["c24"] + (int)$_POST["c28"] + (int)$_POST["c32"] + (int)$_POST["c36"];


    //variables ASIMILADOR de base de datos
    $resultcaASDB = mysqli_query($connection, "SELECT ca_probabilidadAS FROM probabilidad_estiloII WHERE caAS = '$caInput'");
    $fetchcaASDB =   mysqli_fetch_array($resultcaASDB);
    $caASDB = $fetchcaASDB['ca_probabilidadAS'];

    $resultecASDB = mysqli_query($connection, "SELECT ec_probabilidadAS FROM probabilidad_estiloII  WHERE ecAS = '$ecInput'");
    $fetchecASDB =   mysqli_fetch_array($resultecASDB);
    $ecASDB = $fetchecASDB['ec_probabilidadAS'];

    $resulteaASDB = mysqli_query($connection, "SELECT ea_probabilidadAS FROM probabilidad_estiloII WHERE eaAS = '$eaInput'");
    $fetcheaASDB =   mysqli_fetch_array($resulteaASDB);
    $eaASDB = $fetcheaASDB['ea_probabilidadAS'];

    $resultorASDB = mysqli_query($connection, "SELECT or_probabilidadAS FROM probabilidad_estiloII  WHERE orAS = '$orInput'");
    $fetchorASDB =   mysqli_fetch_array($resultorASDB);
    $orASDB = $fetchorASDB['or_probabilidadAS'];


    //variables ACOMODADOR de base de datos
    $resultcaACDB = mysqli_query($connection, "SELECT ca_probabilidadAC FROM probabilidad_estiloII WHERE caAC = '$caInput'");
    $fetchcaACDB =   mysqli_fetch_array($resultcaACDB);
    $caACDB = $fetchcaACDB['ca_probabilidadAC'];

    $resultecACDB = mysqli_query($connection, "SELECT ec_probabilidadAC FROM probabilidad_estiloII  WHERE ecAC = '$ecInput'");
    $fetchecACDB =   mysqli_fetch_array($resultecACDB);
    $ecACDB = $fetchecACDB['ec_probabilidadAC'];

    $resulteaACDB = mysqli_query($connection, "SELECT ea_probabilidadAC FROM probabilidad_estiloII WHERE eaAC = '$eaInput'");
    $fetcheaACDB =   mysqli_fetch_array($resulteaACDB);
    $eaACDB = $fetcheaACDB['ea_probabilidadAC'];

    $resultorACDB = mysqli_query($connection, "SELECT or_probabilidadAC FROM probabilidad_estiloII  WHERE orAC = '$orInput'");
    $fetchorACDB =   mysqli_fetch_array($resultorACDB);
    $orACDB = $fetchorACDB['or_probabilidadAC'];


    //variables DIVERGENTE de base de datos
    $resultcaDIDB = mysqli_query($connection, "SELECT ca_probabilidadDI FROM probabilidad_estiloII WHERE caDI = '$caInput'");
    $fetchcaDIDB =   mysqli_fetch_array($resultcaDIDB);
    $caDIDB = $fetchcaDIDB['ca_probabilidadDI'];

    $resultecDIDB = mysqli_query($connection, "SELECT ec_probabilidadDI FROM probabilidad_estiloII  WHERE ecDI = '$ecInput'");
    $fetchecDIDB =   mysqli_fetch_array($resultecDIDB);
    $ecDIDB = $fetchecDIDB['ec_probabilidadDI'];

    $resulteaDIDB = mysqli_query($connection, "SELECT ea_probabilidadDI FROM probabilidad_estiloII WHERE eaDI = '$eaInput'");
    $fetcheaDIDB =   mysqli_fetch_array($resulteaDIDB);
    $eaDIDB = $fetcheaDIDB['ea_probabilidadDI'];

    $resultorDIDB = mysqli_query($connection, "SELECT or_probabilidadDI FROM probabilidad_estiloII  WHERE orDI = '$orInput'");
    $fetchorDIDB =   mysqli_fetch_array($resultorDIDB);
    $orDIDB = $fetchorDIDB['or_probabilidadDI'];


    //variables CONVERGENTE de base de datos
    $resultcaCODB = mysqli_query($connection, "SELECT ca_probabilidadCO FROM probabilidad_estiloII WHERE caCO = '$caInput'");
    $fetchcaCODB =   mysqli_fetch_array($resultcaCODB);
    $caCODB = $fetchcaCODB['ca_probabilidadCO'];

    $resultecCODB = mysqli_query($connection, "SELECT ec_probabilidadCO FROM probabilidad_estiloII  WHERE ecCO = '$ecInput'");
    $fetchecCODB =   mysqli_fetch_array($resultecCODB);
    $ecCODB = $fetchecCODB['ec_probabilidadCO'];

    $resulteaCODB = mysqli_query($connection, "SELECT ea_probabilidadCO FROM probabilidad_estiloII WHERE eaCO = '$eaInput'");
    $fetcheaCODB =   mysqli_fetch_array($resulteaCODB);
    $eaCODB = $fetcheaCODB['ea_probabilidadCO'];

    $resultorCODB = mysqli_query($connection, "SELECT or_probabilidadCO FROM probabilidad_estiloII  WHERE orCO = '$orInput'");
    $fetchorCODB =   mysqli_fetch_array($resultorCODB);
    $orCODB = $fetchorCODB['or_probabilidadCO'];


    //Obtenemos la probabilidad para cada categoria que se quiere encontrar
    $probabilidadAsimilador= $caASDB * $ecASDB * $eaASDB * $orASDB * $priorPAS ;
    $probabilidadAcomodador = $caACDB * $ecACDB * $eaACDB * $orACDB * $priorPAC;
    $probabilidadDivergente = $caDIDB * $ecDIDB * $eaDIDB * $orDIDB * $priorPDI;
    $probabilidadConvergente = $caCODB * $ecCODB * $eaCODB * $orCODB * $priorPCO;

    //Se encuentra el estilo segun los resultados que se obtuviero anteriormente
    if($probabilidadAsimilador > $probabilidadAcomodador && $probabilidadAsimilador > $probabilidadDivergente &&
    $probabilidadAsimilador > $probabilidadConvergente){
        $estiloAprendizaje= "Asimilador";

    }else if($probabilidadAcomodador > $probabilidadAsimilador && $probabilidadAcomodador > $probabilidadDivergente && 
    $probabilidadAcomodador > $probabilidadConvergente){
        $estiloAprendizaje = "Acomodador";

    }else if($probabilidadDivergente > $probabilidadAsimilador && $probabilidadDivergente > $probabilidadAcomodador && 
    $probabilidadDivergente > $probabilidadConvergente){
        $estiloAprendizaje = "Divergente";

    }else if($probabilidadConvergente > $probabilidadAsimilador && $probabilidadConvergente > $probabilidadAcomodador &&
    $probabilidadConvergente > $probabilidadDivergente){
        $estiloAprendizaje = "Convergente";
    }

    echo "<font size='3'><b>Resultado: $probabilidadAsimilador * $probabilidadAcomodador * $probabilidadDivergente * $probabilidadConvergente </b></font>";
}
?>
<!----------------------------------------------------------------------END PHP----------------------------------------------------------------------------->

<!----------------------------------------------------------------------HTML----------------------------------------------------------------------------->
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
    <div class="container-fluid textDiv">
        <div class="row">
            <div>

                <p class="redText">
                    <b>CUAL ES SU ESTILO DE APRENDIZAJE?</b>
                </p>

                <p>
                    <b>Instrucciones:</b>
                    <br>
                    Para utilizar el instrumento usted debe conceder una calificación alta a
                    aquellas palabras que mejor caracterizan la forma en que usted aprende,
                    y una calificación baja a las palabras que menos caracterizan su estilo
                    de aprendizaje.
                </p>

                <p>
                    Le puede ser difícil seleccionar las palabras que mejor describen su estilo
                    de aprendizaje, ya que no hay respuestas correctas o incorrectas.</p>

                <p>
                    Todas las respuestas son buenas, ya que el fin del instrumento es describir
                    cómo y no juzgar su habilidad para aprender.
                </p>

                <p>
                    De inmediato encontrará nueve series o líneas de cuatro palabras cada una.
                    Ordene de mayor a menor cada serie o juego de cuatro palabras que hay en cada línea,
                    ubicando 4 en la palabra que mejor caracteriza su estilo de aprendizaje, un 3 en la
                    palabra siguiente en cuanto a la correspondencia con su estilo; a la siguiente un 2,
                    y un 1 a la palabra que menos caracteriza su estilo. Tenga cuidado de ubicar un número
                    distinto al lado de cada palabra en la misma línea.
                </p>

                <p class="redText">
                    <b>
                        No olvide escribir su CARNET, seleccionar género y recinto y hacer click en los botones
                        CALCULAR, para que vea el resultado, y en el botón ENVIAR para guardarlo...
                        Mil gracias !</b>
                </p>
            </div>

            <br>
            <h3>Yo aprendo...</h3>
        </div>
    </div>
    <!-- END Information text-->

    <!-- Learning form -->
    <div class="container-fluid">
        <div class="row">
            <form class="learningForm" action="estiloAprendizaje.php" method="post">
                <table class="table table-dark table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <select name="c1">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Discerniendo
                            </td>
                            <td>
                                <select name="c2">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Ensayando
                            </td>
                            <td>
                                <select name="c3">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Involucrándome
                            </td>
                            <td>
                                <select name="c4">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Practicando
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="c5">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Receptivamente
                            </td>
                            <td>
                                <select name="c6">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Relacionando
                            </td>
                            <td>
                                <select name="c7">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Analíticamente
                            </td>
                            <td>
                                <select name="c8">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Imparcialmente
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="c9">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Sintiendo
                            </td>
                            <td>
                                <select name="c10">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Observando
                            </td>
                            <td>
                                <select name="c11">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Pensando
                            </td>
                            <td>
                                <select name="c12">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Haciendo
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="c13">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Aceptando
                            </td>
                            <td>
                                <select name="c14">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Arriesgando
                            </td>
                            <td>
                                <select name="c15">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Evaluando
                            </td>
                            <td>
                                <select name="c16">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Con cautela
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="c17">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Intuitivamente
                            </td>
                            <td>
                                <select name="c18">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Productivamente
                            </td>
                            <td>
                                <select name="c19">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Lógicamente
                            </td>
                            <td>
                                <select name="c20">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Cuestionando
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="c21">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Abstracto
                            </td>
                            <td>
                                <select name="c22">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Observando
                            </td>
                            <td>
                                <select name="c23">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Concreto
                            </td>
                            <td>
                                <select name="c24">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Activo
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="c25">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Orientado al presente
                            </td>
                            <td>
                                <select name="c26">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Reflexivamente
                            </td>
                            <td>
                                <select name="c27">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Orientado hacia el futuro
                            </td>
                            <td>
                                <select name="c28">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Pragmático
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="c29">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Aprendo más de la experiencia
                            </td>
                            <td>
                                <select name="c30">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Aprendo más de la observación
                            </td>
                            <td>
                                <select name="c31">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Aprendo más de la conceptualización
                            </td>
                            <td>
                                <select name="c32">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Aprendo más de la experimentación
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="c33">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Emotivo
                            </td>
                            <td>
                                <select name="c34">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Reservado
                            </td>
                            <td>
                                <select name="c35">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Racional
                            </td>
                            <td>
                                <select name="c36">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                Abierto
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input value="CALCULAR" type="submit" class="btn-explore float-right" name="sendBtn">
        </div>
        </form>
    </div>
    <!-- END Learning form -->


    <!-- Information learning style panel-->
    <div class="container information-div">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 pb-5">
                <form name="studentInfo" action="mail.php" method="post">
                    <div class="card border-primary rounded-0">

                        <div class="card-header p-0">
                            <div class="info-panel text-white text-center py-2">
                                <h3><i class="fa fa-info-circle"></i> Su informacion</h3>
                                <p class="m-0">Este es su estilo de aprendizaje</p>
                            </div>
                        </div>

                        <div class="card-body p-2">
                            <!--Body-->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="Estilo" name="ESTILO" placeholder="Estilo" required disabled value=<?php echo (isset($estiloAprendizaje))?$estiloAprendizaje:'';?>>
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