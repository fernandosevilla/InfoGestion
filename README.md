# InfoGestion

## Descripción del proyecto
El objetivo de este proyecto es disponer de una herramienta/plataforma donde cualquier miembro autorizado de Infofive, pueda ver de una forma rápida toda la situación actual de cualquier cliente registrado: qué servicios tiene contratados, inventarios de dispositivos, avisos, partes abiertos o finalizados y poder modificarlos.

### Fases de desarrollo
- Creación de clientes  
- Creación de artículos  
- Creación de técnicos/trabajadores  
- Definición y creación de servicios en InfoGestion  
- Vinculación de servicios con clientes (contratos)  
- Módulo de inventario de clientes  
- Módulo de avisos y partes de trabajo  
- Módulo de intervenciones (registro y ejecución de partes)  
- Sincronización de avisos/partes con Five ERP  
- Vinculación de partes de trabajo para facturación

## Tecnologías utilizadas
- **Backend:** Laravel 12  
- **Frontend reactivo:** Livewire 3  
- **Estilos:** Tailwind CSS 4 + componentes de Flowbite  
- **Base de datos:** MySQL
- **Control de versiones:** Git  
- **Planificación:** Notion

## Requisitos previos
- PHP ≥ 8.1  
- Composer ≥ 2.x  
- Node.js ≥ 18.x y npm (o Yarn)  
- Servidor de base de datos (MySQL 8)  

## Instalación y puesta en marcha

1. **Clonar el repositorio**  
   ```bash
   git clone https://github.com/fernandosevilla/InfoGestion.git
   cd InfoGestion

2. **Configurar variables de entorno**  
   ```bash
   cp .env.example .env
   # Edita .env y completa las credenciales de tu base de datos, correo, etc.

3. **Instalar dependencias**  
   ```bash
   composer install
   npm install

4. **Generar clave de aplicación**  
   ```bash
   php artisan key:generate

5. **Migrar la base de datos**  
   ```bash
   php artisan migrate

6. **Iniciar el servidor de desarrollo**  
   ```bash
   php artisan serve

7. **Compilar assets**  
   ```bash
   npm run dev

8. **Acceder a la aplicación**  
   Abre tu navegador y ve a http://127.0.0.1:8000
