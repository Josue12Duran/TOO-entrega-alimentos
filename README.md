# TOO - Entrega de Alimentos (MVC PHP)

Aplicación web MVC usando PHP, HTML, CSS, JS y Bootstrap.

Requisitos:
- XAMPP (Apache + PHP + MySQL)

Instalación rápida:
1. Copia el proyecto a tu carpeta de htdocs: `c:/xampp/htdocs/TOO-entrega-alimentos` (ya debe estar aquí).
2. Importa la base de datos desde `sql/entrega_alimentos.sql` usando phpMyAdmin o la consola MySQL.
3. Ajusta la conexión a la base de datos en `app/config.php` si es necesario (usuario/password).
4. Abre en el navegador: `http://localhost/TOO-entrega-alimentos/`.

Notas:
- Autenticación: se añadió login/logout y control básico por roles (admin, supervisor).
- Si deseas crear un usuario administrador de prueba o el primer usuario, existe el link `http://localhost/TOO-entrega-alimentos/tools/create_admin.php` en el proyecto.
