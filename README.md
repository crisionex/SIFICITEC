# SIFICITEC
Dentro del sistema de indicadores SIFCITEC tendremos diferentes ventanas y opciones que nos ayudaran a la creación de diferentes tablas y estadísticas globales de cualquier tipo que puedan ser visualizadas por medio de gráficos y generar reportes a partir de esta información.

Como es una aplicación que requiere de diferentes subsistemas para ser totalmente funcional, es necesario de la existencia de entidades que ayuden a realizar diferentes actividades en conjunto para poder mantener el sistema principal, estos son denominados permisos y cada entidad cuenta con más o menos funciones según sea necesario.
Entendemos pues que los permisos están denominados por lo siguiente:

* Administrador: se trata de la persona que posee el nivel más alto, esta se encarga de crear nuevas cuentas, así como de administrar las ya existentes pudiendo realizar configuraciones como el otorgar permisos (jefe de área y encargado de gestión, roles de lo que hablaremos más adelante) o bien configurar parámetros como la habilitación. Este puede a su vez crear tanto áreas como gestiones y puede visualizar la información recibida con el fin de monitorear la data existente
* Jefe de área: la persona con este rol cuenta con más limitaciones que el administrador puesto que ellos no pueden visualizar a los usuarios existentes, sin embargo si pueden configurar parámetros de su cuentan tales como la contraseña o su correo asociado. Estos usuarios pueden crear nuevos indicadores asociados únicamente a su área establecida o asignada además de poder administrar los indicadores asociados a su área pudiendo configurar parámetros tales como la creación, edición, lectura y borrado de los datos.
* Encargado de gestión: este usuario únicamente puede crear nuevos reportes asignados a su indicador así como poder editar ciertos parámetros de los mismos con el fin de dar mayor flexibilidad, sin embargo, este usuario no es capaz de crear nuevos indicadores ni de modificar información del indicador asignado, si no que solo crea reportes y genera las gráficas en base a la información que se ha dado.
* Lector/consultor: se encarga de solo visualizar la información ya actualizada por el sistema principal y es capaz de generar reportes y gráficos en base a esa información, esta fuera del sistema y su única función es el observar y confirmar que la información proporcionada por el sistema sea verídica.

# Funcionalidades
Una vez explicado toda la estructuración del sistema principal es hora de poder explicar el cómo es que el sistema funciona.
## 1. Configuraciones
### 1.1 Áreas (Visible solo por administrador) 
Las áreas son los principales pilares del sistema estos son utilizados para poder crear indicadores y múltiples tablas con datos que son visualizables por nuestros consultores a través de los múltiples indicadores existentes.
Esta sección cuenta con diferentes campos que tienen que ser llenados por el usuario:


