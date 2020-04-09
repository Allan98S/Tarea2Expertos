<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Expertos</title>
<link rel="stylesheet" href="scrolling-nav.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js" ></script>	
<script src="jquery.easing.min.js"></script>	
<script src="scrolling-nav.js"></script>	
<script src="peticiones.js"></script>

</head>

<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Tarea Expertos Allan Solano B66946</a>
    </div>
    <div class="collapse navbar-collapse " id="navbarResponsive">
    <ul class="nav navbar-nav ml-auto">
    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#content1">Estilo de aprendizaje</a></li>
    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#content2">Recinto de orig&eacute;n</a></li>
    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#content3">Sexo del estudiante</a></li>
    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#content4">Estilo de aprendizaje seg&uacute;n recinto</a></li>
    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#content5">Tipo de profesor</a></li>
    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#content6">Clasificaci&oacute;n de redes</a></li>
    </ul>
    </div>
  </div>
</nav>
  
<section id="content1" class="container">
    <div class="row">  
        <p class="western" align="justify" lang="es-ES">
    <font size="3">
    <b>Estilo De Aprendizaje</b>
    </font>
</p>

<div class="col-md-12">
   Instrucciones: 
   Para utilizar el instrumento usted  debe conceder una calificación alta a aquellas palabras que mejor caracterizan la forma en que usted aprende, y una calificación baja a las palabras que menos caracterizan su estilo de aprendizaje. 
   <br></br>
   Le puede ser difícil seleccionar las palabras que mejor describen su estilo de aprendizaje, ya que no hay respuestas correctas o incorrectas.
   <br></br>
    Todas las respuestas son buenas, ya que el fin del instrumento es describir cómo y no juzgar su habilidad para aprender.  
    <br></br>
    De inmediato encontrará nueve series o líneas de cuatro palabras cada una. Ordene de mayor a menor cada serie o juego de cuatro palabras que hay en cada línea, ubicando 4 en la palabra que mejor caracteriza su estilo de aprendizaje, un 3 en la palabra siguiente en cuanto a la correspondencia con su estilo; a la siguiente un 2, y un 1 a la palabra que menos caracteriza su estilo. Tenga cuidado de ubicar un número distinto al lado de cada palabra en la misma línea. 
</div>

<br>
<form  id="form_estilo" action="adivinarEstilo.php" method="get">
  <table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c1" name="c1">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
discerniendo<br>
        </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c2" name="c2"> 
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
ensayando<br>
        </td>
        <td style="vertical-align: top;">
        <select id="c3" name="c3">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
involucrándome</td>
        <td style="vertical-align: top;">
        <select id="c4" name="c4">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
practicando</td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c5" name="c5">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
receptivamente </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c6" name="c6">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
relacionando </td>
        <td style="vertical-align: top;">
        <select id="c7" name="c7">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
analíticamente </td>
        <td style="vertical-align: top;">
        <select id="c8" name="c8">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
imparcialmente </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c9" name="c9">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
sintiendo </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c10" name="c10">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
observando </td>
        <td style="vertical-align: top;">
        <select id="c11"  name="c11">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
pensando </td>
        <td style="vertical-align: top;">
        <select id="c12" name="c12">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
haciendo </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c13" name="c13">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aceptando </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c14" name="c14">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
arriesgando </td>
        <td style="vertical-align: top;">
        <select id="c15" name="c15">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
evaluando </td>
        <td style="vertical-align: top;">
        <select id="c16" name="c16">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
con cautela </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c17" name="c17">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
intuitivamente </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c18" name="c18">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
productivamente </td>
        <td style="vertical-align: top;">
        <select id="c19" name="c19">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
lógicamente </td>
        <td style="vertical-align: top;">
        <select id="c20" name="c20">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
cuestionando </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c21" name="c21">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
abstracto </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c22" name="c22">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
observando </td>
        <td style="vertical-align: top;">
        <select id="c23" name="c23">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
concreto </td>
        <td style="vertical-align: top;">
        <select id="c24" name="c24">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
activo </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c25" name="c25">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
orientado al presente </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c26" name="c26">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
reflexivamente </td>
        <td style="vertical-align: top;">
        <select id="c27" name="c27">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
orientado hacia el futuro </td>
        <td style="vertical-align: top;">
        <select id="c28" name="c28">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
pragmático </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c29" name="c29">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la experiencia </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c30" name="c30">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la observación </td>
        <td style="vertical-align: top;">
        <select id="c31" name="c31">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la conceptualización </td>
        <td style="vertical-align: top;">
        <select id="c32" name="c32">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la experimentación </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c33" name="c33">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
emotivo </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c34"name="c34">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
reservado </td>
        <td style="vertical-align: top;">
        <select id="c35" name="c35">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
racional </td>
        <td style="vertical-align: top;">
        <select id="c36" name="c36">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
abierto </td>
      </tr>

    </tbody>
  </table>
  <br>
  <input type="submit" value="Calcular " name="boton" id='boton'/>

