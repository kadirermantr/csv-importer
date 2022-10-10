<?php

require __DIR__ . "/vendor/autoload.php";
require "Database.php";

use Fusonic\CsvReader\Attributes\TitleMapping;
use Fusonic\CsvReader\CsvReader;
use Fusonic\CsvReader\CsvReaderOptions;

class Entity
{
    #[TitleMapping('employee_id')]
    public string $employee_id;

    #[TitleMapping('name')]
    public string $name;

    #[TitleMapping('surname')]
    public string $surname;

    #[TitleMapping('email')]
    public string $email;

    #[TitleMapping('phone')]
    public string $phone;

    #[TitleMapping('point')]
    public string $point;
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $database = new Database();

    $options = new CsvReaderOptions();
    $options->delimiter = ';';
    $reader = new CsvReader($_FILES['file']['tmp_name'], $options);

    try {
        foreach ($reader->readObjects(Entity::class) as $item) {
            $database->insert('INSERT INTO employees VALUES(:employee_id, :name, :surname, :email, :phone, :point)', [
                'employee_id' => $item->employee_id,
                'name' => $item->name,
                'surname' => $item->surname,
                'email' => $item->email,
                'phone' => $item->phone,
                'point' => $item->point,
            ]);
        }
    } catch (Exception $exception) {
        $message = urlencode("Hata: " . $exception->getMessage());
        header('Location: index.php?message=' . $message);
        exit();
    }

    $database->insert('INSERT INTO campaigns(name, created_at) VALUES(:name, :created_at)', [
        'name' => $_POST['campaign-name'],
        'created_at' => $_POST['campaign-date'],
    ]);

    $message = urlencode("Veriler içe aktarıldı.");
    header('Location: index.php?message=' . $message);
}
