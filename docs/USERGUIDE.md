# Manual de usuario — EBAM / Escolarsis

> Versión original: `Userguide.pdf` (mismo directorio).  
> Texto extraído automáticamente para referencia del agente y del upgrade. Las ilustraciones están solo en el PDF.

Sistema de gestión académica

Contenido
Introducción .................................................................................................................................. 1
Requisitos ...................................................................................................................................... 1
Formularios ................................................................................................................................... 3
Acceso al sistema .......................................................................................................................... 3
Formulario Login ....................................................................................................................... 3
componentes del sistema ............................................................................................................. 4
Formulario agregar/actualizar. ..................................................................................................... 5
Agregar ...................................................................................................................................... 5
Actualizar ................................................................................................................................... 5
Vista inicio ..................................................................................................................................... 6
Vista escuela .................................................................................................................................. 6
Vista grupos ................................................................................................................................... 7
Vista grupo/curso .......................................................................................................................... 7
Vista alumnos ................................................................................................................................ 8
Vista matriculas ............................................................................................................................. 8
Vista cursos ................................................................................................................................... 9
Vista materias................................................................................................................................ 9
Vista reportes. ............................................................................................................................. 10
Vista sesión.................................................................................................................................. 12
Agregar/actualizar ................................................................................................................... 12
Lista de sesiones...................................................................................................................... 14
Vistas promedios ......................................................................................................................... 16
Vista promedio- curso ............................................................................................................. 16
Vista promedio-materia .......................................................................................................... 17
Vista horarios .............................................................................................................................. 19
Ilustración 1 Vista en distintos dispositivos ................................................................................. 1
Ilustración 2 Servidor de hosting................................................................................................... 2
Ilustración 3 Red Local .................................................................................................................. 2
Ilustración 4 Cerrar sesión............................................................................................................. 3
Ilustración 5 Formulario agregar ................................................................................................... 5
Ilustración 6 Formulario actualizar................................................................................................ 5
Ilustración 7 Vista Inicio ................................................................................................................ 6
Ilustración 8 Vista Escuela ............................................................................................................. 6
Ilustración 9 Vista grupos .............................................................................................................. 7
Ilustración 10 Vista grupo-curso ................................................................................................... 7
Ilustración 11Vista Alumnos .......................................................................................................... 8
Ilustración 12 Vista Matriculas ...................................................................................................... 8
Ilustración 13 Vista Cursos ............................................................................................................ 9

Ilustración 14 Vista Materias......................................................................................................... 9
Ilustración 15 Vista reportes Administrador ............................................................................... 10
Ilustración 16 Vista Reportes Maestro ........................................................................................ 10
Ilustración 17Vista Reportes Alumno .......................................................................................... 11
Ilustración 18 Sesión-curso ......................................................................................................... 12
Ilustración 19 Sesión-curso-materia ........................................................................................... 12
Ilustración 20 Sesión-curso-materia-periodo.............................................................................. 13
Ilustración 21 Sesión-curso-materia-periodo-fecha ................................................................... 13
Ilustración 22Ilustración 17 Sesión-curso-materia-periodo-fecha-alumno ................................ 13
Ilustración 23 Notas .................................................................................................................... 13
Ilustración 24 Guardar................................................................................................................. 14
Ilustración 25Vista sesión Administrador ................................................................................... 14
Ilustración 26 Vista Sesión Maestro ............................................................................................ 14
Ilustración 27 Vista sesión Alumno ............................................................................................. 15
Ilustración 28 Vista promedio-curso Administrador ................................................................... 16
Ilustración 29 Vista promedio-curso Maestro ............................................................................ 16
Ilustración 30 Vista Promedio-curso Alumno.............................................................................. 17
Ilustración 31Vista promedio-materia Administrador ................................................................ 17
Ilustración 32 Vista promedio-materias Maestro ....................................................................... 18
Ilustración 33Vista promedio-materias Alumno ......................................................................... 18
Ilustración 34 Vista Horarios Administrador ............................................................................... 19
Ilustración 35 Vista horarios Maestro ......................................................................................... 19
Ilustración 36 Vista Horarios Alumno.......................................................................................... 20
Ilustración 37Matricula Error 1 ................................................................................................... 21
Ilustración 38Matricula error 2 ................................................................................................... 21
Ilustración 39Menu ->Inspeccionar............................................................................................. 22

Introducción
El presente manual tiene como objeto brindar a los usuarios del Sistema de gestión académica
“EBAM”, una serie de pasos para su funcionamiento y uso, describiendo cada punto contenido
en este, facilitando así el acceso, manejo de los procesos de consulta y configuraciones.

Requisitos
Para funcionar, el sistema necesita ser instalado en un servidor de alojamiento web, con esto
lo tenemos disponible dese internet.
Podemos acceder a él desde cualquier dispositivo conectado a internet (Si se ha instalado en
un servidor de hosting) o, con acceso a la red local (si se ha instalado de manera local).

Ilustración 1 Vista en distintos dispositivos




