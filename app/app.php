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
        return $app['twig']->render('contacts.html.twig', array('contacts' => Contact::getAll()));
    });

    $app->get("/contact_add", function() use ($app) {
      return $app['twig']->render('contact.add.html.twig');
  });

    $app->post("/contact_created", function() use ($app) {
      $new_contact= new Contact($_POST['contactName'], $_POST['contactAddress'], $_POST['contactPhone']);
      $new_contact->save();
      return $app['twig']->render('contact.created.html.twig', array('newContact' => $new_contact));
  });

    $app->get("/car_inventory", function() use ($app) {
        return $app['twig']->render('car_inventory.html.twig', array('cars' => Car::getAll()));
    });

    return $app;

?>
