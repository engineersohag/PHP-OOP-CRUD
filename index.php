<?php 
include 'database.php';

$obj = new Database();

// - Inserting Data -
// $obj->insert('students', ["name"=>"Eva Akter","roll"=>"857585", "age"=>"23", "city"=>"Lakshmipur"]);
// echo "Insert result is : ";
// print_r($obj->getResult());

// - Updateing Data -
// $obj->update('students', ["name"=>"MD Yousuf","roll"=>"681719", "age"=>"23", "city"=>"Noyakhali"], 'id="8"');
// echo "Update result is : ";
// print_r($obj->getResult());

// - Deleteing Data -
// $obj->delete('students', 'id="6"');
// echo "Delete result is : ";
// print_r($obj->getResult());

// - SQL Select -
// $obj->sql('SELECT * FROM students WHERE age = "19"');
// echo "SQL result is : ";
// print_r($obj->getResult());

// - Select Data - 
// $obj->select('students','*',null, 'id="6"');
// echo "Selcet result is : ";
// print_r($obj->getResult());

