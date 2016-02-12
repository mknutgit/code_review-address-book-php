<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contacts.php";

    session_start();

    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('.html.twig');
    });

    $app->post("/car_form", function() use ($app) {
        $cars_matching_search = array();
        foreach ($_SESSION['list_of_cars'] as $car) {
            if ($car->worthBuying($_POST['maxPrice']) && $car->maxMileage($_POST['maxMileage'])) {
                array_push($cars_matching_search, $car);
            }
        }
        return $app['twig']->render('car_form.html.twig', array('cars' => $cars_matching_search));
    });

    $app->get("/car_add", function() use ($app) {
        return $app['twig']->render('car_add.html.twig');
    });

    $app->post("/car_created", function() use ($app) {
        $new_car = new Car($_POST['model'], $_POST['price'], $_POST['mileage'], $_POST['image']);
        $new_car->save();
        return $app['twig']->render('car_created.html.twig', array('newcar' => $new_car));
    });

    $app->get("/car_inventory", function() use ($app) {
        return $app['twig']->render('car_inventory.html.twig', array('cars' => Car::getAll()));
    });

    return $app;

?>
