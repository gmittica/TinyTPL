<?php

//require TinyTpl
require_once("TinyTpl.php");

//demo 1: a simple tpl
$tpl =  new TinyTpl();
$tpl->hello = "I'm very Tiny!";
echo $tpl->render("views/main.html");

//demo 2: complex tpl
$tpl =  new TinyTpl();
$tpl->users = array(
    array(
        "username" => "bWayne",
        "name" => "Bruce",
        "surname" => "Wayne"
    ),
    array(
        "username" => "pParker",
        "name" => "Peter",
        "surname" => "Parker"
    )
);
echo $tpl->render("views/users.html");


