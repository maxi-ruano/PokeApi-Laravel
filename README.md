Instalar composer

Crear archivo .env en la raiz del proyecto ( copiar el archivo .env.example y renombrar la copia a .env sin eliminar el .env.example)

Ejecutar php artisan key:generate

Ejecutar Proyecto : php artisan serve 

Instalar linter php sniffer : composer global require "squizlabs/php_codesniffer=*"

Verificar ubicacion del linter : composer global show -D

Ejecutar php sniffer : phpcs 

Corregir errores  PHP_CodeSniffer : phpcbf



