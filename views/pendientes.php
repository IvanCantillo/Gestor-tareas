<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once('partials/_styles.php') ?>
</head>

<body>
    <?php require_once('partials/_navbar.php') ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-xl-7 col-lg-7 mx-auto mb-4">
                <div class="card overflow-auto" style="height: 25.7em;">
                    <div class="card-body">
                        <h2 class="card-title">Tareas pendientes</h2>
                        <section class="d-flex justify-content-center">
                            <p id="sin_tareas">  </p>
                        </section>
                        <ul class="list-group list-group-flush" id="lista_tareas">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-5 col-lg-5 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Creacion de tareas</h2>
                        <form id="form_tareas">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Nombre" autocomplete="off">
                                <small id="error_nombre" class="text-muted text-error">  </small>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="empresa" id="empresa" required>
                                    <option value="0"> Seleccionar empresa </option>
                                    <option value="essmar"> Essmar </option>
                                    <option value="ceibas"> Ceibas </option>
                                </select>
                                <small id="error_empresa" class="text-muted text-error">  </small>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="ruta" name="ruta" required placeholder="Ruta del archivo">
                                <small id="error_ruta" class="text-muted text-error">  </small>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="descripcion" name="descripcion" required placeholder="Descripcion de la tarea" rows="3"></textarea>
                                <small id="error_descripcion" class="text-muted text-error">  </small>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('partials/_footer.php') ?>
    <script type="module" src="../../public/js/tareas_pendientes.js"></script>
</body>
</html>