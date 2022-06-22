<?php
class PowerPlants extends Controller
{
    public function __construct()
    {
        $this->plantModel = $this->model('PowerPlant');
    }

    public function insert($params)
    {
        //echo "<script>console.log('Debug session user: " . $_SESSION['user_id'] . "' );</script>";
        
        $filepath = APPROOT . "/../public/ppImgs/" . $params['name'] . '.jpg';
        echo "<script>console.log('Debug Objects 1: " . $_FILES["ppImage"]["tmp_name"] . "' );</script>";
        echo "<script>console.log('Debug Objects 2: " . $filepath . "' );</script>";

        move_uploaded_file($_FILES["ppImage"]["tmp_name"], $filepath);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data

            $data = [
                'author_id' => $_SESSION['user_id'],
                'name' => trim($params['name']),
                'reactorCount' => trim($params['reactorCount']),
                'reactorPower' => trim($params['reactorPower']),
                'altitude' => trim($params['altitude']),
                'latitude' => trim($params['latitude']),
                'longitude' => trim($params['longitude'])
            ];

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

    public function getByName($params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $results = $this->plantModel->getByName($params['name']);

            $json_string = json_encode($results, JSON_PRETTY_PRINT);

            print_r($json_string);

            return $results;
        }
    }

    public function getAll()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $results = $this->plantModel->getAll();

            $json_string = json_encode($results, JSON_PRETTY_PRINT);

            print_r($json_string);

            return $results;
        }
    }
}
