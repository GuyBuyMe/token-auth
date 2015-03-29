<?php 

namespace Igorgoroshit\TokenAuth\Providers;

use Illuminate\Support\ServiceProvider;
use Igorgoroshit\TokenAuth\TokenAuth;

class TokenAuthServiceProvider extends \Tymon\JWTAuth\Providers\JWTAuthServiceProvider {

    protected $ttl = 720;

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

    protected function registerPayloadFactory()
    {
        $this->app['tymon.jwt.payload.factory'] = $this->app->share(function ($app) {
            $factory = new \Tymon\JWTAuth\PayloadFactory($app['tymon.jwt.claim.factory'], $app['request'], $app['tymon.jwt.validators.payload']);
            
            return $factory->setTTL($this->ttl);
        });
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