</form>
Su estilo:<div id="adivinarEstiloFinal"></div>
</div>
</section>

<section id="content2" class=container>
<div class="row">  
        <p class="western" align="justify" lang="es-ES">
    <font size="3">
 
    <b>Adivinar el recinto de origen de estudiante</b>
    </font>
</p>

<div class="col-md-12">
   1.Seleccione su estilo de aprendizaje (divergente,convergente,asimilador,acomodador)
   <br></br>
   2.Digite su &uacute;ltimo promedio para matr&iacute;cula
   <br></br>
   3.Seleccione su sexo (Masculino,Femenino)   
</div>

<form id="form_recinto" action="recintoOrigen.php" method="get">
        <table><tr>
          <td>
           Estilo de aprendizaje:</td><td>
           <select id="estilo_aprendizaje" name="estilo_aprendizaje" style='width:100%;'>
                        <option value="ACOMODADOR">Acomodador</option>
                        <option value="DIVERGENTE">Divergente</option>
                        <option value="CONVERGENTE">Convergente</option>
                        <option value="ASIMILADOR">Asimilador</option>
                    </select>
           
           </td></tr>
           <tr>
             <td>Promedio ponderado: </td>
             <td><input type="number"  step="0.01" min="0" max="10"  required name="promedio" id="promedio"></td>
           </tr>
           <tr>
           <tr>
             <td> Sexo </td><td>
             <select id="sexo" name="sexo" style='width:100%;'>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
             </td></tr>
         
           <tr><td colspan="2"> <input type="submit" name="boton" id="boton" value="Adivinar Recinto">
        </td></tr></table>
        </form>

</div>
Su recinto:<div id="recintoFinal"></div>

</section>
<section id="content3" class=container>
<div class="row">  
        <p class="western" align="justify" lang="es-ES">
    <font size="3">
 
    <b>Adivinar el sexo del estudiante</b>
    </font>
</p>

<div class="col-md-12">
   1.Seleccione su estilo de aprendizaje (divergente,convergente,asimilador,acomodador)
   <br></br>
   2.Digite su &uacute;ltimo promedio para matr&iacute;cula
   <br></br>
   3.Seleccione su recinto (Turrialba,Para&iacute;so)   
</div>
<form id="form_sexo" action="sexoEstudiante.php" method="get">
        <table><tr>
          <td>
           Estilo de aprendizaje:</td><td>
           <select id="form_two_style" id="estilo_aprendizaje" name="estilo_aprendizaje" style='width:100%;'>
                        <option value="ACOMODADOR">Acomodador</option>
                        <option value="DIVERGENTE">Divergente</option>
                        <option value="CONVERGENTE">Convergente</option>
                        <option value="ASIMILADOR">Asimilador</option>
                    </select>
           
           </td></tr>
           <tr>
             <td>Promedio ponderado: </td>
             <td><input type="number"  step="0.01" min="0" max="10" required name="promedio" id="promedio"></td>
           </tr>
           <tr>
           <tr>
             <td> Recinto </td><td>
             <select id="recinto" name="recinto" style='width:100%;'>
                        <option value="Paraiso">Para&iacute;so</option>
                        <option value="Turrialba">Turrialba</option>
                    </select>
             </td></tr>
         
           <tr><td colspan="2"> <input type="submit" name="enviando" value="Adivinar Sexo">
        </td></tr></table>
        </form>

</div>
Su sexo:<div id="sexoFinal"></div>

</section>
<section id="content4" class=container>
<div class="row">  
        <p class="western" align="justify" lang="es-ES">
    <font size="3">
 
    <b>Adivinar el estilo de aprendizaje</b>
    </font>
</p>

<div class="col-md-12">
   1.Seleccione su recinto (Turrialba,Para&iacute;so)   
   <br></br>
   2.Digite su &uacute;ltimo promedio para matr&iacute;cula
   <br></br>
   3.Seleccione su sexo (Masculino,Femenino)   
</div>
<form id="form_estilo_aprendizaje" action="pagina_insertar_pdo.php" method="post">
        <table><tr>
        <td> Recinto </td><td>
             <select id="recinto" name="recinto" style='width:100%;'>
                        <option value="Paraiso">Para&iacute;so</option>
                        <option value="Turrialba">Turrialba</option>
                    </select>
             </td></tr>
           <tr>
             <td>Promedio ponderado: </td>
             <td><input type="number" step="0.01" min="0" max="10" required name="promedio" id="promedio"></td>
           </tr>
           <tr>
           <tr>
             <td> Sexo </td><td>
             <select id="sexo" name="sexo" style='width:100%;'>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
             </td></tr>
         
           <tr><td colspan="2"> <input type="submit" name="enviando" value="Adivinar Estilo Aprendizaje">
        </td></tr></table>
        </form>

</div>
Su estilo de aprendizaje es: <div id="estiloFinal"></div>
</section>

<section id="content5" class=container>
<div class="row">  
        <p class="western" align="justify" lang="es-ES">
    <font size="3">
 
    <b>Determinar  el tipo de profesor</b>
    </font>
