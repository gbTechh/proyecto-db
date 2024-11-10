# Mini Framework PHP MVC

Un framework PHP ligero y fácil de usar, construido siguiendo el patrón MVC (Modelo-Vista-Controlador). Diseñado para proyectos pequeños y medianos que necesitan una estructura organizada pero flexible.

## Estructura del Proyecto

```
/proyecto
├── app/
|   ├── config/
│   │   └── config.php
│   ├── controllers/
│   │   ├── admin/
│   │   │   ├── AdminController.php
│   │   │   ├── DashboardController.php
│   │   │   └── EmpleadosController.php
│   │   ├── HomeController.php
│   │   └── ErrorController.php
│   ├── models/
│   │   ├── Empleado.php
│   │   └── EmpleadoModel.php
│   └── views/
│       ├── layouts/
│       │   ├── default.php
│       │   └── admin.php
│       ├── admin/
│       │   └── empleados/
│       │       ├── index.php
│       │       └── crear.php
│       └── home/
│           └── index.php
├── core/
│   ├── Controller.php
│   ├── Model.php
│   ├── Router.php
│   └── Layout.php
├── public/
│   ├── css/
│   ├── js/
│   ├── img/
│   ├── .htaccess
│   └── index.php
└── README.md
```

## Configuración Inicial

1. Clonar el repositorio
2. Configurar el archivo `config/config.php`:
```php
// Configuración de base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'nombre_base_datos');

// URL base
define('BASE_URL', '/nombre_proyecto');
```

3. Asegurarse que el servidor Apache tiene mod_rewrite habilitado


## Configuración en Windows con XAMPP

1. **Habilitar mod_rewrite en XAMPP**:
   - Abrir `xampp/apache/conf/httpd.conf`
   - Buscar la línea `#LoadModule rewrite_module modules/mod_rewrite.so`
   - Quitar el `#` para descomentar la línea
   - Reiniciar Apache desde el panel de XAMPP

2. **Configurar Virtual Host** (Opcional pero recomendado):
   - Abrir `xampp/apache/conf/extra/httpd-vhosts.conf`
   - Agregar:
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/tu_proyecto/public"
       ServerName tu-proyecto.local
       <Directory "C:/xampp/htdocs/tu_proyecto/public">
           Options Indexes FollowSymLinks MultiViews
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```
   - Agregar en `C:\Windows\System32\drivers\etc\hosts`:
   ```
   127.0.0.1 tu-proyecto.local
   ```

4. Configurar los permisos de carpetas:
   - `public/` debe ser accesible desde web
   - Resto de carpetas fuera del alcance web

## Estructura MVC

### Modelos

Los modelos se dividen en dos tipos:
1. Entidades: Representan objetos de negocio
2. Modelos: Manejan la lógica de base de datos

Ejemplo de Entidad:
```php
class Empleado {
    private $dni;
    private $nombre;
    
    public function __construct($dni, $nombre) {
        $this->dni = $dni;
        $this->nombre = $nombre;
    }
    
    public function getDni() {
        return $this->dni;
    }
}
```

Ejemplo de Modelo:
```php
class EmpleadoModel extends Model {
    public function getAll() {
        $sql = "SELECT * FROM empleados";
        return $this->executeQuery($sql);
    }
}
```

### Controladores

Los controladores manejan la lógica de la aplicación:

```php
class EmpleadosController extends Controller {
    public function index() {
        $data = [
            'title' => 'Lista de Empleados',
            'empleados' => $this->empleadoModel->getAll()
        ];
        $this->view('empleados/index', $data);
    }
}
```

### Vistas

Las vistas renderizan la interfaz de usuario:

```php
<!-- views/empleados/index.php -->
<h1><?php echo $title; ?></h1>
<div class="empleados-list">
    <?php foreach($empleados as $empleado): ?>
        <div class="empleado-item">
            <?php echo $empleado->getNombre(); ?>
        </div>
    <?php endforeach; ?>
</div>
```

## Routing

El sistema de rutas sigue el patrón: `controlador/metodo/parametros`

Ejemplos:
- `/empleados` → `EmpleadosController->index()`
- `/empleados/crear` → `EmpleadosController->crear()`
- `/empleados/editar/123` → `EmpleadosController->editar('123')`

### Rutas Admin

Las rutas que comienzan con `admin/` son manejadas especialmente:
- Usan el layout admin
- Requieren autenticación
- Se cargan desde la carpeta `controllers/admin/`


## Layouts

Los layouts definen la estructura común de las páginas:

```php
<!-- layouts/default.php -->
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
</head>
<body>
    <?php echo $content; ?>
