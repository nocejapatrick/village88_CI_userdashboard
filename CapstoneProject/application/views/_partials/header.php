<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Dojo Wall</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <style>
        input.error{
            border: 1px solid red;
        }
        input.error::placeholder{
            color: red;
        }
        .my-categories *{
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .my-categories{
            border:none;
            border-radius: 2px;
            cursor: pointer;
        }
        .my-categories li{
            padding: 2px 10px;
            font-size: .8em;
        }
        .my-categories li:hover{
            background: #cfcffb;
        }
        .my-categories{
            height: 0;
            overflow: hidden;
        }
        .delete-image{
            cursor: pointer;
        }
        .img-gallery{
            border:1px solid #e3e3e3;
            padding: 2px;
        }
    </style>
</head>
<body>
<?php $this->load->view('_partials/navbar')?>