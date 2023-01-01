<head>
    <title>Applied Jobs</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <style>
        .brand {
            background: #008B8B !important;
        }

        .brand-text {
            color: #008B8B !important;
            font-weight: 600;
        }

        form {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }

        .job {
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;
        }
    </style>
</head>

<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text ">
                Applied Jobs</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="add.php" class="btn brand z-depth-0">Add a Job</a></li>
                <?php if(empty($_SESSION['id'])) { ?>
                    <li><a href="login.php" class="btn brand z-depth-0">Login</a></li>
                <?php } else { ?>
                    <li><a href="logout.php" class="btn brand z-depth-0">Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>