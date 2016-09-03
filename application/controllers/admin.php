<?php
ini_set('error_reporting', E_ALL);
class Admin extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = $this->loadHelper('session_helper');
    }


    function index()
    {
        if(!$this->session->get('logged_in')) $this->redirect('admin/login');
        $template = $this->loadView('administrator/admin_view');

        $template->render();
    }

    function login()
    {
        $auth_model = $this->loadModel('admin/auth_model');

        $template = $this->loadView('administrator/login_view');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
        {
            $username = $_POST['inputNickname'];
            $password = $_POST['inputPassword'];

            $logged = $auth_model->confirmPassword($username, $password);

            $error = "";
            if(!$logged)
            {
                $error = "<div class='alert alert-danger'>Wprowadzono nieprawidłową nazwę użytkownika lub hasło</div>";
            }
            else
            {
                $this->session->set('logged_in', true);
                $this->redirect('admin');
            }
            $template->set('error', $error);
            $template->set('username', $username);
            $template->set('password', $password);
            $template->set('logged', $logged);
        }

        $template->render();
    }

    public function logout()
    {
        $this->session->destroy();
        $this->redirect('main');
    }
}

?>