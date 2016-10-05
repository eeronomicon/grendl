<?php
    $app->get("/navigation/{ship_id}", function($ship_id) use ($app) {
        $ship = Ship::find($ship_id);
        return $app['twig']->render('navigation.html.twig', array('planets' => Planet::getAll(), 'ship' => $ship));
    });

?>
