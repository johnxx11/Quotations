<?php
// This file contains a bridge between the view and the model and redirects back to the proper page
// with after processing whatever form this code absorbs. This is the C in MVC, the Controller.
//
// Author: Yanxu Wu
//
require_once './DatabaseAdaptor.php';
session_start();

$theDBA = new DatabaseAdaptor();

if (isset($_GET['todo']) && $_GET['todo'] === 'getQuotes') {
    $arr = $theDBA->getAllQuotations();
    unset($_GET['todo']);
    echo getQuotesAsHTML($arr);
}
if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    unset($_SESSION['loginError']);
    $_POST['loginUsername'] = htmlspecialchars($_POST['loginUsername']);
    $_POST['loginPassword'] = htmlspecialchars($_POST['loginPassword']);
    $arr = $theDBA->getAllUsers();
    for ($i = 0; $i < count($arr); $i ++) {
        if ($_POST['loginUsername'] === $arr[$i]['username'] && password_verify($_POST['loginPassword'], $arr[$i]['password'])) {
            $_SESSION['user'] = $_POST['loginUsername'];
            header("Location: view.php");
        } else {
            $_SESSION['loginError'] = 'Invalid credentials.';
            header("Location: login.php");
        }
    }
}

if (isset($_POST['author']) && isset($_POST['quote'])) {
    $_POST['loginUsername'] = htmlspecialchars($_POST['loginUsername']);
    $_POST['loginPassword'] = htmlspecialchars($_POST['loginPassword']);
    $theDBA->addQuote($_POST['quote'], $_POST['author']);
    header("Location: view.php");
}

if (isset($_POST['registerUsername']) && isset($_POST['registerPassword'])) {
    unset($_SESSION['registrationError']);
    $arr = $theDBA->getAllUsers();
    $flag = TRUE;
    for ($i = 0; $i < count($arr); $i ++) {
        if ($_POST['registerUsername'] == $arr[$i]['username']) {
            $_SESSION['registrationError'] = 'Account name taken';
            $flag = FALSE;
            header("Location: register.php");
        }
    }
    if ($flag) {
        $theDBA->addUser($_POST['registerUsername'], $_POST['registerPassword']);
        header("Location: view.php");
    }
}

if (isset($_POST['update'])) {
    if ($_POST['update'] == 'delete') {
        $theDBA->deleteQuote($_POST['ID']);

        header("Location: view.php");
    }
    if ($_POST['update'] == 'increase') {
        $theDBA->increase($_POST['ID']);
        header("Location: view.php");
    }
    if ($_POST['update'] == 'decrease') {
        $theDBA->decrease($_POST['ID']);
        header("Location: view.php");
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    header('Location: view.php');
}

function getQuotesAsHTML($arr)
{
    $result = '';
    foreach ($arr as $quote) {
        $result .= '<div class="container">';
        $result .= '"' . $quote['quote'] . '"<br>';
        $result .= '<p class="author">';
        $result .= '&nbsp;&nbsp;--' . $quote['author'] . '<br>';
        $result .= "<form action='controller.php' method='post'>";
        $result .= '<input type="hidden" name="ID" value="' . $quote['id'] . '">&nbsp;&nbsp;&nbsp;';
        $result .= '<button name="update" value="increase">+</button>';
        $result .= '&nbsp;<span id="rating"> ' . $quote['rating'] . '</span>&nbsp;&nbsp;';
        $result .= '<button name="update" value="decrease">-</button>&nbsp;&nbsp;';
        $result .= '<button id="del" name="update" value="delete">Delete</button>';
        $result .= '</form>';
        $result .= '</div>';
    }

    return $result;
}
?>