![areas-1](https://user-images.githubusercontent.com/60988725/186988781-2a2f0087-ba05-4fbb-8bbf-60ce4057f9f6.png?style=centerme)

* Nombre del área: Como su nombre lo indica sirve para darle un nombre al área que necesitaremos.
* Status: nos indica el estatus con el que el indicador aparecerá, si es visible los usuarios podrán acceder a sus indicadores y será visible desde la barra.

![areas-3](https://user-images.githubusercontent.com/60988725/186989074-f283ce74-7196-4f1c-9bbc-5a549166ca00.png)
![areas-2](https://user-images.githubusercontent.com/60988725/186989091-837ab0ee-ce16-491d-bc47-a5ff6ddb9fc3.png)

### 1.2 Indicadores (visible por administrador y jefe de área):
Los indicadores son dependientes de las áreas, no es posible crear un indicador sin antes haber creado un área, estos son el medio por el cual se ingresa cada dato posible.
Para crear un indicador es necesario:

![indicadores-1](https://user-images.githubusercontent.com/60988725/186988988-ca2bc581-c019-48fd-afc9-6330d86093bf.png)

* seleccionar el área perteneciente: los administradores son capaces de crear indicadores en base a cualquier área, sin embargo, los jefes de área solo pueden crear indicadores en base a su área a cargo.
* Nombre del indicador: definiremos el nombre del indicador.
* Columnas de la tabla: en base a esta área de texto seremos capaces de crear el número y nombre de cada una de las columnas que el indicador contendrá, para crearlos será necesario el uso de columnas individuales que ayuden a ingresar la información mediante formas predefinidas, así como el tipo de dato que sea, puede ser numérico o bien de tipo texto.

### 1.3 Mi cuenta (visible para todos)
Dentro de la sección de mi cuenta seremos capaces de editar todos aquellos valores correspondientes a nuestra cuenta, ya sea usuario, correo o bien contraseña, pero una vez cambiados estos atributos la cuenta se cerrará de manera automática por seguridad y deberá iniciar sesión nuevamente.

![acc-1](https://user-images.githubusercontent.com/60988725/186989840-e45ffde2-7f5c-4697-a7fe-e5f1e1db5014.png)

## 2. validaciones.
En esta sección se validan todos aquellos indicadores que han sido creados, esto con el fin de observar si la información ingresada por el responsable fue ingresada de manera correcta o no.

Cuando exista algo que validar se nos será notificado por medio de una burbuja de notificaciones por lo que solo es necesario con dar clic a la sección.

![validaciones-1](https://user-images.githubusercontent.com/60988725/186990059-d563431d-6006-4a58-b609-d587f9c5b8da.png)

Dentro de este apartado podremos visualizar todos aquellos indicadores pendientes y para visualizar la información completa del indicador daremos clic en “detalles adicionales”.

![validaciones-2](https://user-images.githubusercontent.com/60988725/186990112-fc3aa87b-0cf8-4160-884c-35dc1d0c2f53.png)

De esta manera podremos observar detalles como el responsable de la creación del indicador, a que área pertenece, el nombre y el número de las columnas. Si toda la información es correcta podremos autorizar el indicador, en caso contrario rechazarlo y desaparecerá la notificación en la sección de “validaciones”.

![validaciones-3](https://user-images.githubusercontent.com/60988725/186990128-a7b48a63-ecf0-4fed-a04e-2f45bc1beaf1.png)

## 3. Panel de usuarios.
### 3.1 gestión de usuarios (visible solo para administrador):
Debido a que es un sistema totalmente cerrado es necesario que las cuentas sean creadas de manera interna, de este modo se da más seguridad y el sistema es menos vulnerable a fallas de seguridad. El administrador es quien se encarga de crear las cuentas y para esto es necesario que se ingrese el nombre de usuario, así como el email asociado y contraseña que se tendrá para el usuario creado (esta podrá ser cambiada después de ser creada).

![usuarios-1](https://user-images.githubusercontent.com/60988725/186992564-de2c7a71-17c0-4f76-bd50-81619335e53f.png)

En la sección del rol asignado es donde otorgaremos los permisos del usuario, existen 3 roles disponibles dentro del sistema interno como ya habíamos mencionado, por lo que será necesario que se elija uno. En caso de elegir jefe de área o bien encargado de gestión será necesario añadir un dato más a un nuevo campo que será el área a la cual estará asignado.

![usuarios-2](https://user-images.githubusercontent.com/60988725/186992680-26e88a98-6622-4ffa-a489-410aa951bdff.png)

Como administradores también tendremos cierto dominio sobre las cuentas, aunque limitado podremos desactivarlas/inhabilitarlas y reasignar roles en caso de ser requerido.

![usuarios-4](https://user-images.githubusercontent.com/60988725/186992694-397f7a04-10a9-479d-8f42-7e918f8de44d.png)

### 3.2 Permisos (visible solo para administrador y jefe de área):
Por medio de esta herramienta seremos capaces de determinar el grado de responsabilidad de cada uno de los usuarios según sus permisos.
Según el usuario que seleccionemos será se mostraran los indicadores del área a la que el usuario pertenece (a menos que se aun administrador)
Para este caso el permiso lo podremos poner en falso o verdadero según sea requerido para el usuario seleccionado.
Y con ello tenemos la visualización de este indicador:

![permisos-1](https://user-images.githubusercontent.com/60988725/186993397-b7c7b34d-7ed3-4966-84be-5ee84fdbdb1e.png)
![permisos-2](https://user-images.githubusercontent.com/60988725/186993444-679a699f-ed78-485c-8949-34cc5658a6a7.png)
![permisos-3](https://user-images.githubusercontent.com/60988725/186993452-dabfdfde-9500-426b-a133-36be07bfd1c0.png)
![permisos-4](https://user-images.githubusercontent.com/60988725/186993470-c2ed1bb9-ccf6-47bb-b7ea-60e8e35b6975.png)

## 4. Etiquetas
Etiquetas es una sección que está dentro de configuraciones ya que va ligado directamente a los indicadores y las áreas, sin embargo, es también un sistema independiente en el que se crean filtros en lo que se podrá graficar posteriormente como un consultor de datos.

![etiquetas-1](https://user-images.githubusercontent.com/60988725/186993557-96fd1279-ca8c-4541-95e5-a3810bce78a9.png)

Existen 2 tipos de etiquetas, etiquetas numéricas y etiquetas de texto, la diferencia principal radica en el tipo de datos que estas etiquetas albergan ya que, solo observaremos columnas de cierto tipo de dato según el tipo de etiqueta que hayamos seleccionado.

![etiquetas-2](https://user-images.githubusercontent.com/60988725/186993592-a0bd6350-c49e-497a-992d-0281c48c5591.png)

Para el caso de etiquetas numéricas, podremos observar que existen 3 campos en los que seleccionaremos datos, tendremos que seleccionar el área, el indicador y la etiqueta si existe, en caso de que no exista una etiqueta podremos crear una dando clic al botón “crear etiqueta”, aunque para ello previamente deberemos seleccionar el área e indicador correspondiente. En caso de crear una etiqueta se nos abrirá una ventana emergente en el programa y nos pedirá el nombre de la etiqueta en base a los datos seleccionados. Al crear la etiqueta se nos mostrara una notificación del lado derecho inferior de la pantalla indicándonos si se ha creado la etiqueta.
Una vez creada la etiqueta la seleccionaremos y se nos mostrara una nueva opción interactiva en la que se nos mostraran todas las columnas del indicador al que le hemos creado la etiqueta en el lado derecho de la pantalla. 

![etiquetas-4](https://user-images.githubusercontent.com/60988725/186993739-202457c0-3d46-4ac1-bd87-faea307c7d37.png)

Para poder añadir las columnas a la etiqueta solo basta con arrastrar la columna deseada al lado izquierdo y con ello es suficiente.

![etiquetas-3](https://user-images.githubusercontent.com/60988725/186993758-4b76d0b6-c3a2-49ce-9703-f9f7236c84e7.png)

Podremos actualizarlo para guardar los cambios e incluso después podremos editarlo al seleccionar de nuevo la etiqueta pudiendo agregar o quitar columnas a la etiqueta sin necesidad de crear nuevas etiquetas.

![etiquetas-5](https://user-images.githubusercontent.com/60988725/186993800-83c3cc28-915a-40f5-9777-5ff85451ba6b.png)

En el caso de la etiqueta de texto es similar solo que al crear la etiqueta solo podremos elegir una sola columna de texto y no múltiples como en el caso de la etiqueta numérica.
## 5. Gráficos y Reportes generados
Este subsistema es el que genera y nos proporciona la información de manera visual sin la necesidad de hacer uso de herramientas como Excel, el sistema genera gráficos y tablas en conjunto según los datos indicados por el usuario.
Para poder visualizar la gráfica de un indicador según las etiquetas creadas solo se necesita que el usuario indique el área, el indicador y las etiquetas tanto numérica como de texto, de esta manera se genera la gráfica y la tabla con los datos más explícitos, además si se requiere, es posible descargar el archivo Excel con los datos de la tabla.
