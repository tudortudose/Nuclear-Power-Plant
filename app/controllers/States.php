<?php
class States extends Controller
{
    public function __construct()
    {
        $this->configurationModel = $this->model('State');
    }

    public function insert($params)
    {
        $data = [
            'id_centrala' => '',
            'temperatura_nucleu' => '',
            'putere_racire' => '',
            'putere_produsa' => '',
            'putere_ceruta' => '',
            'putere_energie' => ''
        ];

        // foreach ($params as $param) {
        //     echo "<script>console.log('Debug in pp: " . $param . "' );</script>";
        // }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_centrala' => trim($params['id_centrala']),
                'temperatura_nucleu' => trim($params['temperatura_nucleu']),
                'putere_racire' => trim($params['putere_racire']),
                'putere_produsa' => trim($params['putere_produsa']),
                'putere_ceruta' => trim($params['putere_ceruta']),
                'putere_energie' => trim($params['putere_energie'])
            ];

            if (
                is_numeric($data['id_centrala']) != 1 ||
                is_numeric($data['temperatura_nucleu']) != 1 || is_numeric($data['putere_racire']) != 1 ||
                is_numeric($data['putere_produsa']) != 1 || is_numeric($data['putere_ceruta']) != 1 ||
                is_numeric($data['putere_energie']) != 1
            ) {
                $this->errorResponse();
            }

            $exists = $this->configurationModel->getByCentralId($params['id_centrala']);
            if(count($exists)==0){
                if ($this->configurationModel->insert($data)) {
                    header('HTTP/1.1 201 CREATED');
                    header('Content-Type: application/json');
                    echo json_encode($data);
                } else {
                    $this->errorResponse();
                }
            }
            else{
                if ($this->configurationModel->update($data)) {
                    header('HTTP/1.1 200 OK');
                    header('Content-Type: application/json');
                    echo json_encode($data);
                } else {
                    $this->errorResponse();
                }
            }
        }
    }

    public function info($params){
        //echo "<script>console.log('Debug in pp: " . $params['id'] . "' );</script>";
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $info = $this->configurationModel->getById($params['id']);
            ob_get_clean();

            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo json_encode($info);
        }
    }

    public function central($params){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $info = $this->configurationModel->getByCentralId($params['id']);
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