<?php 

    class AdminController {

        // public function __construct(){
        //     $this->jsonFile = '../../data/data-form.json';
        // }
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
            
                // Aquí puedes procesar y enviar los datos según lo necesario
                // Por ejemplo, guardarlos en una base de datos o enviarlos por email
            
                // Ejemplo de salida simple
                // echo "<h1>Dirección Recibida</h1>";
                // echo "cc: " . htmlspecialchars($cc) . "<br>";
                // echo "PHONE: " . htmlspecialchars($phone) . "<br>";
                // echo "EMAIL: " . htmlspecialchars($email) . "<br>";

                 // Path al archivo JSON donde se almacenará la data
                $jsonFile = '../../data/data-form.json';

                // Verificar si el archivo JSON existe y tiene contenido
                if (file_exists($jsonFile) && filesize($jsonFile) > 0) {
                    // Leer el contenido actual del archivo JSON
                    $jsonData = file_get_contents($jsonFile);

                    // Decodificar el JSON a un array PHP
                    $datos = json_decode($jsonData, true);
                } else {
                    // Si el archivo no existe o está vacío, inicializar como un array vacío
                    $datos = [];
                }

                echo "<pre>";  // Esto es solo para hacer la salida más legible en el navegador
                print_r($jsonData);
                echo "</pre>";

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

                // Convertir el array PHP actualizado de nuevo a JSON
                $jsonDataUpdated = json_encode($datos, JSON_PRETTY_PRINT);

                // Escribir el JSON de vuelta al archivo
                if (file_put_contents($jsonFile, $jsonDataUpdated)) {
                    // echo "Los datos se han guardado correctamente en el archivo JSON.";
                    $this->redirect('../view/ViewUser.php');
                } else {
                    echo "Hubo un error al intentar guardar los datos en el archivo JSON.";
                }
            }
        }

        // public function getDataFromJson()  {
        //     $jsonData = file_get_contents($this->jsonFile);
        //     return json_decode($jsonData, true);
        // }

        // private function writeToJsonFile($data) {
        //     file_put_contents($this->jsonFile, json_encode($data, JSON_PRETTY_PRINT));
        // }
        private function redirect($location) {
            header("Location: $location");
            exit();
        }
    }

    // Instancia de la clase y manejo de la solicitud
    $adminController = new AdminController();
    $adminController->handleRequest();

?>