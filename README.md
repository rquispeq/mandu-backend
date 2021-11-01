# Proyecto backend para Mandu.

Realización del proyecto Laravel propuesto por la Empresa Start Up Mandu
## Reto
- [x] El nombre de la división debe ser único y no superar los 45 caracteres.
- [x]  Una división puede tener (o no) otra división existente como división superior.
- [x] Una división puede tener cero o más divisiones como subdivisiones.
- [x] El nivel y la cantidad de colaboradores de una división debe ser un número entero y positivo aleatorio.
- [x] Una división puede tener a un embajador designado y de este solo se registra su nombre completo
- [x] Crear, consultar, actualizar y eliminar division
- [x] Listar todas las divisiones
- [x] Listar subdivisiones de una división

## Modelo de datos
![image](https://user-images.githubusercontent.com/23042251/139615997-da61f1ab-bfc4-40a9-8432-b01865135802.png)

## Tecnologías
- Laravel 8
- Controllers
- Migraciones
- Tests
- Factory
- Seeders

## Consumo de API
1. Se debe ejecutar el aplicativo con el comando php artisan serve:
2. Se debe usar el aplicativo postman
3. Se debe establecer la propiedad Accept con valor application/json en el header de la petición

### URLS
#### Listado de divisions: 
http://127.0.0.1:8000/api/division

#### Creación de división
http://127.0.0.1:8000/api/division (por metodo POST)
parametros:
- name
- colaboradores
- división_id (opcional)

#### Consulta de una division: 
http://127.0.0.1:8000/api/division/1

#### Edición de división
http://127.0.0.1:8000/api/division (por metodo PUT)
parametros:
- name
- colaboradores
- división_id (opcional)

#### Eliminación de división
http://127.0.0.1:8000/api/division/1 (por metodo DELETE)
