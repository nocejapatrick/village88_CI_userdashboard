<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Dojo Wall</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .signin form, .register form{
            width: 50%;
        }
        input.error, textarea.error{
            border:1px solid red !important;
        }
        input.error::placeholder, textarea.error::placeholder {
           color: red !important;
        }
    </style>
</head>
<body>
<?php $this->load->view('_partials/navbar')?>