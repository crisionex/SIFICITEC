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
                    <p>Dentro del sistema de indicadores de la FCITEC o bien SIFCITEC tendremos diferentes ventanas opciones que nos ayudaran a la creación de diferentes tablas que puedan ser visualizadas por medio de gráficos y generar reportes a partir de esta información.</p>
                    <p>Como es una aplicación que requiere de diferentes subsistemas para ser totalmente funcional es necesario de la existencia de entidades que ayuden a realizar diferentes actividades en conjunto para poder mantener el sistema principal, estos son denominados permisos y cada entidad cuenta con mas o menos funciones según sea necesario.
                        Entendemos pues que los permisos están denominados por lo siguiente:</p>
                    <ul>
                        <li>Lector/Consultor</li>
                        <li>Encargado de gestión</li>
                        <li>Jefe de área</li>
                        <li>Administrador</li>
                    </ul>
                </div>
                <br>
                <div id="roles">
                    <h2>Roles</h2>

                    <p><strong>Administrador:</strong> se trata de la persona que posee el nivel más alto, esta se encarga de crear nuevas cuentas, así como de administrar las ya existentes pudiendo realizar configuraciones como el otorgar permisos (jefe de área y encargado de gestión, roles de lo que hablaremos más adelante) o bien configurar parámetros como la habilitación. Este puede a su vez crear tanto áreas como gestiones y puede visualizar la información recibida con el fin de monitorear la data existente.</p>
                    <p><strong>Jefe de área:</strong> la persona con este rol cuenta con más limitaciones que el administrador puesto que ellos no pueden visualizar a los usuarios existentes, sin embargo si pueden configurar parámetros de su cuentan tales como la contraseña o su correo asociado. Estos usuarios pueden crear nuevos indicadores asociados únicamente a su área establecida o asignada además de poder administrar los indicadores asociados a su área pudiendo configurar parámetros tales como la creación, edición, lectura y borrado de los datos.</p>
                    <p><strong>Encargado de gestión: </strong>este usuario únicamente puede crear nuevos reportes asignados a su indicador así como poder editar ciertos parámetros de los mismos con el fin de dar mayor flexibilidad, sin embargo, este usuario no es capaz de crear nuevos indicadores ni de modificar información del indicador asignado, si no que solo crea reportes y genera las gráficas en base a la información que se ha dado.</p>
                    <p><strong>Lector/consultor:</strong>se encarga de solo visualizar la información ya actualizada por el sistema principal y es capaz de generar reportes y gráficos en base a esa información, esta fuera del sistema y su única función es el observar y confirmar que la información proporcionada por el sistema sea verídica.</p>
                </div>
                <h1>Funciones: Ajustes</h1>
                <br>
                <p>Una vez explicado toda la estructuración del sistema principal es hora de poder explicar el como es que el sistema funciona.</p>
                <div id="conf-areas">
                    <h2>Areas</h2>

                    <p>Las áreas son los principales pilares del sistema estos son utilizados para poder crear indicadores y múltiples tablas con datos que son visualizables por nuestros consultores a través de los múltiples indicadores existentes.</p>
                    <center><img src="dist/img/areas-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Esta sección cuenta con diferentes campos que tienen que ser llenados por el usuario:</p>
                    <ul>
                        <li> <strong>Nombre del área:</strong> Como su nombre lo indica sirve para darle un nombre al área que necesitaremos.</li>
                        <li><strong>Status:</strong> nos indica el estatus con el que el indicador aparecerá, si es visible los usuarios podrán acceder a sus indicadores y será visible desde la barra.</li>
                        <li><strong>Icono:</strong> Este es un menú interactivo que nos facilita la selección de un icono que el usuario busque, como se muestra en la siguiente imagen.</li>
                    </ul>
                    <p>Por ejemplo creemos un área. Esta área será llamada “matricula”, tendrá su estatus activo por defecto y utilizaremos un icono cualquiera, de modo que al introducir los datos podremos crear lo siguiente:</p>
                    <center><img src="dist/img/areas-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>En las opciones del área podremos eliminarlo o bien editarlo con opciones básicas según lo que tenemos podremos editar el nombre y el estatus:</p>
                    <center><img src="dist/img/areas-3.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
                <div id="conf-indicadores">
                    <h2>Indicadores</h2>
                    <p>Los indicadores son dependientes de las áreas, no es posible crear un indicador sin antes haber creado un área, estos son el medio por el cual se ingresa cada dato posible.</p>
                    <center><img src="dist/img/indicadores-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Para crear un indicador es necesario:</p>
                    <ul>
                        <li><strong>seleccionar el área perteneciente:</strong> los administradores son capaces de crear indicadores en base a cualquier área, sin embargo, los jefes de área solo pueden crear indicadores en base a su área a cargo.</li>
                        <li><strong>Nombre del indicador:</strong> definiremos el nombre del indicador.</li>
                        <li><strong>Columnas de la tabla:</strong> Podremos crear diferentes columnas independientes en dos modos, columnas de texto y columnas de datos numericos, algo que se vera mas a detalle en la seccion de interfaz.</li>
                    </ul>
                    <p>Creemos un indicador en base a los datos anteriormente mencionados para ejemplificar lo anterior. El indicador se llamará “Comportamiento de la matricula por semestre” y será relacionado al área anteriormente creada (Matricula), contará con 4 columnas “programa educativo”, “Hombres”, “mujeres” y “Periodo Educativo”.</p>
                    <p>De modo que podremos visualizarlo de esta manera:</p>
                    <center><img src="dist/img/indicadores-2.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
                <div id="conf-acc">
                    <h2>Mi cuenta</h2>
                    <p>Dentro de la sección de mi cuenta seremos capaces de editar todos aquellos valores correspondientes a nuestra cuenta, ya sea usuario, correo o bien contraseña, pero una vez cambiados estos atributos la cuenta se cerrará de manera automática por seguridad y deberá iniciar sesión nuevamente.</p>
                    <center><img src="dist/img/acc-1.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
                <h1>Funciones: Gestion</h1>
                <br>
                <div id="gest-validacion">
                    <h2>Validacion</h2>
                    <p>En esta sección se validan todos aquellos indicadores que han sido creados, esto con el fin de observar si la información ingresada por el responsable fue ingresada de manera correcta o no.</p>
                    <center><img src="dist/img/validaciones-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Cuando exista algo que validar se nos será notificado por medio de una burbuja de notificaciones por lo que solo es necesario con dar clic a la sección.</p>
                    <center><img src="dist/img/validaciones-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Dentro de este apartado podremos visualizar todos aquellos indicadores pendientes y para visualizar la información completa del indicador daremos clic en “detalles adicionales” de este modo observaremos algo similar a:</p>
                    <center><img src="dist/img/validaciones-3.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>De esta manera podremos observar detalles como el responsable de la creación del indicador, a que área pertenece, el nombre y el numero y nombre de las columnas. Si toda la información es correcta podremos autorizar el indicador, en caso contrario rechazarlo y desaparecerá la notificación en la sección de “validaciones”.</p>
                </div>
                <div id="gest-usuarios">
                    <h2>gestion de usuarios</h2>
                    <p>Debido a que es un sistema totalmente cerrado es necesario que las cuentas sean creadas de manera de manera interna, de este modo se da mas seguridad y el sistema es menos vulnerable a fallas de seguridad.</p>
                    <center><img src="dist/img/usuarios-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>El administrador es quien se encarga de crear las cuentas y para esto es necesario que se ingrese el nombre de usuario, así como el email asociado y contraseña que se tendrá para el usuario creado (esta podrá ser cambiada después de ser creada).</p>
                    <p>En la sección del rol asignado es donde otorgaremos los permisos del usuario, existen 3 roles disponibles dentro del sistema interno como ya habíamos mencionado, por lo que será necesario que se elija uno. En caso de elegir jefe de área o bien encargado de gestión será necesario añadir un dato mas a un nuevo campo que será el área a la cual estará asignado:</p>
                    <center><img src="dist/img/usuarios-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Al registrar cuentas lo que aparecerá dentro de los indicadores será lo siguiente:</p>
                    <center><img src="dist/img/usuarios-3.png" class="img-fluid" alt="..."></center>
                    <br>
                    <center><img src="dist/img/usuarios-4.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Como administradores también tendremos cierto dominio sobre las cuentas, aunque limitado podremos desactivarlas/inhabilitarlas y reasignar roles en caso de ser requerido.</p>
                </div>
                <div id="gest-permisos">
                    <h2>Permisos</h2>
                    <p>Por medio de esta herramienta seremos capaces de determinar el grado de responsabilidad de cada uno de los usuarios según sus permisos.</p>
                    <center><img src="dist/img/permisos-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Según el usuario que seleccionemos será se mostraran los indicadores del área a la que le usuario pertenece (a menos que se aun administrador).</p>
                    <center><img src="dist/img/permisos-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Para este caso el permiso lo podremos poner en falso o verdadero según sea requerido para el usuario seleccionado.</p>
                    <center><img src="dist/img/permisos-3.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Y con ello tenemos la visualización de este indicador:</p>
                    <center><img src="dist/img/permisos-4.png" class="img-fluid" alt="..."></center>
                    <br>
                </div>
                <div id="gest-etiquetas">
                    <h2>Etiquetas</h2>
                    <p>Etiquetas es una sección que esta dentro de configuraciones ya que va ligado directamente a los indicadores y las áreas, sin embargo, es también un sistema independiente en el que se crean filtros en lo que se podrá graficar posteriormente como un consultor de datos.</p>
                    <center><img src="dist/img/etiquetas-1.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Podremos observar que existen 3 campos en los que seleccionaremos datos, tendremos que seleccionar el área, el indicador y la etiqueta si existe, en caso de que no exista una etiqueta podremos crear una dando clic al botón “crear etiqueta”, aunque para ello previamente deberemos seleccionar el área e indicador correspondiente.
                        En caso de crear una etiqueta se nos abrirá una ventana emergente en el programa y nos pedirá el nombre de la etiqueta en base a los datos seleccionados:
                    </p>
                    <center><img src="dist/img/etiquetas-2.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Una vez creada la etiqueta la seleccionaremos y se nos mostrara una nueva opción interactiva en la que se nos mostraran todas las columnas de tipo numerico del indicador al que le hemos creado la etiqueta en el lado derecho de la pantalla:</p>
                    <center><img src="dist/img/etiquetas-3.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Para poder añadir las columnas a la etiqueta solo basta con arrastrar la etiqueta deseada y con ello es suficiente</p>
                    <center><img src="dist/img/etiquetas-4.png" class="img-fluid" alt="..."></center>
                    <br>
                    <p>Podremos actualizarlo para guardar los cambios e incluso podemos después podremos editarlo al seleccionar de nuevo la etiqueta pudiendo agregar o quitar columnas a la etiqueta sin necesidad de crear nuevas etiquetas.</p>
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