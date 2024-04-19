# Instalación y requisitos

## Requisitos previos

Antes de comenzar, asegúrate de tener instalados los siguientes requisitos:

-   **Composer**: Para instalar y administrar las dependencias del proyecto.
-   **PHP 8.1 o superior**: Es necesario para ejecutar la aplicación.

## Instalación de dependencias

Una vez que hayas instalado Composer y PHP, ejecuta el siguiente comando para instalar las dependencias del proyecto:

```bash
composer install
```

### Si durante la instalación te encuentras con problemas relacionados con las extensiones xml, dom, gd y zip, puedes intentar ejecutar nuevamente el comando composer install

# Solución de problemas de extensiones adicionales

## Para Ubuntu:

### Si necesitas instalar o habilitar las extensiones xml, dom,gd y zip en un entorno Ubuntu, puedes utilizar los siguientes comandos:

```bash
sudo apt-get install php8.1-xml
sudo apt-get install php8.1-dom
sudo apt-get install php8.1-zip
sudo apt-get install php8.1-gd
```

## Pasos para agregar alias a sail

```bash
nano ~/.zshrc
```

### Dentro del archivo `~/.zshrc`, agrega la siguiente línea al final:

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

### y por ultimo agregar los cambios:

```bash
source ~/.zshrc
```

### Una vez teniendo el alias desplegamos el proyecto con:

```bash
sail up
```
