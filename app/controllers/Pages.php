<?php
class Pages extends Controller {
    public function __construct() {
        //$this->userModel = $this->model('User');
    }

    public function index() {
        $data = [
            'title' => 'Home page'
        ];

        $this->view('index', $data);
    }

    public function about() {
        $data = [
            'title' => 'About us'
        ];

        $this->view('about');
    }

    public function map() {
        $this->view('map');
    }

    public function reactor(){
        $data = [
            'title' => 'Nuclear Power Plant Specifications'
        ];

        $this->view('reactor');
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
}
