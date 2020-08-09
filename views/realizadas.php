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
            <div class="col-12 col-md-8 col-xl-9 col-lg-9 mx-auto mb-4">
                <div class="card overflow-auto" style="height: 26em;">
                    <div class="card-body">
                        <h2 class="card-title">Tareas realizadas</h2>
                        <section class="d-flex justify-content-center">
                            <p id="sin_tareas"> </p>
                        </section>
                        <ul class="list-group list-group-flush" id="lista_tareas">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('partials/_footer.php') ?>
    <script type="module" src="../../public/js/tareas_realizadas.js"></script>
</body>

</html>