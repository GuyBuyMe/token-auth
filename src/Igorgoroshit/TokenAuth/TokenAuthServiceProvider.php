<?php namespace Igorgoroshit\TokenAuth;

use Illuminate\Support\ServiceProvider;

class TokenAuthServiceProvider extends ServiceProvider {


	protected $defer = false;


	public function boot()
	{
		$this->package('igorgoroshit/tokenauth');
	}


	public function register(){}

	public function provides(){ return array(); }

}