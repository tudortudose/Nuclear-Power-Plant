<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/NuclearGitProject/Nuclear-Power-Plant/app/controllers/Users.php';

class Pages extends Controller
{
    public function __construct()
    {
        //$this->userModel = $this->model('User');
        $authController = new Users();

        $_COOKIE['jwt'] = $_SESSION['jwt'];
        if (isset($_COOKIE['jwt'])) {
            $_SERVER['Authorization'] = 'Bearer ' . $_COOKIE['jwt'];
        }
        $jwt = $authController->checkJWTExistance();
        $authController->validateJWT($jwt);
    }

    public function index()
    {
        $data = [
            'title' => 'Home page'
        ];

        $this->view('index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About us'
        ];

        $this->view('about', $data);
    }

    public function map()
    {
        $this->view('map');
    }

    public function reactor()
    {
        $data = [
            'title' => 'Nuclear Power Plant Specifications'
        ];

        $this->view('reactor', $data);
    }

    public function swagger_doc(){
        $data = [
            'title' => 'Nuclear Power Plant Specifications'
        ];

        $this->view('swagger_doc');
    }

    public function documentation(){
        $data = [
            'title' => 'Nuclear Power Plant Specifications'
        ];

        $this->view('documentation');
    }

    public function feed(){
        $data = [
            'title' => 'Nuclear Power Plant Specifications'
        ];

        $this->view('feed');
    }
}