Se requiere comprar el dominio y alojamiento suficiente para almacenar los datos.
Esta opción es confiable, porque los servicios de hosting casi siempre funcionan, no
cuestan mucho, y algunos proporcionan soporte.
1

Ilustración 2 Servidor de hosting

También puede ser instalado únicamente de manera local.


Para esto se requiere un equipo con capacidad de almacenamiento suficiente, una
conexión estable a la red local, y que esté encendido las 24 horas.

Ilustración 3 Red Local

2

Formularios
Acceso al sistema
Formulario Login
Se usa para que solo usuarios dados de alta en el sistema puedan acceder a su contenido.
El sistema tiene 3 roles de usuario.




Administrador, que tiene acceso a todo el contenido y configuraciones.
Maestro, que tiene acceso a las funciones de gestión de datos en materias, cursos,
alumnos, sesiones, promedios y boletas, designadas por el administrador
Alumno, Que, al ingresar, solo puede ver cursos, materias y unidades de los cursos en
que está inscrito, así como los reportes y calificaciones particulares de éste.

Nombre de usuario
Contraseña

Salir del sistema
Una vez que el usuario haya realizado las operaciones que requería, cerrará sesión, para evitar
que otros usuarios tengan acceso al contenido. El formulario para cerrar sesión es accesible
desde cualquier vista, en el botón del usuario .
.

Con esto se desplegará un sencillo formulario para cerrar sesión.

Ilustración 4 Cerrar sesión

3

Componentes del sistema
El sistema tiene un diseño visual muy sencillo, los componentes son accesibles.
Está compuesto básicamente por:






Top-nav: contiene el logotipo, botón de menú, y opciones de usuario
Menú lateral izquierdo: contiene acceso a todas vistas del sistema.
Cuerpo: muestra el formulario que se selecciona en el menú. El cuerpo está
constituido de la siguiente manera:
o Botón nuevo
 Para agregar un nuevo elemento
o Buscar
 Permite encontrar datos particulares
o Lista de elementos consultados
 Datos
 Botón editar
 Botón eliminar
Pie de página: muestra datos de copyright.

Logotipo

Botón mostrar menú

Buscar
Menú

eliminar

Ocultar menú

4

Formulario agregar/actualizar.
Estos componentes, se encuentran en casi todas las vistas, permiten registrar o modificar
elementos en un grupo de datos.

Agregar
Este formulario está disponible en el botón “Nuevo”
, si deseamos agregar un nuevo
registro a una lista, el formulario se muestra con los datos vacíos. Una vez llenados todos los
datos requeridos, vamos al botón guardar de este formulario para efectuar la operación.

Ilustración 5 Formulario agregar

Actualizar
Presione el botón

en el objeto que desea modificar sus valores.

En este formulario, se encuentran en sus campos los valores del objeto seleccionado, esto nos
permite modificarlos.

Ilustración 6 Formulario actualizar

5

Vista inicio
Está disponible para todos los usuarios, permite a los usuarios del sistema, conocer
información relevante de la institución.

Ilustración 7 Vista Inicio

Vista escuela
Muestra los datos de la institución académica.
Solo los administradores del sistema pueden modificar esta información.

Ilustración 8 Vista Escuela

6

Vista grupos
Permite crear los grupos a que serán asignados los distintos estudiantes.

Ilustración 9 Vista grupos

Vista grupo/curso
Permite vincular un grupo de alumnos con distintos cursos.

Ilustración 10 Vista grupo-curso

7

Vista alumnos
Muestra una lista de todos los alumnos inscritos, y el grupo al que pertenecen, antes de crear
un alumno, se crea el grupo al que será asociado.

Ilustración 11Vista Alumnos

Vista matriculas
Muestra una lista de alumnos, con los cursos en que este está inscrito.

Ilustración 12 Vista Matriculas

8

Vista cursos
Muestra una lista de los distintos cursos que se imparten en esta institución.
Los cursos se vinculan con materias y grupos de alumnos.
Esta vista está disponible para todos los usuarios del sistema, pero solo el administrados puede
modificar los datos.

Ilustración 13 Vista Cursos

Vista materias
Muestra una lista de las materias disponibles en los distintos cursos.



Un usuario tipo maestro, solo tiene acceso a las materias que imparte.
A un alumno solo se le muestra una lista de materias de los cursos en que está inscrito.

Ilustración 14 Vista Materias

9

Vista reportes.
Se usa para documentar un comportamiento inusual de un alumno.


Para el administrador se muestran todos los reportes.

Ilustración 15 Vista reportes Administrador



El maestro, solo tiene acceso a los reportes que emite.

Ilustración 16 Vista Reportes Maestro

10



El alumno solo ve los que le corresponden.

Ilustración 17Vista Reportes Alumno

11

Vista sesión
Agregar/actualizar
Permite registrar o modificar las notas de un estudiante.
 Para tomar notas de una clase lo haremos de la siguiente manera:
1. Seleccionamos el curso en que están los alumnos.

Ilustración 18 Sesión-curso

2. Elegimos la materia que será impartida.

