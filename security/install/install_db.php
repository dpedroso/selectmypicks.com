<?php

$con=mysqli_connect("localhost","dpedroso","219600769");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create database
$sql="CREATE DATABASE Users";
if (mysqli_query($con,$sql)) {
  echo "Database Users created successfully";
} else {
  echo "Error creating database: " . mysqli_error($con);
}

$con=mysqli_connect("localhost","dpedroso","219600769","Users");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create table
$sql="CREATE TABLE User(FirstName CHAR(30),LastName CHAR(30),Email CHAR(30),Username CHAR(30),Pwd CHAR(30))";

// Execute query
if (mysqli_query($con,$sql)) {
  echo "Table User created successfully";
} else {
  echo "Error creating table: " . mysqli_error($con);
}

?> 