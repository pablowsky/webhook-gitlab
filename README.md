Utiliza este script si necesitas automatizar tus despliegues desde un 
repositorio gitlab hacia un servidor FTP

Necesitas un token de autenticacion de tu cuenta gitlab 
que debes declarar en (Config.php):
$tokenApp 		= '';

Configura tus servidores FTP
... new Server('host', 'user', 'pass');


Adicionalmente en la raiz de tu proyecto debes incluir el siguiente 
archivo llamado wh_config.php:

;Ejemplo wh_config.php
; Directorio en ftp, ej: /mi/carpeta/
base = "" 
; Indico el servidor a utilizar
server = "development"
; Token de autorizacion de webhook, es el que viene en la cabecera http
; con nombre X-Gitlab-Token

token = ""
