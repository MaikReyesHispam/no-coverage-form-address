<?php 

    class AdminController {

        public function handleRequest() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $cc = $_POST['cc'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $department = $_POST['department'];
                $city = $_POST['city'];
                $typeOfAddress = $_POST['typeOfAddress'];
                $numeroViaPrincipal = $_POST['numeroViaPrincipal'];
                $numeroViaSecundaria = $_POST['numeroViaSecundaria'];
                $placa = $_POST['placa'];
                $complements = $_POST['complements'];         

                $jsonFile = '../../data/data-form.json';

                if (file_exists($jsonFile) && filesize($jsonFile) > 0) {
                    $jsonData = file_get_contents($jsonFile);

                    $datos = json_decode($jsonData, true);
                } else {
                    $datos = [];
                }

                $datos[] = [
                    'document_number' => $cc,
                    'phone' => $phone,
                    'email' => $email,
                    'department' => $department,
                    'city' => $city,
                    'type_of_address' => $typeOfAddress,
                    'main_road_number' => $numeroViaPrincipal,
                    'secondary_road_number' => $numeroViaSecundaria,
                    'plate' => $placa,
                    'complements' => $complements,
                ];

                $jsonDataUpdated = json_encode($datos, JSON_PRETTY_PRINT);

                if (file_put_contents($jsonFile, $jsonDataUpdated)) {
                    $this->redirect('../view/ViewUser.php');
                } else {
                    echo "Hubo un error al intentar guardar los datos en el archivo JSON.";
                }
            }
        }

        private function redirect($location) {
            header("Location: $location");
            exit();
        }
    }

    $adminController = new AdminController();
    $adminController->handleRequest();

?>