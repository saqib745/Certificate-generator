<?php

define('DB_USER', "root"); // db user
define('DB_PASSWORD', ""); // db password (mention your db password here)
define('DB_DATABASE', "CollegePortal"); // database name
define('DB_SERVER', "localhost"); // db server

    session_start();

    $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("unable to connect");

    if ( !isset($_SESSION['id']) ) {
        header("Location: a_login.php?activity=expired");
    }
    
    $sql = "SELECT post_id, post_date, post_time, post_title, post_description FROM posts order by post_id desc";
    $result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Certificate Generator | MOHAMMAD SAQIB</title>
    <!--  code bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="vendor/joystick.js"></script>
</head>

<body>

    <header>

                    <i class="fa fa-envelope"></i>
                    <span>principalgpg@gmail.com</span>
                    <i class="fa fa-phone"></i>
                    <span>0120 2719500</span>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mu-header-top-left text-right">
            <h5 class="pt-1">
             <button type="button" class="btn btn-outline-success">
                 <a href="logout.php">Logout</a>
              </button> 
            </h5>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                <a href="home.php"><img src="assets/img/logo.png" width="200px" class="img-responsive fdf" alt="GPG Logo"></a>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">
                <a href="home.php"><img src="assets/img/logo2.png" style="border-radius: 45px;" width="100%" class="img-responsive fdf" alt="GPG Logo"></a>
            </div>
        </div>

        <h1 class="pt-4">
            <marquee> Welcome To login and this Website is designed by Students of IT Department</marquee>
        </h1>
    </header>
    <main id="main">
        <div class="toolscontainer">
            <div class="textforamtting">
                <select id="fontfamily" class="font-family">
            <option value="Arial">Arial</option>
            <option value="sans-serif">Arial Black</option>
            <option value="Courier New">Courier New</option>
            <option value="Georgia">Georgia</option>
            <option value="Helvetica">Helvetica</option>
            <option value="cursive">cursive</option>
            <option value="monospace">monospace</option>
            <option value="Castellar">Castellar</option>
            <option value="Ravie">Ravie</option>
            <option value="Gigi">Gigi</option>
            <option value="Chiller">Chiller</option>
            <option value="Bradley Hand ITC">Bradley Hand ITC</option>
            <option value="Edwardian Script ITC">Edwardian Script ITC</option>
            <option value="Rage Italic">Rage Italic</option>
            <option value="Vivaldi">Vivaldi</option>
            <option value="Bahnschrift">Bahnschrift</option>
            <option value="Algerian">Algerian</option>
            <option value="Bernard MT Condensed">Bernard MT Condensed</option>
            <option value="Times New Roman">Times New Roman</option>
            <option value="Verdana">Verdana</option>
            <option value="Comic Sans MS">Comic Sans MS</option>
            <option value="Impact">Impact</option>
            <option value="Lucida Console">Lucida Console</option>
            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
          </select>
                <select id="fontsize">
            <option value="1">1x</option>
            <option value="2">2x</option>
            <option value="3">3x</option>
            <option value="4">4x</option>
            <option value="5">5x</option>
            <option value="6">6x</option>
            <option value="7">7x</option>
            <option value="8">8x</option>
            <option value="9">9x</option>
            <option value="10">10x</option>
          </select>
                <select id="textalign">
            <option value="left">Left</option>
            <option value="center">Center</option>
            <option value="right">Right</option>
          </select>
            </div>
            <div class="textforamtting">
                <button id="textbold" class="formattool" data-active="0">B</button>
                <button id="textitalic" class="formattool" data-active="0">I</button>
                <input type="color" id="textcolor" />
                <div class="slidecontainer">
                    <input type="range" min="0" max="100" value="80" class="slider" id="textopacity" />
                </div>
            </div>
        </div>

        <div>
            <div id="containerdiv" >
                <div id="certificatediv" >
                    <canvas id="certificatecanvas" ></canvas>
                    <!-- dsdd<img src="certificates/dummy.jpg" width="100%"> -->
                </div>
                <div class="downloadcontainer downloadfile">
                    <div>
                        Download as:
                        <select id="downloadtype">
                <option value="png">PNG</option>
                <option value="jpg">JPG</option>
                <option value="jpg">JPEG</option>
                <option value="pdf">PDF</option>
                <option value="pdf">xlxs</option>
              </select>
                    </div>
                    <div>
                        <button id="downloadbutton" class="button">Download</button>
                    </div>
                </div>
                <div class="downloadcontainer downloadzip">
                    <button id="downloadzipbutton" class="button">Download Zip</button>
                </div>
            </div>
            <div id="asidebar">
                <div id="editor"></div>
                <div class="uploadcontainer">
                    <!--  only Image Files -->
                    <label class="button uploadlabel">
              Upload certificate format
              <input
                id="uploadimage"
                type="file"
                class="button"
                value="Upload Image"
                accept="image/*"
              />
            </label>
                </div>
                <div id="inputs">
                    <div>
                        <input type="checkbox" class="certcheck" />
                        <input type="text" value="Candidate's Name" data-fontsize="7" data-font="Verdana" data-textalign="center" data-x="50" data-y="42" data-color="#000" data-opacity="80" data-bold="1" data-italic="0" class="certinputs" />
                        <button class="delbutton"><i class="fa fa-trash"></i></button>
                    </div>
                    <div>
                        <input type="checkbox" class="certcheck" />
                        <input type="text" value="Collage's Name" data-fontsize="4" data-font="Verdana" data-textalign="center" data-x="50" data-y="26" data-color="#000" data-opacity="80" class="certinputs" data-bold="0" data-italic="0" />

                        <button class="delbutton"><i class="fa fa-trash"></i></button>
                    </div>
                    <div>
                        <input type="checkbox" class="certcheck" />
                        <input type="text" value="using php " data-fontsize="3" data-font="Verdana" data-textalign="center" data-x="50" data-y="64" data-color="#000" data-opacity="80" class="certinputs" data-bold="0" data-italic="0" />
                        <button class="delbutton"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="optionscontainer">
                    <button id="addinput"><i class="fa fa-plus"></i>New Add</button>
                </div>
                <div style="display: flex; justify-content: center">
                    <div style="width: 128px; position: relative">
                        <img src="https://www.cssscript.com/demo/touch-joystick-controller/images/joystick-base.png" />
                        <div id="stick" style="position: absolute; left: 32px; top: 32px">
                            <img src="https://www.cssscript.com/demo/touch-joystick-controller/images/joystick-blue.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="loaderbody">
        <div>
            <span id="progress">-/-</span>

        </div>
    </div>
    <!-- Footer -->
    <!-- Remove the container if you want to extend the Footer to full width. -->
    <div class="container my-5">

        <footer class="text-white text-center text-lg-start bg-dark">


            <!-- Grid container -->
            <div class="container p-4">
                <!--Grid row-->
                <div class="row mt-4">
                    <!--Grid column-->
                    <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">MOHAMMAD SAQIB</h5>
                       
