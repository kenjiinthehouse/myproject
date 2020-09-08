<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? '' ?></title>
    <link rel="stylesheet" href="./../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./../fontawesome/css/all.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,531;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,531;1,600;1,700&display=swap" rel="stylesheet"> -->
    <style>
        /* * {
            font-family: 'Raleway', 'Noto Sans TC', sans-serif;
        } */

        body {
            background: -webkit-linear-gradient(#859398, #283048);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(#859398, #283048);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .card-body {
            background-color: rgba(173, 181, 189, 0.5);
        }

        nav {
            margin-bottom: 20px;
        }

        .forum-content-table {
            width: 100%;
        }


        .thumbs-up,
        .thumbs-down,
        .thumbs-points {
            margin-left: 5px;
            margin-right: 5px;
        }

        .bottom-btns,
        .bottom-btn {
            margin-top: 5px;
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>
</head>

<body>