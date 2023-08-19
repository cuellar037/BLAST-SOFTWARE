<body>
    <div class="container-sm">
        <div class="header">
            <a href="?b=index&s=Inicio&p=admin"><i class="fa-solid fa-arrow-left"></i></a>
            <div>
                <a href="?b=restorepassword&s=Inicio"><i class="fa-solid fa-key"></i><span>Cambiar contraseña</span></a>
                <a onclick="destroySession()"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Cerrar Sesion</span></a>
            </div>
        </div>
        <main style="display: block">
            <div class="container-left">
                <div class="left">
                    <button class="user-data">
                        <img src="assets/img/usuario.png" alt="">
                        <div>
                            <p><?php echo $user['nameuser'] . " " . $user['surnameuser']; ?></p>
                            <p><?php echo ($privilegios === $privUser) ? 'Cliente' : (($privilegios === $privRecepcionist) ? 'Recepcionista' : (($privilegios === $privDoctor) ? 'Doctor' : (($privilegios === $privAdmin) ? 'Administrador' : 'Indefinido'))); ?></p>
                            
                        </div>
                    </button>
                    <button class="profile-adm-btn"><i class="fa-solid fa-house-user"></i><p>Inicio</p></button>
                    <button class="profile-adm-btn"><i class="fa-solid fa-user-pen"></i><p style="white-space: nowrap">Datos del usuario</p></button>
                    <?php echo ($privilegios <> $privAdmin) ? "" : "<a href='?b=inventory&s=Inicio'><button><i class='fa-solid fa-boxes-stacked'></i><p>Inventarios</p></button></a>" ?>
                    <?php echo ($privilegios <> $privAdmin) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-users'></i><p>Proveedores</p></button>" ?>
                    <?php echo ($privilegios <> $privAdmin) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-user-gear'></i><p>Colaboradores</p></button>" ?>
                    <?php echo ($privilegios == $privUser) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-person-circle-check'></i><p>Clientes</p></button>" ?>
                    <button class="profile-adm-btn"><i class="fa-solid fa-dog"></i><p>Mascotas</p></button>
                    <?php echo ($privilegios == $privUser || $privilegios == $privRecepcionist) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-syringe'></i><p>Recetar</p></button>" ?>
                </div>
            </div>
            <div class="container-right">
                <div class="profile-adm welcome" id="container-right">
                    <h1>Bienvenido(a) al panel de <?php echo ($privilegios ===$privUser) ? 'Cliente' : (($privilegios === $privRecepcionist) ? 'Recepcionista' : (($privilegios === $privDoctor) ? 'Doctor' : (($privilegios === $privAdmin) ? 'Administrador' : 'Indefinido'))); ?></h1>
                    <p>Dirijase al menu lateral para poder navegar dentro del sitio. </p>
                    <i class="fa-solid fa-face-smile-beam"></i>
                </div>
                <div class="profile-adm container-right user" id="container-right2">
                    <div class="user-information">
                        <h1>Datos</h1>
                        <form id="form-user-information" action="?b=profile&s=updateUser" method="post">
                            <input name="id" type="hidden" value="<?php echo $user['iduser'] ?>" disabled>
                            <label for="name">Numero de identificacion*</label>
                            <input name="numid" type="number" value="<?php echo $user['dniuser'] ?>" disabled>
                            <label for="name">Nombres*</label>
                            <input type="text" name="name" id="ctNameUser"
                                value="<?php echo $user['nameuser'] ?? "Sin definir"; ?>" disabled>
                            <label for="surname">Apellidos *</label>
                            <input type="text" name="surname" id="ctSurNameUser"
                                value="<?php echo $user['surnameuser'] ?? "Sin definir"; ?>" disabled>
                            <label for="address">Direccion *</label>
                            <input type="text" name="addres" id="ctAdrUser" value="<?php echo $user['diruser']; ?>"
                                disabled>
                            <label for="zone">Zona: *</label>
                            <select name="zone" id="ctZone" disabled>
                                <option
                                    <?php echo ($user['zoneuser'] <> "urbana" && $user['zoneuser'] <> "rural") ? "selected" : "" ?>
                                    disabled></option>
                                <option <?php echo ($user['zoneuser'] === "rural") ? "selected" : "" ?> value="rural">
                                    rural</option>
                                <option <?php echo ($user['zoneuser'] === "urbana") ? "selected" : "" ?> value="urbana">
                                    urbana</option>
                            </select>
                            <div>
                                <div>
                                    <label for="email">Correo Eletrónico *</label>
                                    <input type="text" name="email" id="ctEmailUser"
                                        value="<?php echo $user['emailuser']; ?>" disabled>
                                </div>
                                <div>
                                    <label for="phone">Numero de Celular 1 *</label>
                                    <input type="number" name="phone" id="ctNumCelUser"
                                        value="<?php echo $user['phoneuser']; ?>" disabled>
                                </div>
                                <div>
                                    <label for="ctNumCel2">Numero de Celular 2</label>
                                    <input type="number" name="phone2" id="ctNumCel2"
                                        value="<?php echo $user['phonealtuser']; ?>" disabled>

                                </div>
                            </div>
                            <div class="updatebutton">
                                <span id="enableForm1"> Editar</span>
                            </div>

                            <input type="submit" name="btnUpdateProfile" value="Guardar">
                        </form>
                    </div>
                </div>
                <?php 
                if ($privilegios <> $privAdmin) {
                    echo "";
                } else {
                    echo "
                    <div class='profile-adm container-right2' id='container-right3'>
                        <div class='title'>
                            <h1>proveedores</h1>
                        </div>
                        <div class='table-container'>
                            <div class='form-container'>
                                <div class='input-group'>
                                    <a href='?b=profile&s=optionSaveRedirec&p=proveedor'><button class='btn btn-default' type='submit'>Agregar</button></a>
                                </div>
                                <form action='?b=profile&s=buscarProveedor' method='post'>
                                    <div class='input-group'>
                                        <input type='text' id='searchprov' class='form-control search-input' placeholder='Buscar Proveedor' name='buscar_proveedor'>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class='table-container'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombres</th>
                                    <th>Direccion</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                </tr>
                            </thead>
                            <tbody id='resultados-proveedor'>";
                            foreach ($proveedores as $proveedor) {
                                echo "
                                    <tr>
                                        <td>" . $proveedor['idprov'] . "</td>
                                        <td>" . ($proveedor['nomprov'] ?? 'Sin definir') . "</td>
                                        <td>" . ($proveedor['dirprov'] ?? 'Sin definir') . "</td>
                                        <td>" . ($proveedor['emaprov'] ?? 'Sin definir') . "</td>
                                        <td>" . ($proveedor['telprov'] ?? 'Sin definir') . "</td>
                                        <td class='icons1'>
                                            <a href='?b=profile&s=optionEditRedirec&p=proveedor&idprov=" . $proveedor['idprov'] . "' id='Proveedor'>
                                                <i class='fa fa-pencil fa-lg' aria-hidden='true'></i>
                                            </a>
                                        </td>
                                        <td class='icons2'>
                                            <a onclick='alertProfile(this.id, \"proveedor\", \"" . addslashes($proveedor['nomprov']) . "\")' id='" . $proveedor['idprov'] . "'>
                                                <i class='fa-solid fa-trash-can' aria-hidden='true'></i>
                                            </a>
                                        </td>
                                    </tr>";
                            }
                            echo "
                            </tbody>
                        </table>
                    </div>";
                    echo "
                        <div class=\"profile-adm container-right3\" id=\"container-right4\">
                            <div class=\"title\">
                                <h1>Colaboradores</h1>
                            </div>
                            <div class=\"table-container\">
                                <div class=\"form-container\">
                                    <div class=\"input-group\">
                                        <span class=\"input-group-btn\">
                                            <a href=\"?b=profile&s=optionSaveRedirec&p=Colaborador\"><button class=\"btn btn-default\" type=\"submit\">Agregar</button></a>
                                        </span>
                                    </div>
                                    <form method=\"POST\" action=\"?b=profile&s=buscarColaborador\">
                                        <div class=\"input-group\">
                                            <input type=\"text\" class=\"form-control search-input\" id=\"searchcol\" placeholder=\"Buscar Empleado\" name=\"buscar_empleado\">
                                            <span class=\"input-group-btn\">
                                                <button class=\"btn btn-default\" id=\"miBoton\" type=\"button\">Buscar</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class=\"table-container\">
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Nickuser</th>
                                        <th>Email</th>
                                        <th>Direccion</th>
                                        <th>Zona</th>
                                        <th>Telefono</th>
                                        <th>Telefono Alt.</th>
                                        <th>Privilegios</th>
                                    </tr>
                                </thead>
                                <tbody id=\"resultados-empleados\">";
                        foreach ($users as $key => $colaborador) {
                            $value = $colaborador['privileges'];
                            $user = isset($roles[$value]) ? $roles[$value] : "";

                            if (!empty($user)) {
                                echo "
                                <tr>
                                    <td>" . $colaborador['dniuser'] . "</td>
                                    <td>" . $colaborador['nameuser'] . "</td>
                                    <td>" . $colaborador['surnameuser'] . "</td>
                                    <td>" . $colaborador['nickuser'] . "</td>
                                    <td>" . $colaborador['emailuser'] . "</td>
                                    <td>" . $colaborador['diruser'] . "</td>
                                    <td>" . $colaborador['zoneuser'] . "</td>
                                    <td>" . $colaborador['phoneuser'] . "</td>
                                    <td>" . $colaborador['phonealtuser'] . "</td>";
                                    echo "
                                        <td>" . (($colaborador['privileges'] == $privRecepcionist) ? 'Recepcionista' : (($colaborador['privileges'] == $privDoctor) ? 'Doctor' : '')) . "</td>";
                                    echo "
                                    <td class=\"icons1\">
                                        <a href=\"?b=profile&s=optionEditRedirec&p=colaborador&idcola=" . $colaborador['dniuser'] . "\">
                                            <i class=\"fa fa-pencil fa-lg\" aria-hidden=\"true\"></i>
                                        </a>
                                    </td>
                                    <td class=\"icons2\">
                                        <a onclick=\"alertProfile(this.id, 'colaborador')\" id=\"" . $colaborador['dniuser'] . "\">
                                            <i class=\"fa-solid fa-trash\"></i>
                                        </a>
                                    </td>
                                </tr>";
                            }
                        }
                        echo "
                                </tbody>
                            </table>
                        </div>";
                }
                ?>
                <div class='profile-adm container-right4' id='container-right5'>
                        <div class='title'>
                            <h1>Clientes</h1>
                        </div>
                        <div class='table-container'>
                            <div class='form-container'>
                                <form method='POST' action='?b=profile&s=buscarClientes'>
                                    <div class='input-group'>
                                        <input type='text' class='form-control search-input' placeholder='Buscar cliente' name='buscar_cliente' id='searchcli'>
                                        <span class='input-group-btn'>
                                            <button class='btn btn-default' id='miBoton' type='button'>Buscar</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class='table-container'>
                            <thead>
                                <tr>
                                    <th>N° Identificacion</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Usuario</th>
                                    <th>Direccion</th>
                                    <th>Zona</th>
                                    <th>Telefono</th>
                                    <th>Telefono Alternaivo</th>
                                </tr>
                            </thead>
                            <tbody id='resultados'>
                                <?php 
                                    foreach ($users as $key=>$cliente) {
                                        if($cliente['privileges'] == Privilegios::User->get()){  
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $cliente['dniuser']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cliente['nameuser']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cliente['surnameuser']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cliente['nickuser']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cliente['emailuser']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cliente['zoneuser']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cliente['phoneuser']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cliente['phonealtuser']; ?>
                                    </td>
                                    <td class='icons1'>
                                        <a href='?b=profile&s=optionEditRedirec&p=cliente&idcli=<?= $cliente['dniuser']; ?>'>
                                            <i class='fa fa-pencil fa-lg' aria-hidden='true'></i>
                                        </a>
                                    </td>
                                    <td class='icons2'>
                                        <a onclick='alertProfile(this.id, 'cliente')' id='<?php echo $cliente['dniuser']; ?>'>
                                            <i class='fa-solid fa-trash-can' aria-hidden='true'></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                        }   
                                    } 
                                ?>
                            </tbody>
                        </table>
                </div>
                <div class="profile-adm container-right5" id="container-right6">
                    <div class="title">
                        <h1>mascota</h1>
                    </div>
                    <div class="table-container">
                        <div class="form-container">
                            <form method="POST" action="?b=profile&s=buscarMascotas">
                                <div class="input-group">
                                    <input type="text" class="form-control search-input" placeholder="Buscar mascota"
                                        name="buscar_mascota" id="searchmas">
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table-container">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Genero</th>
                                <th>Especie</th>
                                <th>Numero de identificacion del dueño</th>
                            </tr>
                        </thead>
                        <?php foreach ($mascota as $m) { ?>
                        <tbody id="resultados">
                            <tr>
                                <td>
                                    <?php echo $m['idmas']; ?>
                                </td>
                                <td>
                                    <?php echo $m['nommas']; ?>
                                </td>
                                <td>
                                    <?php echo $m['edadmas']; ?>
                                </td>
                                <td>
                                    <?php echo $m['genmas']; ?>
                                </td>
                                <td>
                                    <?php echo $m['espmas']; ?>
                                </td>
                                <td>
                                    <?php echo $m['idcli']; ?>
                                </td>
                                <td class="icons1">
                                    <a href="?b=profile&s=optionEditRedirec&p=mascota&idmas=<?= $m['idmas']; ?>">
                                        <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="icons2">
                                    <a onclick="alertProfile(this.id, 'mascota')" id="<?php echo $m['idmas']; ?>">
                                        <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
                <?php 
                if ($privilegios == $privUser || $privilegios == $privRecepcionist) {
                    echo "";
                } else {
                    echo "
                    <div class='profile-adm container-right2' id='container-right7'>
                        <div class='title'>
                            <h1>Recetar Productos</h1>
                        </div>
                        <form action='#' method='post'>
                            <div class='header-receta'>
                                <h1>Datos del Colaborador</h1>
                                <div class='colaborador'>
                                    <div>
                                        <div>
                                            <input type='number' name='numidcol' id='numIdColaborador' placeholder='Numero de identificacion del colaborador'>
                                            <button id='searchCol'>Buscar colaborador</button>
                                        </div>
                                        <input disabled type='date' name='date' id='date-receta'  placeholder='Fecha Actual'>
                                    </div>
                                    <div>
                                        <input type='text' name='namecol' id='name-col' placeholder='Nombre del Colaborador'>
                                    </div>
                                </div>
                                <h1>Datos de Usuario y Paciente</h1>
                                <div class='Usuario'>
                                    <div>
                                        <div>
                                            <input type='number' name='numiduser' id='input-receta' placeholder='Numero de identificacion del usuario'>
                                            <button id='searchUser'>Buscar usuario</button>
                                        </div>
                                    </div>
                                    <div>
                                        <input type='text' name='nameuser' id='input-receta' placeholder='Nombre del usuario'>&nbsp; &nbsp; &nbsp; 
                                        <input type='text' name='addres' id='input-receta' placeholder='Direccion del usuario'>&nbsp; &nbsp; &nbsp;
                                        <select name='selMas' id='input-receta'>
                                        <option disabled selected>Seleccione una opcion</option>
                                        ";
                                        foreach($mascota as $m) {
                                            echo "<option>".$m['nommas']."</option>";
                                        }
    
                                        echo "
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <table class='table-container'>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Producto</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Categoria</th>
                                        <th>Disponibles (und)</th>
                                        <th>Recetar</th>
                                    </tr>
                                </thead>
                                <tbody id='resultados-producto'>";

                                foreach ($productos as $key=>$producto) {
                                    echo "
                                        <td>" . $producto['idprod'] . "</td>
                                        <td>" . ($producto['nomprod'] ?? 'Sin definir') . "</td>
                                        <td>" . ($producto['desprod'] ?? 'Sin definir') . "</td>
                                        <td>" . ($producto['precvenprod'] ?? 'Sin definir') . "</td>
                                        <td>";
                                    foreach ($categorias as $categoria) {
                                        echo ($categoria['idcat'] === $producto['catprod']) ? $categoria['namecat'] : '';
                                    }
                                    echo "</td>
                                        <td>" . ($producto['stockprod'] ?? 'Sin definir') . "</td>";
                                    echo "<td><input type='checkbox' name='recetar'></td>
                                    </tr>";
                                }
                                echo "
                                </tbody>
                            </table>
                            <button id='addReceta'>Agregar a la receta</button>
                            <table class='table-container'>
                                <thead>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </thead>
                                <tbody id='resultados-receta'>

                                </tbody>
                            </table>

                            <div class='footer-receta'>
                                <h2>Total a pagar: $ <span id='total-pagar'></span></h2>
                            </div>
                        </form>
                    </div>";
                }
                ?>

            </div>
        </main>

    </div>
    <!-- Alerts -->
    <script src="assets/Javascript/alert-profile.js"></script>

    <!-- Menu Profile -->
    <script src="assets/Javascript/menu-profile-administrator.js"></script>
    <!-- Calendar -->
    <script src="assets/Javascript/calendar.js"></script>
    <!-- Form Disable and Enable -->
    <script src="assets/Javascript/form-disable-enable.js"></script>
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="assets/Javascript/real_time_search.js"></script>
</body>

</html>