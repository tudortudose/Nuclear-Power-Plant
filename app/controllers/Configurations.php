<?php
class Configurations extends Controller
{
    public function __construct()
    {
        $this->configurationModel = $this->model('Configuration');
    }

    public function insert($params)
    {
        $data = [
            'id_centrala' => '',
            'reactoare_active' => '',
            'temperatura_nucleu' => '',
            'putere_racire' => '',
            'putere_produsa' => '',
            'putere_ceruta' => '',
            'vreme' => '',
            'putere_energie' => ''
        ];

        // foreach ($params as $param) {
        //     echo "<script>console.log('Debug in pp: " . $param . "' );</script>";
        // }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_centrala' => trim($params['id_centrala']),
                'reactoare_active' => trim($params['reactoare_active']),
                'temperatura_nucleu' => trim($params['temperatura_nucleu']),
                'putere_racire' => trim($params['putere_racire']),
                'putere_produsa' => trim($params['putere_produsa']),
                'putere_ceruta' => trim($params['putere_ceruta']),
                'vreme' => trim($params['vreme']),
                'putere_energie' => trim($params['putere_energie'])
            ];

            if (
                is_numeric($data['id_centrala']) != 1 || is_numeric($data['reactoare_active']) != 1 ||
                is_numeric($data['temperatura_nucleu']) != 1 || is_numeric($data['putere_racire']) != 1 ||
                is_numeric($data['putere_produsa']) != 1 || is_numeric($data['putere_ceruta']) != 1 ||
                is_numeric($data['putere_energie']) != 1
            ) {
                $this->errorResponse();
            }

            if ($this->configurationModel->insert($data)) {
                header('HTTP/1.1 200 OK');
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                $this->errorResponse();
            }
        }
    }

    public function health($params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $health = $this->configurationModel->getOneByIdCentrala($params['id']);
            ob_get_clean();
            if ($health == false) {
                header('HTTP/1.1 200 OK');
                header('Content-Type: application/json');
                echo json_encode(array("health" => 100));
            } else {
                header('HTTP/1.1 200 OK');
                header('Content-Type: application/json');
                echo json_encode($health);
            }
            //echo "<script>console.log('Debug Objects: " . $response['body'] . "' );</script>";
            //return $response;
        }
    }

    public function weather($params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $weather = $this->configurationModel->getCountGroupByWeather($params['id']);
            ob_get_clean();

            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo json_encode($weather);
        }
    }

    public function info($params){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $info = $this->configurationModel->getLastByIdCentrala($params['id'],30);
            ob_get_clean();

            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo json_encode($info);
        }
    }

    private function errorResponse()
    {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        ob_get_clean();
        echo json_encode(array("Result" => "Bad Request"));
    }
}
