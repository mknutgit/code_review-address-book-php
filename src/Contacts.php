<?php
    class Contact
    {
        private $Name;
        private $Address;
        private $Phone;


        function __construct($name, $address, $phone)
        {
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
        }

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
?>
