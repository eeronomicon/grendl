<?php
    $app->get("/navigation/{ship_id}", function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        return $app['twig']->render('navigation.html.twig', array('planets' => Planet::getAll(), 'ship' => $ship));
    });

    $app->post("/navigation/{ship_id}/go", function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        $ship->nextTurn();
        $ship->travel($_POST['destination_x'], $_POST['destination_y']);
        $ship->update();
        if($game_over = $ship->checkGameover() != 0) {
            System::addHighScore($ship->getName(), $ship->getCredits(), $ship->getTurn());
            return $app->redirect('/gameover/' . $ship->getId());
        }
        $location = $ship->getLocation();
        $planet = Planet::findByCoordinates($location[1], $location[0]);
        System::nextTurn();
        return $app['twig']->render('main_display.html.twig', array('ship' => $ship, 'planet' => $planet));
    });

?>
