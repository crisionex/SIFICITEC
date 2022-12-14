<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<style>
    .row {
        padding-left: 2%;
        padding-right: 10%;
        text-align: justify;
        line-height: 2;
    }

    html {
        scroll-behavior: smooth;
    }


    .list-group a {
        padding: 2%;
    }

    .list-group a:hover {
        text-decoration: none;
        background-color: #dceef7;
    }

</style>

<body>
    <?php include "menu.php"; ?>
    <div class="row">
        <div class="col-2 border-end">
            <br>
            <div class="accordion accordion-flush " id="accordionPanelsStayOpenExample">
                <div class="accordion-item border-bottom-0">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                            <strong>Introduccion</strong>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="#empecemos" class="">Empecemos</a>
                                <a href="#roles" class="">Roles</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-bottom-0">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            <strong>Funciones: Ajustes</strong>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="#conf-areas" class="">Areas</a>
                                <a href="#conf-indicadores" class="">Indicadores</a>
                                <a href="#conf-acc" class="">Mi cuenta</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-bottom-0">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            <strong>Funciones: gestion</strong>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="#gest-validacion" class="">Validaciones</a>
                                <a href="#gest-usuarios" class="">Gestion de usuarios</a>
                                <a href="#gest-permisos" class="">Permisos</a>
                                <a href="#gest-etiquetas" class="">Etiquetas</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="accordion-item border-bottom-0">
                    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                            <strong>Interfaz</strong>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                        <div class="accordion-body">
                            <div class="list-group">

                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="col">
            <br>
            <h1><strong>Sistema de indicadores FCITEC</strong></h3>
                <br>
                <div id="empecemos">
                    <p>Dentro del sistema de indicadores de la FCITEC o bien SIFCITEC tendremos diferentes ventanas opciones que nos ayudaran a la creaci??n de diferentes tablas que puedan ser visualizadas por medio de gr??ficos y generar reportes a partir de esta informaci??n.</p>
                    <p>Como es una aplicaci??n que requiere de diferentes subsistemas para ser totalmente funcional es necesario de la existencia de entidades que ayuden a realizar diferentes actividades en conjunto para poder mantener el sistema principal, estos son denominados permisos y cada entidad cuenta con mas o menos funciones seg??n sea necesario.
                        Entendemos pues que los permisos est??n denominados por lo siguiente:</p>
                    <ul>
                        <li>Lector/Consultor</li>
                        <li>Encargado de gesti??n</li>
                        <li>Jefe de ??rea</li>
                        <li>Administrador</li>
                    </ul>
                </div>
                <br>
                <div id="roles">
                    <h2>Roles</h2>

                    <p><strong>Administrador:</strong> se trata de la persona que posee el nivel m??s alto, esta se encarga de crear nuevas cuentas, as?? como de administrar las ya existentes pudiendo realizar configuraciones como el otorgar permisos (jefe de ??rea y encargado de gesti??n, roles de lo que hablaremos m??s adelante) o bien configurar par??metros como la habilitaci??n. Este puede a su vez crear tanto ??reas como gestiones y puede visualizar la informaci??n recibida con el fin de monitorear la data existente.</p>
                    <p><strong>Jefe de ??rea:</strong> la persona con este rol cuenta con m??s limitaciones que el administrador puesto que ellos no pueden visualizar a los usuarios existentes, sin embargo si pueden configurar par??metros de su cuentan tales como la contrase??a o su correo asociado. Estos usuarios pueden crear nuevos indicadores asociados ??nicamente a su ??rea establecida o asignada adem??s de poder administrar los indicadores asociados a su ??rea pudiendo configurar par??metros tales como la creaci??n, edici??n, lectura y borrado de los datos.</p>
                    <p><strong>Encargado de gesti??n: </strong>este usuario ??nicamente puede crear nuevos reportes asignados a su indicador as?? como poder editar ciertos par??metros de los mismos con el fin de dar mayor flexibilidad, sin embargo, este usuario no es capaz de crear nuevos indicadores ni de modificar informaci??n del indicador asignado, si no que solo crea reportes y genera las gr??ficas en base a la informaci??n que se ha dado.</p>
                    <p><strong>Lector/consultor:</strong>se encarga de solo visualizar la informaci??n ya actualizada por el sistema principal y es capaz de generar reportes y gr??ficos en base a esa informaci??n, esta fuera del sistema y su ??nica funci??n es el observar y confirmar que la informaci??n proporcionada por el sistema sea ver??dica.</p>
                </div>
                <h1>Funciones: Ajustes</h1>
                <br>
                <p>Una vez explicado toda la estructuraci??n del sistema principal es hora de poder explicar el como es que el sistema funciona.</p>
                <div id="conf-areas">
                    <h2>Areas</h2>

                    <p>Las ??reas son los principales pilares del sistema estos son utilizados para poder crear indicadores y m??ltiples tablas con datos que son visualizables por nuestros consultores a trav??s de los m??ltiples indicadores existentes.</p>
                    <center><img src="dist/img/areas-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Esta secci??n cuenta con diferentes campos que tienen que ser llenados por el usuario:</p>
                    <ul>
                        <li> <strong>Nombre del ??rea:</strong> Como su nombre lo indica sirve para darle un nombre al ??rea que necesitaremos.</li>
                        <li><strong>Status:</strong> nos indica el estatus con el que el indicador aparecer??, si es visible los usuarios podr??n acceder a sus indicadores y ser?? visible desde la barra.</li>
                        <li><strong>Icono:</strong> Este es un men?? interactivo que nos facilita la selecci??n de un icono que el usuario busque, como se muestra en la siguiente imagen.</li>
                    </ul>
                    <p>Por ejemplo creemos un ??rea. Esta ??rea ser?? llamada ???matricula???, tendr?? su estatus activo por defecto y utilizaremos un icono cualquiera, de modo que al introducir los datos podremos crear lo siguiente:</p>
                    <center><img src="dist/img/areas-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>En las opciones del ??rea podremos eliminarlo o bien editarlo con opciones b??sicas seg??n lo que tenemos podremos editar el nombre y el estatus:</p>
                    <center><img src="dist/img/areas-3.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
                <div id="conf-indicadores">
                    <h2>Indicadores</h2>
                    <p>Los indicadores son dependientes de las ??reas, no es posible crear un indicador sin antes haber creado un ??rea, estos son el medio por el cual se ingresa cada dato posible.</p>
                    <center><img src="dist/img/indicadores-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Para crear un indicador es necesario:</p>
                    <ul>
                        <li><strong>seleccionar el ??rea perteneciente:</strong> los administradores son capaces de crear indicadores en base a cualquier ??rea, sin embargo, los jefes de ??rea solo pueden crear indicadores en base a su ??rea a cargo.</li>
                        <li><strong>Nombre del indicador:</strong> definiremos el nombre del indicador.</li>
                        <li><strong>Columnas de la tabla:</strong> Podremos crear diferentes columnas independientes en dos modos, columnas de texto y columnas de datos numericos, algo que se vera mas a detalle en la seccion de interfaz.</li>
                    </ul>
                    <p>Creemos un indicador en base a los datos anteriormente mencionados para ejemplificar lo anterior. El indicador se llamar?? ???Comportamiento de la matricula por semestre??? y ser?? relacionado al ??rea anteriormente creada (Matricula), contar?? con 4 columnas ???programa educativo???, ???Hombres???, ???mujeres??? y ???Periodo Educativo???.</p>
                    <p>De modo que podremos visualizarlo de esta manera:</p>
                    <center><img src="dist/img/indicadores-2.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
                <div id="conf-acc">
                    <h2>Mi cuenta</h2>
                    <p>Dentro de la secci??n de mi cuenta seremos capaces de editar todos aquellos valores correspondientes a nuestra cuenta, ya sea usuario, correo o bien contrase??a, pero una vez cambiados estos atributos la cuenta se cerrar?? de manera autom??tica por seguridad y deber?? iniciar sesi??n nuevamente.</p>
                    <center><img src="dist/img/acc-1.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
                <h1>Funciones: Gestion</h1>
                <br>
                <div id="gest-validacion">
                    <h2>Validacion</h2>
                    <p>En esta secci??n se validan todos aquellos indicadores que han sido creados, esto con el fin de observar si la informaci??n ingresada por el responsable fue ingresada de manera correcta o no.</p>
                    <center><img src="dist/img/validaciones-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Cuando exista algo que validar se nos ser?? notificado por medio de una burbuja de notificaciones por lo que solo es necesario con dar clic a la secci??n.</p>
                    <center><img src="dist/img/validaciones-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Dentro de este apartado podremos visualizar todos aquellos indicadores pendientes y para visualizar la informaci??n completa del indicador daremos clic en ???detalles adicionales??? de este modo observaremos algo similar a:</p>
                    <center><img src="dist/img/validaciones-3.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>De esta manera podremos observar detalles como el responsable de la creaci??n del indicador, a que ??rea pertenece, el nombre y el numero y nombre de las columnas. Si toda la informaci??n es correcta podremos autorizar el indicador, en caso contrario rechazarlo y desaparecer?? la notificaci??n en la secci??n de ???validaciones???.</p>
                </div>
                <div id="gest-usuarios">
                    <h2>gestion de usuarios</h2>
                    <p>Debido a que es un sistema totalmente cerrado es necesario que las cuentas sean creadas de manera de manera interna, de este modo se da mas seguridad y el sistema es menos vulnerable a fallas de seguridad.</p>
                    <center><img src="dist/img/usuarios-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>El administrador es quien se encarga de crear las cuentas y para esto es necesario que se ingrese el nombre de usuario, as?? como el email asociado y contrase??a que se tendr?? para el usuario creado (esta podr?? ser cambiada despu??s de ser creada).</p>
                    <p>En la secci??n del rol asignado es donde otorgaremos los permisos del usuario, existen 3 roles disponibles dentro del sistema interno como ya hab??amos mencionado, por lo que ser?? necesario que se elija uno. En caso de elegir jefe de ??rea o bien encargado de gesti??n ser?? necesario a??adir un dato mas a un nuevo campo que ser?? el ??rea a la cual estar?? asignado:</p>
                    <center><img src="dist/img/usuarios-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Al registrar cuentas lo que aparecer?? dentro de los indicadores ser?? lo siguiente:</p>
                    <center><img src="dist/img/usuarios-3.png" class="img-fluid" alt="..."></center>
                    <br>
                    <center><img src="dist/img/usuarios-4.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Como administradores tambi??n tendremos cierto dominio sobre las cuentas, aunque limitado podremos desactivarlas/inhabilitarlas y reasignar roles en caso de ser requerido.</p>
                </div>
                <div id="gest-permisos">
                    <h2>Permisos</h2>
                    <p>Por medio de esta herramienta seremos capaces de determinar el grado de responsabilidad de cada uno de los usuarios seg??n sus permisos.</p>
                    <center><img src="dist/img/permisos-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Seg??n el usuario que seleccionemos ser?? se mostraran los indicadores del ??rea a la que le usuario pertenece (a menos que se aun administrador).</p>
                    <center><img src="dist/img/permisos-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Para este caso el permiso lo podremos poner en falso o verdadero seg??n sea requerido para el usuario seleccionado.</p>
                    <center><img src="dist/img/permisos-3.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Y con ello tenemos la visualizaci??n de este indicador:</p>
                    <center><img src="dist/img/permisos-4.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
                <div id="gest-etiquetas">
                    <h2>Etiquetas</h2>
                    <p>Etiquetas es una secci??n que esta dentro de configuraciones ya que va ligado directamente a los indicadores y las ??reas, sin embargo, es tambi??n un sistema independiente en el que se crean filtros en lo que se podr?? graficar posteriormente como un consultor de datos.</p>
                    <center><img src="dist/img/etiquetas-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Podremos observar que existen 3 campos en los que seleccionaremos datos, tendremos que seleccionar el ??rea, el indicador y la etiqueta si existe, en caso de que no exista una etiqueta podremos crear una dando clic al bot??n ???crear etiqueta???, aunque para ello previamente deberemos seleccionar el ??rea e indicador correspondiente.
                        En caso de crear una etiqueta se nos abrir?? una ventana emergente en el programa y nos pedir?? el nombre de la etiqueta en base a los datos seleccionados:
                    </p>
                    <center><img src="dist/img/etiquetas-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Una vez creada la etiqueta la seleccionaremos y se nos mostrara una nueva opci??n interactiva en la que se nos mostraran todas las columnas de tipo numerico del indicador al que le hemos creado la etiqueta en el lado derecho de la pantalla:</p>
                    <center><img src="dist/img/etiquetas-3.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Para poder a??adir las columnas a la etiqueta solo basta con arrastrar la etiqueta deseada y con ello es suficiente</p>
                    <center><img src="dist/img/etiquetas-4.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Podremos actualizarlo para guardar los cambios e incluso podemos despu??s podremos editarlo al seleccionar de nuevo la etiqueta pudiendo agregar o quitar columnas a la etiqueta sin necesidad de crear nuevas etiquetas.</p>
                    <center><img src="dist/img/etiquetas-5.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>