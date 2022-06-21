<?php
class EMails extends Controller
{
    public function __construct()
    {
    }

    public function sendMail($params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $to = $params['to'];
            $title = $params['title'];
            $message = $params['message'];

            $response = mail($to, $title, $message, 'From: tudorel_31@yahoo.com');

            if ($response) {
                echo json_encode("Mail sent successfully!");
                return "Mail sent successfully!";
            } else {
                echo json_encode("Error sending the mail!");
                return "Error sending the mail!";
            }
        }
    }
}
