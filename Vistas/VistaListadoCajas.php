<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Table - Boxed</title>
        <meta name="description" content="Sistema de gestión de almacén.">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka+One">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Indic+Siyaq+Numbers&amp;display=swap">
        <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css">
        <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
        <link rel="stylesheet" href="../assets/css/styles.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </head>

    <body id="page-top">
        <?php
        session_start();
        $ArrayObj = $_SESSION['$ArrayCaja'];
        ?>
        <div id="wrapper">
            <nav class="navbar navbar-dark sticky-top align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
                <div class="container-fluid d-flex flex-column p-0">
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="../index.php">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>Boxed</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item"><a class="nav-link" href="VistaInicio.html"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Controladores/controladorPasillo.php"><i class="fas fa-window-maximize"></i><span>Registrar Estantería</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Controladores/ControladorListarEstanterias.php"><i class="fas fa-table"></i><span>Listar Estanterias</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Controladores/ControladorEstanteriasLibres.php"><i class="fas fa-window-maximize"></i><span>Registrar Caja</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-table"></i><span>Listar Cajas</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Controladores/ControladorListarTodo.php"><i class="fas fa-tachometer-alt"></i><span>Inventario Completo</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="VistaBuscarCajas.php?opcion=borrar"><i class="fas fa-trash"></i><span>Registrar Salida de Caja</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="VistaBuscarEstanteria.php"><i class="fas fa-trash"></i><span>Retirar Estantería</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="VistaBuscarCajas.php?opcion=restaurar"><i class="fas fa-window-maximize"></i><span>Registrar Devolución</span></a></li>
                    </ul>
                    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
                </div>
            </nav>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                            <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                            </form>
                        </div>
                    </nav>
                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Listado de Cajas</h3>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Listado de Cajas</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 text-nowrap">
                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                    </div>
                                </div>
                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <td>Código</td>
                                                <td>Material</td>
                                                <td>Color</td>
                                                <td>Altura</td>
                                                <td>Anchura</td>
                                                <td>Profundidad</td>
                                                <td>Contenido</td>
                                                <td>Fecha de Alta</td>
                                                <td>Código estantería</td>
                                                <td>Leja</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($ArrayObj as $Object) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $Object->codigo_caja; ?></td>
                                                    <td><?php echo $Object->material_caja; ?></td>
                                                    <td style="background-color:<?php echo $Object->color; ?>"></td>
                                                    <td><?php echo $Object->alto; ?></td>
                                                    <td><?php echo $Object->ancho; ?></td>
                                                    <td><?php echo $Object->profundidad; ?></td>
                                                    <td><?php echo $Object->contenido; ?></td>
                                                    <td><?php echo $Object->fecha_alta_caja; ?></td>
                                                    <td><?php echo $Object->codigo_estanteria; ?></td>
                                                    <td><?php echo $Object->leja_ocupada; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        <tfoot>
                                            <tr>
                                                <td>Código</td>
                                                <td>Material</td>
                                                <td>Color</td>
                                                <td>Altura</td>
                                                <td>Anchura</td>
                                                <td>Profundidad</td>
                                                <td>Contenido</td>
                                                <td>Fecha de Alta</td>
                                                <td>Código estantería</td>
                                                <td>Leja</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 align-self-center">
                                        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                    </div>
                                    <div class="col-md-6">
                                        <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                            <ul class="pagination">
                                                <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>Copyright © Boxed 2022</span></div>
                    </div>
                </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="../assets/js/script.min.js"></script>
    </body>

</html>