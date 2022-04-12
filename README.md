## Requerimientos

- Docker version 20 o superior
- Docker compose version 1.29 o superior

## Instalacion

- Crear un archivo llamado .env basado en .env.example
- En el archivo .env modificar las siguientes variables:
  ```sh
    DB_HOST=mysql
    DB_DATABASE=prueba_tecnica
    DB_USERNAME=user
    DB_PASSWORD=123456
    si se desea usar docker la variable DB_HOST debe ser MySQL, las demás variables pueden ser de acuerdo a su criterio 
    ```

## Iniciar docker
- Para montar el contenedor:
  ```sh
    docker-compose up -d 
    ```
- para desmontar el contenedor:
  ```sh
    docker-compose down 
    ```   
