<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Users extends Controller
{
    private $secret_Key  = '%aaSWvtJ98os_b<IQ_c$j<_A%bo_[xgct+j$d6LJ}^<pYhf+53k^-R;Xs<l%5dF';
    private $domainName = "https://127.0.0.1";

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirm_passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirm_passwordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            } elseif ($this->userModel->findUserByUsername($data['username'])) {
                $data['usernameError'] = 'Username already taken.';
            }
            //die($data['username'] . ' ' . $data['password'] . ' ' . $data['confirm_password'] . ' ' . $data['email']);


            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct email format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken.';
                }
            }

            // Validate password on length, numeric values,
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 5) {
                $data['passwordError'] = 'Password must be at least 5 characters';
            }

            //Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_passwordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_passwordError'] = 'Passwords do not match, please try again.';
                }
            }

            //die($data['usernameError'] . ' ' . $data['passwordError'] . ' ' . $data['confirm_passwordError'] . ' ' . $data['emailError']);

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirm_passwordError'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users/register', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];

            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            } elseif (!$this->userModel->findUserByUsername($data['username'])) {
                $data['usernameError'] = 'Username does not exist.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';

                    $this->view('users/login', $data);
                }
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('users/login', $data);
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;

        ob_get_clean();
        $response = $this->createJWT();
        setcookie('jwt', $response['body']);
        //echo "<script>console.log('Debug Objects: " . $_COOKIE['jwt'] . "' );</script>";

        header($response['status_code_header']);
        header($response['content_type_header']);
        if ($response['body']) {
            //echo $response['body'];
        }

        //$_session not $_cookie because at the moment the browser sees cookies but the request doesn't:
        $_SESSION['jwt'] = $response['body'];
        header('location:' . URLROOT . '/pages/index');
        
        //setcookie('jwt', $response['body']);

    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }

    private function createJWT()
    {
        $secret_Key = $this->secret_Key;
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+6 minutes')->getTimestamp();
        $domainName = $this->domainName;
        $username   = "username";
        $request_data = [
            'iat'  => $date->getTimestamp(),         // ! Issued at: time when the token was generated
            'iss'  => $domainName,                   // ! Issuer
            'nbf'  => $date->getTimestamp(),         // ! Not before
            'exp'  => $expire_at,                    // ! Expire
            'userName' => $username,                 // User name
        ];

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';
        $response['body'] = JWT::encode(
            $request_data,
            $secret_Key,
            'HS512'
        );

        return $response;
    }

    function checkJWTExistance()
    {
        // Check JWT
        if (!preg_match('/Bearer\s(\S+)/', $this->getAuthorizationHeader(), $matches)) {
            //echo 'here: ' . $_COOKIE['jwt'];
            header('HTTP/1.0 400 Bad Request');
            echo 'Token not found in request';
            exit;
        }
        return $matches[1];
    }

    function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    public function validateJWT($jwt)
    {
        $secret_Key = $this->secret_Key;

        try {
            $token = JWT::decode($jwt, new Key($secret_Key, 'HS512'));
        } catch (Exception $e) {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
        $now = new DateTimeImmutable();
        $domainName = $this->domainName;

        if (
            $token->iss !== $domainName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp()
        ) {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
    }
}
