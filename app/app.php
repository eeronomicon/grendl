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
        $credits = 1000000;
        $location_x = 1;
        $location_y = 1;
        $current_fuel = 100;
        $ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id = null);
        $ship->save();
        $ship->initializeCargo();
        return $app->redirect('/main_display/' . $ship->getId());
    });
    // main page routes
    $app->get('/main_display/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $location = $ship->getLocation();
        $planet = Planet::findByCoordinates($location[1], $location[0]);
        return $app['twig']->render('main_display.html.twig', array('ship' => $ship, 'planet' => $planet));
    });

    // trade routes
    $app->get('/trade/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $location = $ship->getLocation();
        $planet = Planet::findByCoordinates($location[1], $location[0]);
        return $app['twig']->render('trade.html.twig', array('ship' => $ship, 'planet' => $planet));
    });

    $app->post('/buy/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $location = $ship->getLocation();
        $planet = Planet::findByCoordinates($location[1], $location[0]);
        $prices = $planet->getMarketValues();
        $purchase_quantities = array(
            'Ore' => $_POST['Ore'],
            'Grain' => $_POST['Grain'],
            'Livestock' => $_POST['Livestock'],
            'Consumables' => $_POST['Consumables'],
            'Consumer Goods' => $_POST['Consumer_Goods'],
            'Heavy Machinery' => $_POST['Heavy_Machinery'],
            'Military Hardware' => $_POST['Military_Hardware'],
            'Robots' => $_POST['Robots']
        );
        $total = array_sum($purchase_quantities);
        // return $ship->cargoCheck($total);
        if ($ship->cargoCheck($total)) {
            foreach($purchase_quantities as $key => $quantity) {
                if ($ship->creditCheck($quantity, $prices[$key])) {
                    $ship->buyTradeGood($key, $quantity, $prices[$key]);
                    $planet->removeInventory($key, $quantity);
                    $ship->update();
                }
            }
        }
        return $app->redirect('/trade/' . $ship->getId());
    });

    $app->post('/buy_fuel/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $quantity = $_POST['quantity'];
        if ($ship->purchaseFuelCheck($quantity, 10)) {
            $ship->purchaseFuel($quantity, 10);
            $ship->update();
        }
        return $app->redirect('/trade/' . $ship->getId());
    });

    $app->post('/sell/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $location = $ship->getLocation();
        $planet = Planet::findByCoordinates($location[1], $location[0]);
        $prices = $planet->getMarketValues();
        $sell_quantities = array(
            'Ore' => $_POST['Ore'],
            'Grain' => $_POST['Grain'],
            'Livestock' => $_POST['Livestock'],
            'Consumables' => $_POST['Consumables'],
            'Consumer Goods' => $_POST['Consumer_Goods'],
            'Heavy Machinery' => $_POST['Heavy_Machinery'],
            'Military Hardware' => $_POST['Military_Hardware'],
            'Robots' => $_POST['Robots']
        );
        foreach($sell_quantities as $key => $quantity) {
            $ship->sellTradeGood($key, $quantity, $prices[$key]);
            $ship->update();
        }
        return $app->redirect('/trade/' . $ship->getId());
    });


    return $app;
?>