</body>
</html>
```

## Base de Datos

La clase `Model` proporciona métodos para interactuar con la base de datos:

```php
protected function executeQuery($sql, $params = []) {
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($params);
}
```

## Buenas Prácticas

1. **Nombres de Archivos**
   - Controladores: `NombreController.php`
   - Modelos: `NombreModel.php`
   - Vistas: `nombre.php`

2. **Organización**
   - Un controlador por entidad
   - Separar lógica de negocio en modelos
   - Mantener vistas simples

3. **Seguridad**
   - Usar PDO con prepared statements
   - Validar entrada de usuarios
   - Sanitizar salida en vistas

## Ejemplos de Uso

### Crear un Nuevo Controlador

```php
class ProductosController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->productoModel = new ProductoModel();
    }

    public function index() {
        $data = ['productos' => $this->productoModel->getAll()];
        $this->view('productos/index', $data);
    }
}
```


## Estructura de Assets (CSS y JavaScript)

La estructura de archivos CSS y JS sigue una convención que permite cargar automáticamente los estilos y scripts según el controlador y vista actual:

```
/public
├── css/
│   ├── main.css           # Estilos globales
│   ├── default.css        # Estilos para layout default
│   ├── admin.css          # Estilos para layout admin
│   ├── home.css           # Estilos para ruta home (HomeController)
│   ├── admin/
│   │   ├── dashboard.css  # Estilos específicos para DashboardController
│   │   ├── clientes.css   # Estilos específicos para ClientesController
│   │   └── empleados.css  # Estilos específicos para EmpleadosController
├── js/
    ├── main.js            # Scripts globales
    ├── default.js         # Scripts para layout default
    └── admin/
        ├── main.js        # Scripts base para admin
        ├── dashboard.js   # Scripts específicos para DashboardController
        ├── clientes.js    # Scripts específicos para ClientesController
        └── empleados.js   # Scripts específicos para EmpleadosController
```

### Jerarquía de Estilos

1. **Estilos Globales** (`main.css`):
   - Cargado en todas las páginas
   - Contiene estilos base, variables CSS, reset, etc.

2. **Estilos de Layout**:
   - `default.css`: Para el layout público
   - `admin/main.css`: Base para toda el área administrativa
   
3. **Estilos Específicos**:
   - Nombrados según el controlador: `admin/clientes.css`
   - Cargados automáticamente cuando se usa el controlador correspondiente

### Carga de Assets en Controladores

Los controladores pueden cargar estilos y scripts específicos:

```php
class ClientesController extends AdminController {
    public function __construct() {
        parent::__construct();
        
        // Cargar CSS específico para clientes
        $this->layout->addStyle('admin/clientes');
        
        // Cargar JavaScript específico
        $this->layout->addScript('admin/clientes');
    }
}
```

### Método addStyle y addScript

En la clase Layout:
```php
class Layout {
    private $styles = [];
    private $scripts = [];

    public function addStyle($stylesheet) {
        if (!in_array($stylesheet, $this->styles)) {
            $this->styles[] = $stylesheet;
        }
    }

    public function addScript($script) {
        if (!in_array($script, $this->scripts)) {
            $this->scripts[] = $script;
        }
    }

    public function renderStyles() {
        foreach ($this->styles as $style) {
            echo "<link rel='stylesheet' href='" . BASE_URL . "/css/{$style}.css'>\n";
        }
    }

    public function renderScripts() {
        foreach ($this->scripts as $script) {
            echo "<script src='" . BASE_URL . "/js/{$script}.js'></script>\n";
        }
    }
}
```

### Orden de Carga de Assets

1. **Layout Default**:
```html
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/default.css">
    <?php $this->renderStyles(); ?>
</head>
<body>
    <!-- Contenido -->
    <script src="/js/main.js"></script>
    <script src="/js/default.js"></script>
    <?php $this->renderScripts(); ?>
</body>
</html>
```

2. **Layout Admin**:
```html
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin/main.css">
    <?php $this->renderStyles(); ?>
</head>
<body>
    <!-- Contenido Admin -->
    <script src="/js/main.js"></script>
    <script src="/js/admin/main.js"></script>
    <?php $this->renderScripts(); ?>
</body>
</html>
```

### Ejemplo Práctico

1. **Controller**:
```php
class ClientesController extends AdminController {
    public function __construct() {
        parent::__construct();
        $this->layout->addStyle('admin/clientes');  // Cargará /css/admin/clientes.css
        $this->layout->addScript('admin/clientes'); // Cargará /js/admin/clientes.js
    }
}
```

2. **CSS Específico** (`public/css/admin/clientes.css`):
```css
.clientes-container {
    padding: 20px;
}

.cliente-card {
    border: 1px solid #ddd;
    margin: 10px;
    padding: 15px;
}
```

3. **JavaScript Específico** (`public/js/admin/clientes.js`):
```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Lógica específica para la sección de clientes
    console.log('Módulo de clientes cargado');
});
```

### Agregar imágenes

Para agregar impagenes de una manera fácil puedes usar este método, solo necesitas poner la iamgen dentro de la carpeta public/img, por ejemplo agergamos una imagen llamada logo.png:

```
<img
  class="logo"
  src="<?php echo AssetHelper::image('logo.png'); ?>" alt="Travel agency" 
  height="50"
  width="50"
>
```