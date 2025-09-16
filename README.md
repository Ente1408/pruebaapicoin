Este es un proyecto para prueba de conocimiento, Soy samuel Andres Obando Villamil,👨‍💻 Desarrollador Web Full Stack con experiencia en la creación de soluciones robustas y escalables. A lo largo de mi carrera, he trabajado con tecnologías como Laravel, CodeIgniter, Composer, NPM, JavaScript, HTML y CSS, integrando tanto el frontend como el backend para ofrecer productos de alta calidad que resuelven necesidades reales.

Me apasiona el desarrollo de software eficiente, manteniendo siempre un enfoque en la optimización y en seguir las mejores prácticas de la industria. Además, disfruto del trabajo en equipo y la constante evolución del ecosistema tecnológico.

Siempre estoy abierto a nuevos retos y oportunidades para seguir aprendiendo y mejorando como profesional

📌 Análisis de Requisitos - De prueba Tecnica

🔹 1. Requisitos Funcionales (RF)

Autenticación de usuarios: El sistema debe permitir registro, login y seguridad básica para que cada inversor tenga su propio acceso.
El usuario podrá visuzizar las siguiente monedas virtuales BTC, ETH, SOL.
Visualización en dashboard:
    Mostrar nombre, símbolo, precio actual (USD), variación porcentual 24h y volumen 24h.
    Mostrar un gráfico con comparativo de precios.
Actualización automática: Refrescar los datos en intervalos definidos (ej: cada 5 min) sin recargar toda la página.
Responsividad: La interfaz debe adaptarse a diferentes dispositivos (móvil, tablet, desktop).

🔹 2. Requisitos No Funcionales (RNF)

Disponibilidad: El sistema debe estar disponible 24/7, ya que los mercados cripto funcionan en tiempo real.
Escalabilidad: Poder soportar un número creciente de usuarios y criptomonedas.
Seguridad:
    Manejo seguro de credenciales (usuarios y API Key).
    Uso de HTTPS.
Eficiencia:
    Minimizar peticiones innecesarias a la API de CoinMarketCap.
    Uso de jobs programados y caché para optimizar rendimiento.
Portabilidad: Ser accesible desde navegadores modernos sin necesidad de instalar software adicional.
Usabilidad: Interfaz clara y de fácil interpretación para los inversores.


## 📌 Requisitos
Asegúrate de tener instalado:  
- [PHP ^8.1](https://www.php.net/downloads)  
- [Composer](https://getcomposer.org/)  
- [Node.js & NPM](https://nodejs.org/)  
- [MySQL/MariaDB](https://www.mysql.com/)  
- Clave gratuita de [CoinMarketCap API](https://coinmarketcap.com/api/)  

---

## 🔧 Instalación paso a paso

### 1. Clonar el repositorio
###En una terminal agregar la siguiente informacion
```bash

git clone https://github.com/Ente1408/pruebaapicoin.git
cd pruebaapicoin

##siguiente paso instalar las dependencias

composer install
npm install

###Configurar entorno

##Copiar el archivo de entorno:
cp .env.example .env


##Generar la clave de la aplicación:

php artisan key:generate

##Configurar la base de datos en .env:

DB_DATABASE=crypto_dashboard
DB_USERNAME=root
DB_PASSWORD=


##Agregar tu API Key de CoinMarketCap en .env:
CMC_API_KEY=tu_api_key_aqui

##4. Migraciones
php artisan migrate

## Seeders
php artisan db:seed

##En dos terminales diferentes:

##Servidor de Laravel:

php artisan serve

##Compilador de assets con Vite:

npm run dev