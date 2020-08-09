import { URL_BASE } from './parametros.JS';

//Functions
async function traer_realizadas(){
    let data = new FormData();
    data.append("traer_realizadas", 1001);
    let response = await fetch( URL_BASE + "inicio/lista_tareas_realizadas/", {
        method: "POST",
        headers: {
            Accept: "application/json"
        },
        body: data
    });
    return response.json();
}
async function listar_tareas() {
    let res = await traer_realizadas();
    lista_tareas_realizadas.innerHTML = ""; 
    if( res.length > 0 ){
        res.forEach(tarea => {
            lista_tareas_realizadas.innerHTML += estructura_tarea( tarea.id, tarea.nombre, parseInt(tarea.fecha_fin), tarea.ruta, tarea.descripcion, tarea.empresa );
        });
    }else {
        sin_tareas.innerText = "No hay tareas realizadas."
    }
}
async function actualizar_estado( id ) { 
    let data = new FormData();
    data.append('realizar_tarea', 1001); 
    data.append('id', id);
    let response = await fetch(URL_BASE + 'inicio/actualizar_estado/1', {
        method: 'POST',
        headers: {
            Accept: "application/json",
        },
        body: data
    });
    return await response.json();
}
function estructura_tarea( id, nombre, fecha, ruta, descripcion, empresa ) {
    let estructura = `
        <li class="list-group-item border rounded mb-2">
            <section>
                <article class="d-flex justify-content-between">
                    <h5 class="font-weight-bold"> ${ nombre } <i class="fas fa-check-circle text-success"></i> </h5>
                    <small class="text-muted">Terminado: ${ moment( fecha ).format('DD/MM/YYYY') } </small>
                </article>
                <article>
                    <small class="text-muted">Ruta: ${ ruta }</small>
                    <p>
                        ${ descripcion }<br>
                        <small class="text-muted">Empresa: ${ empresa }</small>
                    </p>
                </article>
                <article class="d-flex justify-content-between">
                    <button id="btn_deshacer_${ id }" class="btn btn-primary"> Mover a pendientes </button>
                    <button id="btn_eliminar_${ id }" class="btn btn-danger"> Eliminar tarea </button>
                </article>
            </section>
        </li>
    `;
    return estructura;
}
const deshacer_tarea = async () => {
    let tareas = await traer_realizadas();
    if( tareas.length > 0 ){
        tareas.forEach(tarea => {
            document.getElementById(`btn_deshacer_${ tarea.id }`).addEventListener('click', async () => {
                let res = await actualizar_estado( tarea.id );
                if( res == 1001 ){
                    window.location = URL_BASE + "inicio/realizadas/";
                }
            })
        })
    }
}

//Initialitation of variables
const lista_tareas_realizadas = document.getElementById('lista_tareas');
const sin_tareas = document.getElementById('sin_tareas');

//Methods
window.addEventListener('load', () => {
    listar_tareas();
    deshacer_tarea();
})