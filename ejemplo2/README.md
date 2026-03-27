Este es un sistema CRUD de productos que permite registrar, listar, editar, buscar y eliminar datos. Utiliza PHP el modelo de Programación Orientada a Objetos (POO) y se conecta a una base de datos MySQL mediante PDO.

Estructura
config/Database.php
Gestiona la conexión PDO con la base de datos.

models/Producto.php
Define el objeto (id, nombre, precio, etc.) y sus métodos.

controllers/ProductoController.php
Contiene la lógica para crear, leer, actualizar y borrar datos.

index.php
Es la interfaz principal con el formulario y la tabla de productos.