Ilustración 19 Sesión-curso-materia

3. Seleccionamos la unidad o periodo de la materia.

12

Ilustración 20 Sesión-curso-materia-periodo

4. Ingresamos la fecha de la clase.

Ilustración 21 Sesión-curso-materia-periodo-fecha

5. Elegimos el alumno a calificar.

Ilustración 22Ilustración 17 Sesión-curso-materia-periodo-fecha-alumno

6. Ingresamos las notas.

Ilustración 23 Notas

13

7. Para guardar tenemos dos opciones:

Ilustración 24 Guardar

o

guardar sin cerrar el formulario
, en caso de que deseemos tomar
notas de varios o todos los estudiantes de un curso-materia-periodo-fecha.

o

Guardar y cerrar

Lista de sesiones
Permite registrar notas de alumnos en las clases impartidas.


El administrador tiene acceso a todo el contenido.

Ilustración 25Vista sesión Administrador



Un maestro, solo tiene acceso a los registros de las clases que le corresponden, así
como solo puede registrar clases de las materias que le corresponden.

Ilustración 26 Vista Sesión Maestro



Un alumno, solo tiene acceso al contenido que le corresponde, y no puede modificarlo
14

Ilustración 27 Vista sesión Alumno

15

Vistas promedios
Vista promedio- curso
Muestra una lista de las asistencias y promedios obtenidos por los alumnos en los distintos
cursos.
Al igual que en la visa sesiones, cada usuario tiene acceso al contenido que le corresponde.

Ilustración 28 Vista promedio-curso Administrador

Ilustración 29 Vista promedio-curso Maestro

16

Ilustración 30 Vista Promedio-curso Alumno

Vista promedio-materia
Muestra una lista de las calificaciones obtenidas por los alumnos en las unidades de cada
materia.

Ilustración 31Vista promedio-materia Administrador

17

Ilustración 32 Vista promedio-materias Maestro

Ilustración 33Vista promedio-materias Alumno

18

Vista horarios
Permite a los usuarios conocer los horarios en que se imparten las materias que le son
pertinentes.
El administrador, tiene acceso a todo el contenido, el administrador es quien asigna los
horarios.

Ilustración 34 Vista Horarios Administrador

El maestro, tiene acceso a los horarios en que se incluyen sus materias.

Ilustración 35 Vista horarios Maestro

A un alumno solo se le muestran los horarios de los cursos en que está inscrito.

19

Ilustración 36 Vista Horarios Alumno

20

Soluciones a errores comunes
Error de entrada duplicada en “matriculas”
Se presenta al tratar de registrar una matrícula que ya existe, puesto que no es necesario
registrar matriculas más de una vez, y esto además produciría errores al tomar notas.

Ilustración 37Matricula Error 1

Al mismo tiempo que en consola aparece el siguiente mensaje.

Ilustración 38Matricula error 2
1. data:
1. exception: "Illuminate\Database\QueryException"
2. file: "C:\xampp\htdocs\escolarsis3\vendor\laravel\framework\src\Illumin
ate\Database\Connection.php"
3. line: 664
4. message: "SQLSTATE[23000]: Integrity constraint violation: 1062
Duplicate entry '8-4' for key 'matriculas_idgrupo_idcurso_unique' (SQL:
insert into `matriculas` (`idcurso`, `idgrupo`, `condicion`,
`updated_at`, `created_at`) values (4, 8, 1, 2020-12-17 21:35:45, 201812-17 21:35:45))"

Que indica que no puede haber entradas duplicadas
Si se sigue mostrando el error, y con un mensaje distinto a este, recargue el navegador (pulse
F5). Si esto no funciona, asegúrese que el servidor de apache y mysql están funcionando (En
caso de ser instalado en modo local)
Si se ha instalado en servidor de hosting, verifique contar con los servicios que el sistema
requiere (Dominio, base de datos, etc.)

21

Ilustración 39Menu ->Inspeccionar

MethodNotAllowedHttpException
Se produce cuando se ha excedido el tiempo de inactividad en una sesión abierta, es una
medida de seguridad, que hace que volvamos a iniciar sesión, en caso de que un usuario haya
abandonado el sistema sin cerrar sesión, después de un momento, se cerrará sola, pero
mostrará un mensaje.


Para solucionar esto, recargamos la página y eliminamos “/login” en la dirección del
navegador
y recargamos.

Error al insertar usuario.
Es un error que ocurre a nivel de la base de datos, cuando se intenta ingresar un usuario con
un id existente. Al suceder esto, debemos indicar a la base de datos en que numero inicie el
conteo de ids, de manera que se evite este error.
Hay que ingresar al gestor de base de datos (requiere usuario y contraseña), seleccionar la
base de datos del sistema y ejecutar una consulta como la siguiente, que sea aplicada a las
tablas que contienen usuarios (Alumnos y personas).
ALTER TABLE personas AUTO_INCREMENT = 1488000

Cualquier error distinto, o problema para solucionar alguno, comuníquese
con el desarrollador.

22

