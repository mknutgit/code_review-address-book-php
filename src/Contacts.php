<?php
    class Contact
    {
        private $Name;
        private $Address;
        private $Phone;
        private $Email;

        function __construct($name, $address, $phone, $email)
        {
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
            $this->email = $email;
        }

        // function worthBuying($max_price)
        // {
        //     return $this->price < ($max_price + 100);
        // }
        //
        // function maxMileage($max_mileage)
        // {
        //     return $this->miles < $max_mileage;
        // }

        function setName($contact_name)
        {
            $this->name = $contact_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setAddress($contact_address)
        {
            $this->address = $contact_address;
        }

        function getAddress()
        {
            return $this->address;
        }

        function setPhone($contact_phone)
        {
            $this->phone = $contact_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setEmail($contact_email)
        {
            $this->email = $contact_email;
        }

        function getEmail()
        {
            return $this->email;
        }

        function save()
        {
            array_push($_SESSION['list_of_contacts'], $this);
        }

        static function getAll()
        {
            return $_SESSION['list_of_contacts'];
        }

        static function deleteAll()
        {
            return $_SESSION['list_of_contacts'] = array();
        }

    }



    // $cars = array($porsche, $ford, $lexus, $mercedes);
    //
    // $cars_matching_search = array();
    // foreach ($cars as $car) {
    //     if ($car->worthBuying($_GET["price"]) && $car->maxMileage($_GET["mileage"])) {
    //         array_push($cars_matching_search, $car);
    //     }
    // }
?>
