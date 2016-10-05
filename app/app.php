<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Planet.php";
    require_once __DIR__.'/../src/System.php';
    require_once __DIR__.'/../src/Ship.php';
    require_once __DIR__.'/../src/Cargo.php';
    require_once __DIR__.'/../src/TradeGood.php';
    date_default_timezone_set('America/Los_Angeles');

    use Symfony\Component\Debug\Debug;
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

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

// routes start here

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    require_once __DIR__."/../app/navigation.php";

    $app->post('/new_game', function() use ($app) {
        // create a new system
        new System();
        // create a new Ship
        $name = $_POST['name'];
        $cargo_capacity = 100;
        $fuel_capacity = 100;
        $credits = 500;
        $location_x = 1;
        $location_y = 1;
        $current_fuel = 80;
        $ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id = null);
        $ship->save();
        $ship->initializeCargo();
        return $app->redirect('/main_display/' . $ship->getId());
    });

    $app->get('/main_display/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $location = $ship->getLocation();
        $planet = Planet::findByCoordinates($location[0], $location[1]);
        return $app['twig']->render('main_display.html.twig', array('ship' => $ship, 'planet' => $planet));
    });




    return $app;
?>
