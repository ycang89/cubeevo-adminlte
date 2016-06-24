<?php namespace App\Http\ViewComposers;

use App\Models\Status;
use Illuminate\Contracts\View\View;

use App\Models\Post;
use App\Models\Project;

class HomeComposer {

	protected $_post;
	protected $_project;
	protected $_postCollection    = null;
	protected $_projectCollection = null;

	protected function _getAllActivePosts($qty = null)
	{
		if (!$this->_postCollection) {

			$this->_postCollection = $this->_post
				->where('deleted', '=', 0)
				->where('status', '=', Status::ACTIVE);

			if ($qty && is_numeric($qty)) {

				$this->_postCollection->take($qty);
			}
		}

		return $this->_postCollection
			->get()
			->sortByDesc('created_at');
	}

	protected function _getAllActiveProjects($qty = null)
	{
		if (!$this->_projectCollection) {

			$this->_projectCollection = $this->_project
				->where('delete', '=', 0)
				->where('status', '=', Status::ACTIVE);

			if ($qty && is_numeric($qty)) {

				$this->_projectCollection->take($qty);
			}
		}

		return $this->_projectCollection
			->get()
			->sortByDesc('created_at');
	}

	public function __construct(Post $post, Project $project)
	{
		$this->_post    = $post;
		$this->_project = $project;
	}

	public function compose(View $view)
	{
		$posts    = $this->_getAllActivePosts(3);
		$projects = $this->_getAllActiveProjects(2);

		return $view->with(compact('posts', 'projects'));
	}

}