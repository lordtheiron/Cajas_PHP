<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Blank Page - Boxed</title>
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
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-window-maximize"></i><span>Registrar Estantería</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Controladores/ControladorListarEstanterias.php"><i class="fas fa-table"></i><span>Listar Estanterias</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Controladores/ControladorEstanteriasLibres.php"><i class="fas fa-window-maximize"></i><span>Registrar Caja</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Controladores/ControladorListarCajas.php"><i class="fas fa-table"></i><span>Listar Cajas</span></a></li>
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
                    <div class="container-fluid">
                        <section class="register-photo" style="background-color: transparent;padding: 10px 0px;">
                            <div class="form-container" style="margin-top: 40px;">
                                <div class="image-holder" style="background: url(&quot;../assets/img/Imagenes/almacenes_automaticos_y_transelevadores_18.jpg&quot;) bottom / cover no-repeat;"></div>
                                <form method="post" action="afterRegister.html" style="height: 525px;" action="../Controladores/ControladorInsertarEstanteria.php">
                                    <h2 class="text-center"><strong>Registrar Estantería</strong></h2>
                                    <div class="form-group mb-3"><input class="form-control" type="text" name="codigo" placeholder="Código"></div>
                                    <script>
                                        // Submit button made with javascript
                                        function changePassword() {
                                            var password = document.querySelector("#password").value;
                                            var confirmPassword = document.querySelector("#confirmPassword").value;

                                            if (password.length >= 8) {
                                                if (password === confirmPassword) {
                                                    var btn = $('#submitButton').removeAttr("disabled");
                                                    document.querySelector('#passwordsError').style.display = 'none';
                                                    console.log("enabling")
                                                } else {
                                                    var btn = $('#submitButton').attr("disabled", "true");
                                                    document.querySelector('#passwordsError').style.display = 'block';
                                                    document.querySelector('#errorMessage').innerHTML = 'The passwords do not match';
                                                    console.log("disabling")
                                                }
                                            } else {
                                                var btn = $('#submitButton').attr("disabled", "true");
                                                document.querySelector('#passwordsError').style.display = 'block';
                                                document.querySelector('#errorMessage').innerHTML = 'The password must be at least 8 characters long';
                                                console.log("disabling")
                                            }
                                        }
                                    </script>
                                    <div class="form-group mb-3">
                                        <input class="form-control" type="text" name="material" placeholder="Material">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input class="form-control" type="text" name="nLejas" placeholder="Nº Lejas">
                                    </div>
                                    <div class="form-group mb-3">
                                        <h2 class="text-center d-inline-flex"><strong>Ubicación:</strong>
                                            <select class="form-select d-inline-flex d-xl-flex flex-row justify-content-xl-start align-items-xl-start" style="width: 99.391px;" name="pasillo">
                                                <option value="null" selected="">Pasillo</option>
                                                <option value="13">This is item 2</option>
                                                <option value="14">This is item 3</option>
                                            </select>
                                            <select class="form-select d-inline-flex d-xl-flex flex-row justify-content-xl-start align-items-xl-start" style="width: 101.391px;" name="hueco">
                                                <option value="null" selected="">Hueco</option>
                                                <option value="13">This is item 2</option>
                                                <option value="14">This is item 3</option>
                                            </select>
                                        </h2>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input class="form-control" type="date" name="fAlta">
                                    </div>
                                    <div class="form-group mb-3">
                                        <button class="btn btn-primary d-block w-100" id="submitButton" type="submit" style="color: rgb(255,255,255);background-color: #00b5a8;">Registrar Estantería</button>
                                    </div>
                                </form>
                            </div>
                        </section>
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