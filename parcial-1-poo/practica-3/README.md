Practica 3 – Sistema de Usuarios con POO y Excepciones
 
El sistema maneja diferentes tipos de usuarios utilizando una clase base llamada Usuario y dos clases derivadas llamadas Admin y Alumno.
También se implementa validación de correo electrónico y manejo de excepciones para evitar datos incorrectos.

Explicación del flujo de clases
La clase Usuario es la clase base y contiene los atributos nombre y correo.  
Dentro de esta clase se valida que el correo tenga un formato correcto. Si el correo no es válido se lanza una excepción.

La clase Admin hereda de Usuario y tiene un método llamado getRol() que devuelve el texto "Administrador".

La clase Alumno también hereda de Usuario. Esta clase agrega un atributo adicional llamado matricula y su método getRol() devuelve "Alumno".

El archivo index.php es el encargado de crear los objetos y probar el funcionamiento del sistema.

Manejo de errores
En index.php se utilizan bloques try y catch para controlar los errores cuando se crea un usuario con un correo inválido.

Si el correo es correcto el usuario se crea normalmente.  
Si el correo es incorrecto se lanza una excepción y se muestra un mensaje de error controlado sin detener el programa.

Se realizaron pruebas creando usuarios con correos válidos y también con correos incorrectos.  
Cuando el correo no cumple con el formato se muestra un mensaje indicando que el correo es inválido.

LINK DEL VIDEO