<?php namespace App\Http\Controllers;

use URL;
use Session;
use Redirect;
use Config;
use App\Models\Status;
use App\Models\Locale;
use App\Models\Page;
use App\Models\Category;
use App\Models\Project;
use App\Models\Solution;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
	public function __construct()
	{
		// Set default language
		if (Session::get('locale') == null)
		{
			Session::set('locale', Config::get('locale'));
		}
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$page = Page::where('slug', '=', '/')->where('status', STATUS::ACTIVE)->first();

		return view('frontend.index')->with('page', $page);
	}

	public function getAboutUs()
	{
		$page = Page::where('slug', '=', '/about-us')->where('status', STATUS::ACTIVE)->first();

		return view('frontend.index')->with('page', $page);
	}

	public function getCredential()
	{
		$categories = Category::where('status', '=', STATUS::ACTIVE)->orderBy('sort_order')->get();

		return view('frontend.credential')->with('categories', $categories);
	}

	public function getProjectContent($projectId)
	{
		$project = Project::find($projectId);

		return view('frontend.project_content')->with('project', $project);
	}

	public function getCredentialProject($categoryId)
	{
		$projects = Category::find($categoryId)->projects()->where('status', STATUS::ACTIVE)
			->orderBy('sort_order')
			->get();

		return view('frontend.project')->with('projects', $projects)->with('backbtn', URL::action('HomeController@getCredential'));
	}

	public function getSolution()
	{
		$solutions = Solution::where('status', '=', STATUS::ACTIVE)->orderBy('sort_order')->get();

		return view('frontend.solution')->with('solutions', $solutions);
	}

	public function getProcess()
	{
		$page = Page::where('slug', '=', '/process')->where('status', STATUS::ACTIVE)->first();

		return view('frontend.index')->with('page', $page);
	}

	public function getContactUs()
	{
		return view('frontend.contactus');
	}

	public function switchLocale($code)
	{
		$locale = Locale::where('language', '=', $code)->first();

		if (isset($locale))
		{
			Session::set('locale', $locale->language);
		}

		return Redirect::back();
	}

}
