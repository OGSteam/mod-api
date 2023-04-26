<?php
if (!defined('IN_SPYOGAME'))
    die("Hacking attempt"); // Pas d'accès direct
?>

<style>
    nav {
        margin-top : 10px;
        margin-bottom:  10px;
        padding-top : 5px;
        padding-bottom:  5px;
    }

    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        display: inline-block;
        padding: 10px;
        border-bottom: 1px solid white;
    }
     nav ul li.active {
         background-color: rgba(63,33,88,0.3);
        border-bottom: 1px solid #3F2158;
     }
         
         
    nav ul li a {
        color: #fff;
        text-decoration: none;
    }


    nav ul li:hover  {
        color: #3F2158;
        border-bottom: 1px solid #3F2158;
        text-decoration: none;



    }
    nav ul li a:hover{
        text-decoration: none;
        color: #fff;
    }

</style>