<?php

require __DIR__ . "/vendor/autoload.php";
require "Database.php";

use Fusonic\CsvReader\Attributes\TitleMapping;
use Fusonic\CsvReader\CsvReader;

class Entity
{
    #[TitleMapping('firstname')]
    public string $firstname;

    #[TitleMapping('lastname')]
    public string $lastname;

    #[TitleMapping('email')]
    public string $email;

    #[TitleMapping('phone')]
    public string $phone;
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $database = new Database();
    $reader = new CsvReader($_FILES['file']['tmp_name']);

    try {
        foreach ($reader->readObjects(Entity::class) as $item) {
            $database->insert('INSERT INTO employees (firstname, lastname, email, phone) VALUES(:firstname, :lastname, :email, :phone)', [
                'firstname' => $item->firstname,
                'lastname' => $item->lastname,
                'email' => $item->email,
                'phone' => $item->phone,
            ]);
        }

        $database->insert('INSERT INTO campaigns(name, created_at) VALUES(:name, :created_at)', [
            'name' => $_POST['campaign-name'],
            'created_at' => $_POST['campaign-date'],
        ]);

        $message = urlencode('Data has been imported successfully.');
        header('Location: index.php?message=' . $message);
    } catch (Exception $exception) {
        $message = urlencode("Error: " . $exception->getMessage());
        header('Location: index.php?message=' . $message);
        exit();
    }
}
