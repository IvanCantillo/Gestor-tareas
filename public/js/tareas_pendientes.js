import { URL_BASE } from './parametros.js';

// Functions
async function traer_pendientes() {
    let data = new FormData();
    data.append('traer_pendientes', 1001); 
    let response = await fetch(URL_BASE + 'inicio/lista_tareas_pendientes/', {
        method: 'POST',
        headers: {
            Accept: "application/json",
        },
        body: data
    });
    return await response.json();
}
async function crear_tarea( data ) {
    data.append("fecha", Date.now());
    let response = await fetch(URL_BASE + 'inicio/crear_tarea/', {
        method: 'POST',
        headers: {
            Accept: "application/json",
        },
        body: data
    });
    return await response.json();
}
async function actualizar_estado( id ) { 
    let data = new FormData();
    data.append('realizar_tarea', 1001); 
    data.append('id', id);
    data.append('fecha_fin', Date.now());
    let response = await fetch(URL_BASE + 'inicio/actualizar_estado/2', {
        method: 'POST',
        headers: {
            Accept: "application/json",
        },
        body: data
    });
    return await response.json();
}
function estructura_tareas( id, nombre, fecha, ruta, descripcion, empresa ){
    let estructura = `
        <li id="tarea_${ id }" class="list-group-item border rounded mb-2">
            <section>
                <article class="d-flex justify-content-between">
                    <h5 class="font-weight-bold"> ${ nombre } </h5>
                    <small class="text-muted">Fecha: ${ moment( fecha ).format('DD/MM/YYYY') } </small>                                            
                </article>
                <article>
                    <small class="text-muted">Ruta: ${ ruta }</small>
                    <p>
                        ${ descripcion }<br>
                        <small class="text-muted">Empresa: ${ empresa }</small>
                    </p>
                </article>
                <button id="btn_realizar_${id}" class="btn btn-success"> Hecho </button>
           </section>
        </li>
    `;
    return estructura;
}
const lista_tareas = async () => {
    let res = await traer_pendientes();
    lista_tareas_pendientes.innerHTML = ""; 
    if( res != 1003 ){
        res.forEach(tarea => {
            lista_tareas_pendientes.innerHTML += estructura_tareas( tarea.id, tarea.nombre, parseInt(tarea.fecha_inicio), tarea.ruta, tarea.descripcion, tarea.empresa )
        });
    }else{
        sin_tareas.innerText = "No hay tareas pendientes.";
    }
}
function validar_datos() {
    if( !form_tareas.nombre.value.trim() ){
        error_nombre.innerText = "Escribe el nombre de la tarea";
        setTimeout(() => {
            error_nombre.innerText = "";            
        }, 3000);
        return 1003;
    }else if ( form_tareas.empresa.value == '0'  ) {
        error_empresa.innerText = "Selecciona una empresa";
        setTimeout(() => {
            error_empresa.innerText = "";            
        }, 3000);
        return 1003;
    }
    else if( !form_tareas.ruta.value.trim() ){
        error_ruta.innerText = "Escribe la ruta de la tarea";
        setTimeout(() => {
            error_ruta.innerText = "";            
        }, 3000);
        return 1003;
    }
    else if( !form_tareas.descripcion.value.trim() ){
        error_descripcion.innerText = "Escribe la descripcion de la tarea";
        setTimeout(() => {
            error_descripcion.innerText = "";            
        }, 3000);
        return 1003;
    }
}
const realizar_tarea = async () => {
    let tareas = await traer_pendientes();
    if( tareas.length > 0 ){
        tareas.forEach(tarea => {
            document.getElementById(`btn_realizar_${ tarea.id }`).addEventListener('click', async () => {
                let res = await actualizar_estado( tarea.id );
                console.log(res)
                if( res == 1001 ){
                    window.location = URL_BASE + "inicio/pendientes/";
                }
            })
        })
    }
}

// Initialitation of variables
const form_tareas = document.getElementById('form_tareas');
const lista_tareas_pendientes = document.getElementById('lista_tareas');
const error_nombre = document.getElementById('error_nombre');
const error_empresa = document.getElementById('error_empresa');
const error_ruta = document.getElementById('error_ruta');
const error_descripcion = document.getElementById('error_descripcion');
const sin_tareas = document.getElementById('sin_tareas');

// Methods
window.addEventListener('load', () => {
    lista_tareas();
    realizar_tarea();
})
form_tareas.addEventListener('submit', async (e) => {
    e.preventDefault();
    if( validar_datos() != 1003){
        sin_tareas.innerText = '';
        let data = new FormData( form_tareas );
        let res = await crear_tarea( data );
        if( res == 1001 ){
            window.location = URL_BASE + "inicio/pendientes/";
        }
    } 
})


