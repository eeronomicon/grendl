<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Planet.php";
    require_once __DIR__.'/../src/System.php';
    date_default_timezone_set('America/Los_Angeles');

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $server = 'mysql:host=localhost;dbname=space_truckin';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('planet_display.html.twig', array('planets' => Planet::getAllOccupiedPlanets()));
    });

    require_once __DIR__."/../app/navigation.php";

    $app->post("/reset", function() use ($app) {
        new System();
        return $app->redirect('/');
    });

    $app->post('/nextTurn', function() use ($app) {
        System::nextTurn();
        return $app->redirect('/');
    });

    return $app;
?>
