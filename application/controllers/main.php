<?php

// require_once('application/models/posts_model.php');

class Main extends Controller {
	
	function index()
	{
		// $posts_model = new Posts();
		$posts_model = $this->loadModel('posts_model');
		$posts = $posts_model->getPosts();

		$posts_count = count($posts);

		if (!$posts_count)
			$this->redirect('error/noPosts');
		else{
			$template = $this->loadView('main_view');
			$template->set('posts', $posts);
			$template->set('posts_count', $posts_count);

			$template->render();
		}
	}

	function recent()
	{
		$this->index();
	}

	function contact()
	{
		$template = $this->loadView('contact');
		$template->render();
	}
    
	function about()
	{
		$template = $this->loadView('about');
		$template->render();
	}

	function read($id)
	{
		$posts_model = $this->loadModel('posts_model');
		$post = $posts_model->getPostById($id);

		if (!$post->id) 
			$this->redirect('error');
		else{
			$template = $this->loadView('read');
			$template->set('post', $post);
			$template->set('id', $id);

			$template->render();
		}

	}

	function admin()
	{
		$this->redirect('admin');
	}
}

?>
