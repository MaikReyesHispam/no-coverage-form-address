<?php
    // Ruta al archivo JSON de planes pospago
    $pathJSON = '../data/colombia.min.json';
    $jsonContent = file_get_contents($pathJSON);

    //echo "<script>console.log('Debug Objects: " . $jsonContent . "' );</script>";

    // Verificar si se pudo leer el archivo
    if ($jsonContent === false) {
        die('Error al leer el archivo JSON');
    }
    // Decodificar el JSON en un array asociativo
    $dataArray = json_decode($jsonContent, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/input.css">
    <link rel="stylesheet" href="assets/css/select-option.css">
    <link rel="stylesheet" href="assets/css/buttons.css">
    <link rel="stylesheet" href="assets/fonts/fonts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script>
        function updateOptions(value){
            const datos = <?php echo json_encode($dataArray); ?>;
            const citySelected = document.getElementById("city");
            citySelected.innerHTML = '';
            const citysList = datos.find(dep => dep.departamento == value);
            citysList.ciudades.forEach(city => {
                const option = document.createElement("option");
                option.value = city;
                option.text = city;
                citySelected.add(option);
            });
        }
    </script>
</head>
<body>
    <section class="bg-gray-light validate-box">        
        <div class="address-validate">
            <!-- <div class="go-back roboto-regular">
                <img src="assets/icons/arrow-left.svg" alt="go back" />
                Volver
            </div> -->
            <div class="d-space-between">
                <h2 class="mb-0">Crear usuario sin cobertura</h2>
                <button class='btn-secondary roboto-medium' onclick="goRegisters()">Ver registros</button>
            </div>
            <!-- <h2>¡Vamos a validar tu dirección!</h2> -->
            <form class="form" id="AddressForm" action="../admin/controller/AdminController.php" method="post">
                <h3>Datos personales</h3>
                <div class="col-3">
                    <div class="form-input">
                        <div class="label-box">
                            <input type="text" name="cc" id="cc" required>
                            <label class="label-name">
                                <span class="text-label roboto-regular">Número de documento</span>
                            </label>
                        </div>
                        <div class="icon-box">
                            <img src="assets/icons/id-card-light.svg" />
                        </div>                        
                    </div>
                    <div class="form-input">
                        <div class="label-box">
                            <input type="text" name="phone" id="phone" required>
                            <label class="label-name">
                                <span class="text-label roboto-regular">Número de celular</span>
                            </label>
                        </div>
                        <div class="icon-box">
                            <img src="assets/icons/phone.svg" />
                        </div>                        
                    </div>
                    <div class="form-input">
                        <div class="label-box">
                            <input type="text" name="email" id="email" required>
                            <label class="label-name">
                                <span class="text-label roboto-regular">Email</span>
                            </label>
                        </div>
                        <div class="icon-box">
                            <img src="assets/icons/email-light.svg" />
                        </div>                        
                    </div>
                </div>
                <h3>Información domicilio</h3>
                <div class="col-3">
                    <div class="form-select">
                        <div class="select">
                            <select class="select-text" name="department" id="department" required  onchange="updateOptions(this.value)">
                                <option value="" selected class="option-text"></option>
                                <?php foreach ($dataArray as $departament): ?>
                                    <option value="<?php echo htmlspecialchars($departament['departamento']); ?>" class="option-text">
                                        <?php echo htmlspecialchars($departament['departamento']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="select-bar"></span>
                            <label class="select-label">Departamento</label>
                         </div>
                    </div>
                    <div class="form-select">
                        <div class="select">
                            <select class="select-text" name="city" id="city" required>
                                <option value="" selected class="option-text"></option>
                                <option value="Lima" class="option-text">Lima</option>
                                <option value="Cusco" class="option-text">Cusco</option>
                                <option value="Huaraz" class="option-text">Huaraz</option>
                            </select>
                            <span class="select-bar"></span>
                            <label class="select-label">Ciudad</label>
                        </div>
                    </div>
                    <div class="form-input">
                        <div class="label-box">
                            <input type="text" name="municipalities" id="municipalities" required>
                            <label class="label-name">
                                <span class="text-label roboto-regular">Municipios</span>
                            </label>
                        </div>
                        <div class="icon-box">
                            <img src="assets/icons/pin-light.svg" />
                        </div>                        
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-select">
                        <div class="select">
                            <select class="select-text" name="typeOfAddress" id="typeOfAddress" required>
                                <option value="" selected class="option-text"></option>
                                <option value="apartado-aereo" class="option-text">Apartado aéreo</option>
                                <option value="autopista" class="option-text">Autopista</option>
                                <option value="avenida" class="option-text">Avenida</option>
                                <option value="avenida-calle" class="option-text">Avenida calle</option>
                                <option value="avenida-carrera" class="option-text">Avenida carrera</option>
                                <option value="calle" class="option-text">Calle</option>
                                <option value="diagonal" class="option-text">Diagonal</option>
                                <option value="kilometro" class="option-text">Kilometro</option>                                
                                <option value="transversal" class="option-text">Transversal</option>
                                <option value="otro" class="option-text">otro</option>
                            </select>
                            <span class="select-bar"></span>
                            <label class="select-label">Tipo de dirección</label>
                        </div>
                    </div>
                    <div class="form-input">
                        <div class="label-box">
                            <input type="text" name="numeroViaPrincipal" id="numeroViaPrincipal" required>
                            <label class="label-name">
                                <span class="text-label roboto-regular">Número vía principal</span>
                            </label>
                        </div>
                        <div class="icon-box">
                            <img src="assets/icons/pin-light.svg" />
                        </div>                        
                    </div>
                    <div class="form-input">
                        <div class="label-box">
                            <input type="text" name="numeroViaSecundaria" id="numeroViaSecundaria" required>
                            <label class="label-name">
                                <span class="text-label roboto-regular">Número vía secundaria</span>
                            </label>
                        </div>
                        <div class="icon-box">
                            <img src="assets/icons/pin-light.svg" />
                        </div>                        
                    </div>
                    <div class="form-input">
                        <div class="label-box">
                            <input type="text" name="placa" id="placa" required>
                            <label class="label-name">
                                <span class="text-label roboto-regular">Placa</span>
                            </label>
                        </div>
                        <div class="icon-box">
                            <img src="assets/icons/pin-light.svg" />
                        </div>                        
                    </div>
                </div>
                <div class="col-1">
                    <div class="form-input">
                        <div class="label-box">
                            <input type="text" name="complements" id="complements" required>
                            <label class="label-name">
                                <span class="text-label roboto-regular">Complementos</span>
                            </label>
                        </div>
                        <div class="icon-box">
                            <img src="assets/icons/question.svg" alt="Dirección" />
                        </div>                        
                    </div>
                </div>                
                <div class="box-content col-1-btn">
                    <button 
                        class='btn-primary roboto-medium disabled'
                        type="submit" 
                        id="sendBtn"
                        disabled     
                    >
                        Guardar dirección
                    </button>
                </div>
            </form>
        </div>        
    </section>
     <script>
        const inputsField = document.querySelectorAll(".label-box");

        for(i = 0; inputsField.length > i; i++){
            const input = inputsField[i]
            if(input.clientWidth < 120) {
                input.children[1].children[0].classList.add("truncate")
            } else {
                input.children[1].children[0].classList.remove("truncate");                
            }
        }

        function goRegisters() {
            window.location.href = "../admin/view/ViewUser.php";
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.getElementById('AddressForm');
            const submitBtn = document.getElementById('sendBtn');
            
            const validateForm = () => {
                let isValid = true;
                const inputs = form.querySelectorAll('input[required]');
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                    }
                });
                
                if (isValid) {
                    submitBtn.removeAttribute('disabled');
                    submitBtn.classList.remove('disabled');
                    submitBtn.classList.add('enabled');
                } else {
                    submitBtn.setAttribute('disabled', 'disabled');
                    submitBtn.classList.remove('enabled');
                    submitBtn.classList.add('disabled');
                }
            };

            form.addEventListener('input', validateForm);

            // Run validation on page load in case form is prefilled
            validateForm();
        });
    </script>
</body>
</html>