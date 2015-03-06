<?php 

namespace Igorgoroshit\TokenAuth\Providers;

use Illuminate\Support\ServiceProvider;
use Igorgoroshit\TokenAuth\TokenAuth;

class TokenAuthServiceProvider extends \Tymon\JWTAuth\Providers\JWTAuthServiceProvider {

	  protected function bootBindings()
    {
    	parent::bootBindings();

      $this->app['Igorgoroshit\TokenAuth\TokenAuth'] = function ($app) {
          return $app['igorgoroshit.token.auth'];
      };
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    	parent::register();

    	$this->registerTokenAuth();
    }
		/**
		* Register the bindings for the main JWTAuth class
		*/
    protected function registerTokenAuth()
    {
        $this->app['igorgoroshit.token.auth'] = $this->app->share(function ($app) {

            $auth = new TokenAuth(
                $app['tymon.jwt.manager'],
                $app['tymon.jwt.provider.user'],
                $app['tymon.jwt.provider.auth'],
                $app['request']
            );

            return $auth->setIdentifier($this->config('identifier'));
        });
    }
}