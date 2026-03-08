PRACTICA 2: HERENCIA EN PHP

EXPLICACION DE LA HERENCIA APLICADA
La herencia se implementó mediante la palabra reservada extends, permitiendo que la clase Admin herede los atributos protegidos y métodos de la clase Usuario. Se utilizó una estructura modular con require y la constante __DIR__ para garantizar la carga correcta de los archivos en el servidor local.

DIFERENCIAS ENTRE USUARIO Y ADMIN
Usuario: Es la clase base que contiene la lógica general (Nombre y Correo) y el constructor principal.

Admin: Es la clase especializada que añade funcionalidad extra mediante el método getRol(), reutilizando el código de la clase padre.

EVIDENCIA VIDEO
https://youtu.be/V2g4Zpa_4B0