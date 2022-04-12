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

    URL_PLACE_TO_PAY=https://dev.placetopay.com/redirection/
    LOGIN_PLACE_TO_PAY=6dd490faf9cb87a9862245da41170ff2
    SECRET_PLACE_TO_PAY=024h1IlD
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

## Instalar composer

- Para instalar composer ejecutamos el comando compose instal en el contenedor
  ```sh
    docker-compose exec app composer install
  ```

## Migraciones y seeders

- Para instalar composer ejecutamos el comando compose instal en el contenedor
  ```sh
    docker-compose exec app php artisan migrate --seed
  ```

## Realizar pruebas de la api con postman

- En la raiz del proyecto se deja un archivo **Prueba evertec.postman_collection.json** el cual se debe import en
  Postman.
    - Para generar una orden ir a la carpeta **Orders** en Postman, en el request **Create order** y dar click en send
      (enviar), la respuesta sera como el siguiente ejemplo:
        ```sh
          {
          "customer_name": "Juan felipe",
          "customer_email": "ospinafelipe17@gmail.com",
          "customer_mobile": "3014735995",
          "uuid": "4c977250-0ce3-41b6-8d87-dd4e03f726ac",
          "status": "CREATED",
          "updated_at": "2022-04-12T01:18:27.000000Z",
          "created_at": "2022-04-12T01:18:27.000000Z",
          "id": 2
          }
        ```
        - Para crear un producto en una orden ir a la carpeta **Orders** en Postman, en el request **Create order
          prducts** y dar click en send(enviar), la respuesta sera como el siguiente ejemplo:
      ```sh
        {
        "order_id": "2",
        "product_id": "1",
        "amount": "20",
        "unit_price": "10000.00",
        "total": "200000.000000",
        "updated_at": "2022-04-12T01:22:31.000000Z",
        "created_at": "2022-04-12T01:22:31.000000Z",
        "id": 2,
        "product": {
        "id": 1,
        "name": "producto generico",
        "price": "10000.00"
        }
        ```

- Para crear una session en place to pay ir a la carpeta **Pay transaction** en Postman, en el request **Generate transaction** y dar click en send(enviar), la respuesta sera como el siguiente ejemplo:
  ```sh
    {
    "status": {
    "status": "OK",
    "reason": "PC",
    "message": "La petición se ha procesado correctamente",
    "date": "2022-04-11T20:24:52-05:00"
    },
    "requestId": 53042,
    "processUrl": "https://checkout-co.placetopay.dev/session/53042/65de7063000d52989d3c9e665cf178c7"
    }
  ```
  se puede ingresar al desde el navegador a la URL dada en "processUrl" para iniciar la transaccion con place to pay.


- Para consultar el estado de una transaccion en place to pay ir a la carpeta **Pay transaction** en Postman, en el request **Get information Transaction** y dar click en send(enviar), la respuesta sera como el siguiente ejemplo:
  ```sh
    {
    "message": "La petición se encuentra activa"
    }
  ```

