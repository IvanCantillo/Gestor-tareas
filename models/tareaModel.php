<?php 
    require_once ('config/Conexion.php');
    class Tarea {
        private $id;
        private $nombre;
        private $descripcion;
        private $empresa;
        private $ruta;
        private $fecha_inicio;
        private $fecha_fin;
        private $fk_estado;
        public $conexion;

        public function __construct(){
            $this->conexion = Conexion::Conectar();
        }

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getNombre(){
            return $this->nombre;
        }
    
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
    
        public function getDescripcion(){
            return $this->descripcion;
        }
    
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
    
        public function getEmpresa(){
            return $this->empresa;
        }
    
        public function setEmpresa($empresa){
            $this->empresa = $empresa;
        }
    
        public function getRuta(){
            return $this->ruta;
        }
    
        public function setRuta($ruta){
            $this->ruta = $ruta;
        }
    
        public function getFecha_inicio(){
            return $this->fecha_inicio;
        }
    
        public function setFecha_inicio($fecha_inicio){
            $this->fecha_inicio = $fecha_inicio;
        }
    
        public function getFecha_fin(){
            return $this->fecha_fin;
        }
    
        public function setFecha_fin($fecha_fin){
            $this->fecha_fin = $fecha_fin;
        }
    
        public function getFk_estado(){
            return $this->fk_estado;
        }
    
        public function setFk_estado($fk_estado){
            $this->fk_estado = $fk_estado;
        }

        //------------------------------------------

        public function tareas_pendientes(){
            $sqlTareas = "SELECT * FROM tarea WHERE fk_estado = 1";
            $tareas = $this->conexion->prepare( $sqlTareas );
            $tareas->execute();
            if( $tareas->rowCount() > 0 ){
                return $tareas->fetchAll(PDO::FETCH_ASSOC);
            }else {
                return 1003;
            }
        }

        public function tareas_realizadas(){
            $sqlTareas = "SELECT * FROM tarea WHERE fk_estado = 2";
            $tareas = $this->conexion->prepare( $sqlTareas );
            $tareas->execute();
            if( $tareas->rowCount() > 0 ){
                return $tareas->fetchAll(PDO::FETCH_ASSOC);
            }else {
                return 1003;
            }
        }

        public function crear_tarea(){
            $sqlCrear = "INSERT INTO `tarea`(`nombre`, `descripcion`, `empresa`, `ruta`, `fecha_inicio`, `fk_estado`)
                         VALUES ( :nombre, :descripcion, :empresa, :ruta, :fecha_inicio, :fk_estado)";
            $crear = $this->conexion->prepare( $sqlCrear );
            $crear->execute( array( ":nombre" => $this->nombre, ":descripcion" => $this->descripcion, ":empresa" => $this->empresa,  
                                   ":ruta" => $this->ruta, ":fecha_inicio" => $this->fecha_inicio, ":fk_estado" => $this->fk_estado) );
            return $crear;
        }

        public function actualizar_estado() {
            if( $this->fk_estado == 2 ){
                $sqlEstado = "UPDATE tarea SET fk_estado = :fk_estado, fecha_fin = :fecha_fin WHERE id = :id";
            }else{
                $sqlEstado = "UPDATE tarea SET fk_estado = :fk_estado WHERE id = :id";                
            }
            $estado = $this->conexion->prepare( $sqlEstado );
            if( $this->fk_estado == 2 ){
                $estado->execute( array( ":fk_estado" => $this->fk_estado, ":fecha_fin" => $this->fecha_fin, ":id" => $this->id ) );
            }else{
                $estado->execute( array( ":fk_estado" => $this->fk_estado, ":id" => $this->id ) );
            }
            return $estado->rowCount();
        }

    }
?>