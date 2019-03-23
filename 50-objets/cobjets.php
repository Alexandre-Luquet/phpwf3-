<?php

// Start class

class Contact
{
// properties

//private
private $name;
private $age;
private $address;
private $phone;
// public
public $id;

// Construtor Method

public function __construct($nam, $ag, $add, $pho)
{
    $this->name = $nam;
    $this->age = $ag;
    $this->address = $add;
    $this->phone = $pho;
    $this->id = random_int(1,10);
}

// GETTER METHODS

// Get the name property of the current object
public function getName()
{
    return $this->name;
}

public function getAge()
{
    return $this->age;
}

public function getAddress()
{
    return $this->address;
}

public function getPhone()
{
    return $this->phone;
}
public function __toString()
{
    $out = "---------------------------------<br>";
    $out .= "ID = " . $this->id . '<br>';
    $out .= "Name = " . $this->name . '<br>';
    $out .= "Tel = " . $this->phone . '<br>';
    $out .= "Age = " . $this->age . '<br>';
    $out .= "Address = " . $this->address . '<br>';

    return $out;
}

}

// END OF CLASS

$c = new Contact("NAME", 25, "My Street in Paris", 607080910);
$c2 = new Contact("NAME2", 27, "My Street in Paris2", 6070809102);

echo $c->getName() . '<hr>';
echo $c->getAge() . '<hr>';
echo $c->getAddress() . '<hr>';
echo $c->getPhone() . '<hr><br>';

echo $c2->getName() . '<hr>';
echo $c2->getAge() . '<hr>';
echo $c2->getAddress() . '<hr>';
echo $c2->getPhone() . '<hr>';

// Access the public properties
echo $c->id . '<br>';

// typing to access the private properties
// echo $c->age . '<br>';

echo $c;



?>