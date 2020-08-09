<?php 
    require_once ('models/tareaModel.php');
    
    class InicioController {

        public function pendientes() {
            require_once ('views/pendientes.php');
        }

        public function realizadas() {
            require_once ('views/realizadas.php');
        }

        public function crear_tarea(){
            if( isset( $_POST['nombre'] ) ){
                $objTarea = new Tarea(); 
                $objTarea->setNombre( $_POST['nombre'] );
                $objTarea->setEmpresa( $_POST['empresa'] );
                $objTarea->setFecha_inicio( $_POST['fecha']  );
                $objTarea->setRuta( $_POST['ruta'] );
                $objTarea->setDescripcion( $_POST['descripcion'] );
                $objTarea->setFk_estado( 1 );
                $objTarea->crear_tarea();
                echo json_encode( 1001 );
            }
        }

        public function lista_tareas_pendientes() {
            if(isset($_POST['traer_pendientes']) && $_POST['traer_pendientes'] == 1001){
                $objTarea_pendientes = new Tarea();
                $resTarea_pendientes = $objTarea_pendientes->tareas_pendientes();
                
                if( $resTarea_pendientes != 1003 ){
                    echo json_encode( $resTarea_pendientes );
                }else {
                    echo json_encode( $resTarea_pendientes );
                }
            }
        }

        public function lista_tareas_realizadas() {
             if( isset( $_POST['traer_realizadas'] ) && $_POST['traer_realizadas'] == 1001 ){
                $objTarea_realizadas = new Tarea();
                $resTarea_realizadas = $objTarea_realizadas->tareas_realizadas();
                if( $resTarea_realizadas != 1003 ){
                    echo json_encode( $resTarea_realizadas ); 
                }else {
                    echo json_encode( $resTarea_realizadas );

                }
            }
        }

        public function actualizar_estado( $estado ) {
            if( isset( $_POST['realizar_tarea'] ) && $_POST['realizar_tarea'] == 1001 ){
                $objTarea = new Tarea();
                $objTarea->setId( $_POST['id'] );
                $objTarea->setFk_estado( $estado );
                if( $estado == 2 ) {
                    $objTarea->setFecha_fin( $_POST['fecha_fin'] );
                }
                $objTarea->actualizar_estado();
                echo json_encode( 1001 );
            }
        }

        public function param( $param ) {
            echo 'El valor del paramatro es:' . $param;
        }

    }