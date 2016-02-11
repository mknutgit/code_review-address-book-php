<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contacts.php";

    session_start();
    // $ = new Car("2014 Porsche 911", 112344, 1245, "../images/porsche.jpg");
    // $ = new Car("2014 Ford f450", 56892, 12465, "http://2016ford-f150.com/wp-content/uploads/2015/02/2016-Ford-f-150-front-300x225.jpg");
    // $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "../images/lexus.jpg");
    // $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "../images/mercedes.jpg");

    // $app['debug'] = true; for debugging

    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('car.html.twig');
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
