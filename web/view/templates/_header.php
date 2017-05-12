<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $title; ?></title>
  <!-- css -->
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../assets/css/bootstrap-4.0.0-alpha.6.css"> 
  <link rel="stylesheet" href="../assets/css/wisataku-custom.css">
  <link rel="stylesheet" href="../assets/css/wisataku-custom.css">
  <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/css/jquery.dataTables.css">
  
  
</head>
  <!-- js -->
  <script src="../assets/js/jquery-3.1.1.slim.min.js"></script>
  <script src="../assets/js/tether.min.js"></script>
  <script src="../assets/js/bootstrap-4.0.0-alpha.6.min.js"></script>
  <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
  <script src="../assets/js/jquery.dataTables.js"></script>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-faded">
    <div class="container">
        
        <!-- WisataKu Logo -->
        <svg width="120px" height="18px" viewBox="0 0 120 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <!-- Generator: Sketch 43.1 (39012) - http://www.bohemiancoding.com/sketch -->
            <desc>Created with Sketch.</desc>
            <defs></defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Booking-Form" transform="translate(-44.000000, -3.000000)" fill="#4990E2">
                    <g id="Group" transform="translate(43.000000, 0.000000)">
                        <text id="WisataKu" font-family="AvenirNext-BoldItalic, Avenir Next" font-size="20" font-weight="bold" font-style="italic">
                            <tspan x="32" y="20">WisataKu</tspan>
                        </text>
                        <text id="l" font-family="BodoniOrnamentsITCTT, Bodoni Ornaments" font-size="18" font-weight="normal">
                            <tspan x="0" y="17">|</tspan>
                        </text>
                    </g>
                </g>
            </g>
        </svg> 


        <!-- Navigation -->
        <?php
         include("_userMenu.php");
        ?>

        <!-- Sign in button / User account button -->
       <?php
        include("_userAccountButton.php")
       ?>


      </div>
    </div>

        



        <!--
        <a class="navbar-brand" href="#">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>

           </button>
        </a>
      -->
        
    </div>
    <a class="navbar-brand" href="#"> </a>
  </nav>