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

    // PDO MAMP
    $server = 'mysql:host=localhost:8889;dbname=space_truckin';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    // PDO for Heroku
    // $server = 'pgsql:host=ec2-184-72-240-189.compute-1.amazonaws.com;dbname=d7rn2335aqplh5';
    // $username = 'jwxyacrgzzdvfy';
    // $password = 'Ai8q-eTZW-1SJrhdYhQKR8vlQR';
    // $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    // routes start here

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    require_once __DIR__."/../app/navigation.php";

    $app->post('/new_game', function() use ($app) {
        if (!Ship::getAll()) {
            // create a new system if no ships are in database
            new System();
        }
        // create a new Ship
        $name = $_POST['name'];
        $parameters = System::getGameplayParameters();
        $ship = new Ship($name, $parameters['max_cargo'], $parameters['max_fuel'], $parameters['starting_credits'], mt_rand(1,10), mt_rand(1,10), $parameters['starting_fuel'], $turn = 1, $id = null);
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

    // game over
    $app->get('/gameover/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $high_scores = System::getTopScores();
        $game_over_reason = $ship->checkGameover();
        $ship->delete();
        return $app['twig']->render('gameover.html.twig', array('ship' => $ship, 'high_scores' => $high_scores, 'reason' => $game_over_reason));
    });

    // wait one turn
    $app->get('/wait_turn/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $location = $ship->getLocation();
        $planet = Planet::findByCoordinates($location[1], $location[0]);
        $ship->nextTurn();
        $ship->travel($location[0], $location[1]);
        $ship->update();
        $planet->setMarketValues();
        if($ship->checkGameover()) {
            System::addHighScore($ship->getName(), $ship->getCredits(), $ship->getTurn());
            return $app->redirect('/gameover/' . $ship->getId());
        }
        System::nextTurn();
        return $app->redirect('/main_display/' . $ship->getId());
    });

    // trade routes
    $app->get('/trade/{ship_id}', function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $location = $ship->getLocation();
        $planet = Planet::findByCoordinates($location[1], $location[0]);
        $fuel_price = System::getGameplayParameters()['fuel_price'];
        return $app['twig']->render('trade.html.twig', array('ship' => $ship, 'planet' => $planet, 'fuel_price' => $fuel_price));
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
        $parameters = System::getGameplayParameters();
        if ($ship->purchaseFuelCheck($quantity, $parameters['fuel_price'])) {
            $ship->purchaseFuel($quantity, $parameters['fuel_price']);
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
