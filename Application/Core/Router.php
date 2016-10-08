<?php

namespace Core;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as RouterManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Router{

  public function __construct(){
    $events = new Dispatcher(new Container);
// Create the router instance
$router = new RouterManager($events);
// Load the routes
require_once 'routes.php';
// Create a request from server variables
$request = Request::capture();
// Dispatch the request through the router
try
		{
			// Run the router
			$response = $router->dispatch($request);
		}
		catch (NotFoundHttpException $e)
		{
			/*
			 * If the 404 is explicitly set to the boolean value of false.
			 * We re-throw the exception and make that the responsibility
			 * of the caller.
			 */
			// Output the 404 header
			header('HTTP/1.0 404 Not Found');
			// Output our 404 page

				echo
				'
					<!doctype html>
					<html lang="en">
						<head>
							<meta charset="utf-8">
							<title>Page Not Found</title>
							<meta name="viewport" content="width=device-width, initial-scale=1">
							<style>
								* { line-height: 1.2; margin: 0; }
								html { color: #888; display: table; font-family: sans-serif; height: 100%; text-align: center; width: 100%; }
								body { display: table-cell; vertical-align: middle; margin: 2em auto; }
								h1 { color: #555; font-size: 2em; font-weight: 400; }
								p { margin: 0 auto; width: 280px; }
								@media only screen and (max-width: 280px)
								{
									body, p { width: 95%; }
									h1 { font-size: 1.5em; margin: 0 0 0.3em 0; }
								}
							</style>
						</head>
						<body>
							<h1>Page Introuvable</h1>
							<p>Nos excuses mais cette page est introuvable</p>
						</body>
					</html>
					<!-- IE needs 512+ bytes: http://blogs.msdn.com/b/ieinternals/archive/2010/08/19/http-error-pages-in-internet-explorer.aspx -->
				';

			// If we output a 404 we will exit regardless of exitOnComplete
			exit;
		}

// Send the response back to the browser
$response->send();
  }

}
