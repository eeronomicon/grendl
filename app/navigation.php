<?php
    $app->get("/navigation", function() use ($app) {
        return $app['twig']->render('navigation.html.twig', array('planets' => Planet::getAllOccupiedPlanets()));
    });

?>
