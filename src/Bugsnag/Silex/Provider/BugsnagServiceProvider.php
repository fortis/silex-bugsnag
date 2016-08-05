<?php

namespace Bugsnag\Silex\Provider;

use Bugsnag\Client;
use Bugsnag\Handler;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class BugsnagServiceProvider implements ServiceProviderInterface
{
    /**
     * The package version.
     *
     * @var string
     */
    const VERSION = '1.0.0';

    public function register(Container $app)
    {
        $app['bugsnag'] = function ($app) {
            $client = Client::make($app['bugsnag.options']['apiKey']);
            $client->setNotifier([
                'name'    => 'Silex Bugsnag',
                'version' => static::VERSION,
                'url'     => 'https://github.com/fortis/silex-bugsnag',
            ]);

            Handler::register($client);

            return $client;
        };

        $app->error(
          function (\Exception $error, Request $request) use ($app) {
              $params['request'] = [
                'params'        => $request->query->all(),
                'requestFormat' => $request->getRequestFormat(),
              ];

              $app['bugsnag']->notifyException($error);
          }
        );
    }

    public function boot(Application $app)
    {
        //
    }
}
