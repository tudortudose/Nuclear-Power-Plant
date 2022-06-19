<?php
class PowerPlants extends Controller
{
    public function __construct()
    {
        $this->plantModel = $this->model('PowerPlant');
    }

    public function insert($params)
    {
        $data = [
            'autor_id' => '',
            'nume' => '',
            'numar_reactoare' => '',
            'putere_reactor' => '',
            'altitudine' => '',
            'latitudine' => '',
            'longitudine' => ''
        ];

        foreach ($params as $param) {

            echo "<script>console.log('Debug in pp: " . $param . "' );</script>";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data

            $data = [
                'autor_id' => trim($params['author_id']),
                'nume' => trim($params['nume']),
                'numar_reactoare' => trim($params['numar_reactoare']),
                'putere_reactor' => trim($params['putere_reactor']),
                'altitudine' => trim($params['altitudine']),
                'latitudine' => trim($params['latitudine']),
                'longitudine' => trim($params['longitudine'])
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";

            if (1 == 1) {
                if ($this->plantModel->insert($data)) {
                } else {
                    die('Something went wrong.');
                }
            }
        }
    }

    public function getById($params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $results = $this->plantModel->getById($params['id']);

            $json_string = json_encode($results, JSON_PRETTY_PRINT);

            print_r($json_string);

            return $results;
        }
    }

    public function getAll()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //echo "<script>console.log('Debug Data nume: " . "In getAll" . "' );</script>";

            $results = $this->plantModel->getAll();

            $json_string = json_encode($results, JSON_PRETTY_PRINT);

            print_r($json_string);

            return $results;
        }
    }
}
