<?php

// require_once('application/models/posts_model.php');

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
                $this->session->set('timeout', time());
                $this->session->set('username', $username);
                $this->redirect('admin');
            }
            $template->set('error', $error);
            $template->set('username', $username);
            $template->set('password', $password);
            $template->set('logged', $logged);
        }

        $template->render();
    }

    function categories()
    {
        $error_message = '';
        $categoriesModel = $this->loadModel('categories_model');
        $searchCategory = '';
        if(isset($_GET['category_search']) && !empty('search_name'))
        {
            $searchCategory = $categoriesModel->sanitize($_GET['search_name']);
        } elseif(isset($_GET['category_add']) ) {
                if(!empty($_GET['name']) && !empty($_GET['description'])) {
                    $addCategorySuccess = $categoriesModel->add_category($_GET['name'], $_GET['description']);

                    if (!$addCategorySuccess) {
                        $error_message = "Nieudane zapisanie kategorii";
                    }

                } else {

                    $error_message = 'Nazwa i opis kategorii nie mogą być puste!';
                }
        }
        $categoriesTable = $categoriesModel->getCategories($searchCategory);
        $categoriesOptions = $categoriesModel->getCategoriesOption('', 2);

        if(!$this->session->get('logged_in')) $this->redirect('admin/login');
        $template = $this->loadView('administrator/categories');
        $template->set('categories', $categoriesOptions);
        $template->set('categoriesTable', $categoriesTable);
        $template->set('error_message', $error_message);

        $template->render();
    }

    function posts()
    {
        $error_message = '';
        $postsModel = $this->loadModel('posts_model');
        $categoriesModel = $this->loadModel('categories_model');
        // $postsModel = new Post();
        $searchCategory = '';
        if(isset($_GET['category_search']) && !empty('search_name'))
        {
            $searchCategory = $postsModel->sanitize($_GET['search_name']);
        } elseif(isset($_GET['post_add']) ) {
                if(!empty($_GET['name']) && !empty($_GET['description']) && !empty($_GET['parent'])) {
                    $addPostSuccess = $postsModel->add_post($_GET['name'], $_GET['description'], $_GET['parent']);

                    if (!$addPostSuccess) {
                        $error_message = "Nieudane zapisanie postu";
                    }

                } else {

                    $error_message = 'Nazwa i opis postu nie mogą być puste!';
                }
        }
        // $categoriesTable = $postsModel->getCategories($searchCategory);
        $categoriesOptions = $categoriesModel->getCategoriesOption('', 2);

        if(!$this->session->get('logged_in')) $this->redirect('admin/login');
        $template = $this->loadView('administrator/posts');
        $template->set('categories', $categoriesOptions);
        // $template->set('categoriesTable', $categoriesTable);
        $template->set('error_message', $error_message);

        $template->render();
    }

    public function logout()
    {
        $this->session->destroy();
        $this->redirect('main');
    }
}

?>