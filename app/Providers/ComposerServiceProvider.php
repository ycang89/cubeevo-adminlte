<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

	public function boot()
	{
		View::composers([
			'App\Http\ViewComposers\LocaleComposer'  => [
				'management.post.create',
				'management.post.edit',
			],
		]);
	}

	public function register()
	{

	}

}