</p>

<div class="col-md-12">
   1.Seleccione su edad   
   <br></br>
   2.Seleccione su g&eacute;nero
   <br></br>
   3.Seleccione su nivel de autoevaluaci&oacute;n
   <br></br>
   4.N&uacute;mero de veces que ha dado el curso
   <br></br>
   5.&Aacute;rea de conocimiento
   <br></br>
   6.Habilidad usando computadoras
   <br></br>
   7.Experiencia usando herramientas web para ense&ntilde;ar
   <br></br>
   8. Experiencia usando p&aacute;ginas web
</div>
<form id="form_profesor" name="form_profesor" action="profesor.php" method="get">
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
        <tbody>
            <tr>
                <td style="vertical-align: top; width: 25%;">
                    <select id="form_six_age" id="edad" name="edad">
                        <option value="1"><= 30</option>
                        <option value="2">> 30 AND <= 55</option>
                        <option value="3">> 55</option>
                    </select>
                    Edad<br>
                </td>
                <td style="vertical-align: top; width: 25%;">
                    <select id="genero" name="genero">
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                        <option value="NA">No disponible</option>
                    </select>
                    G&eacute;nero<br>
                </td>
                <td style="vertical-align: top;">
                    <select id="autoEvaluacion" name="autoEvaluacion">
                        <option value="B">Principiante</option>
                        <option value="I">Intermedio</option>
                        <option value="A">Avanzado</option>
                    </select>
                    Autoevaluaci&oacute;n</td>
                <td style="vertical-align: top;">
                    <select id="numeroCursoEnsenado" name="numeroCursoEnsenado">
                        <option value="1">Nunca</option>
                        <option value="2">De 1 a 5 veces</option>
                        <option value="3">M&aacute;s de 5 veces</option>
                    </select>
                    Veces que ha dado el curso
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; width: 25%;">
                    <select id="areaConocimiento" name="areaConocimiento">
                        <option value="DM">Toma de decisiones</option>
                        <option value="ND">Diseño de red</option>
                        <option value="O">Otro</option>
                    </select>
                    &Aacute;rea de especializaci&oacute;n<br>
                </td>
                <td style="vertical-align: top; width: 25%;">
                    <select id="habilidadComputadora" name="habilidadComputadora">
                        <option value="L">Baja</option>
                        <option value="A">Promedio</option>
                        <option value="H">Alta</option>
                    </select>
                    Habilidades para el uso de computadoras<br>
                </td>
                <td style="vertical-align: top;">
                    <select id="habilidadTecnologias" name="habilidadTecnologias">
                        <option value="N">Ninguna</option>
                        <option value="S">A veces</option>
                        <option value="O">A menudo</option>
                    </select> 
                    Habilidades utilizando tecnolog&iacute;a basada en la web para la ense&ncaron;anza</td>
                <td style="vertical-align: top;">
                    <select id="habilidadesSitioWeb"name="habilidadesSitioWeb">
                        <option value="N">Ninguna</option>
                        <option value="S">A veces</option>
                        <option value="O">A menudo</option>
                    </select>
                    Utilizaci&oacute;n de sitios web
                </td>
            </tr>
        </tbody>
    </table>
    <input type="submit" name="enviando" value="Determinar tipo de profesor">
        </form>

</div>
Tipo de profesor:  <div id="profesorFinal"></div>
</section>

<section id="content6" class=container>
<div class="row">  
        <p class="western" align="justify" lang="es-ES">
    <font size="3">
 
    <b>Clasificaci&oacute;n en redes</b>
    </font>
</p>

<div class="col-md-12">
   1.Seleccione su confibialidad en redes    
   <br></br>
   2.Seleccione el n&uacute;mero de enlaces
   <br></br>
   3.Seleccione la capacidad total de la red
   <br></br>
   4.Seleccione el costo de la red
</div>
<form  id="form_redes" name="form_redes" action="clasificacionRedes.php" method="get">
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
        <tbody>
            <tr>
                <td style="vertical-align: top; width: 25%;">
                    Confiabilidad
                    <select id="confiabilidad" name="confiabilidad">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </td>
                <td style="vertical-align: top; width: 25%;">
                N&uacute;mero de enlaces
                <input id="numeroEnlaces"  name="numeroEnlaces" value="0" type="number"  required/>
                </td>
                <td style="vertical-align: top;">
                Capacidad
                    <select id="capacidad" name="capacidad">
                        <option value="Low">Baja</option>
                        <option value="Medium">Media</option>
                        <option value="High">Alta</option>
                    </select>
                   </td>
                  
                <td style="vertical-align: top;">
                Costo
                    <select id="costo" name="costo">
                        <option value="Low">Baja</option>
                        <option value="Medium">Media</option>
                        <option value="High">Alta</option>
                    </select>
                   </td>
            </tr>
        </tbody>
    </table>
    <input type="submit" name="enviando" value="Determinar Capacidad">

        </form>

</div>
Capacidad: <div id="redFinal"></div>
</section>
</html>