</br>

                        <p>
                            I'm student of government polytechnic ghaziabad
                             from Information Technology Department. I want to
                              say that this project work is only design Certificate on a website.
                        </p>
                        <div class="mt-4">
                            <!-- Facebook -->
                            <a type="button" class="btn btn-floating btn-light btn-lg" href="https://www.facebook.com/default.saqib/"><i class="fa fa-facebook-f"></i></a>
                            <!-- Dribbble -->
                            <a type="button" class="btn btn-floating btn-light btn-lg"href="https://www.instagram.com/defaulter_saqib/"><i class="fa fa-instagram"></i></a>
                            <!-- Twitter -->
                            <a type="button" class="btn btn-floating btn-light btn-lg"href="https://www.linkedin.com/in/saqib745"><i class="fa fa-linkedin fa-fw"></i></a>
                        </div>
                    </div>
                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <div class="rounded bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 650px;border-radius: 40px; height: 28 0px;border:5px solid">
                            <img src="assets/img/team.png" height="100%" width="100%" alt="" />
                        </div>
                    </div>
                </div>
                <!--Grid row-->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2022 Developed by :
                <a class="text-white" href="https://www.instagram.com/defaulter_saqib/"> Mohammad saqib</a>
            </div>
            <!-- Copyright -->
        </footer>

    </div>
    <!-- End of .container -->
    <!-- Footer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.3/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip-utils/0.1.0/jszip-utils.min.js"></script>
    <script src="assets/script.js"></script>
    <marquee> finally  thank you visted our website.Prograss Working soon</marquee>
</body>

</html>