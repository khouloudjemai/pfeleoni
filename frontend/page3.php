<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="page3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Data Display</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js">
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>





<body>

    <div class="navbar  fixed-top">

        <img src="leoni_logo.png" alt="Bootstrap" height="40px">
        <h1 class="title">Stock Managing application</h1>
        <a href="/page1.php" class="title"> <i class="bi bi-box-arrow-right"></i></a>

    </div>

    <div id="topbar_posts" class="">

    </div>
    <div id="dashboard" class="dashboard">
        <div id="admin">
            <h1>admin</h1>
        </div>
        <div id="liste">
            <div id="configuration_des_LAD">
                <h2 class="conf" style="
                  padding-left: 500px;">configuration des LAD </h2>
            </div>
            <div id="analyse">
                <div id="support">
                    <span class="stock_min" style="
                       margin-left: 50px;
                       font-size: larger;
                        ">

                        <spn class="icon">
                            <div class="icon">🔴 </div>
                            <div class="bg-[#D82C06] p-2 text-center border text-white"></div>
                    </span></spn>
                    <span style="
                          font-size: large;
                                            ">stock_min</span>

                    <span class="stock_max" style="
                       margin-left: 50px;
                       font-size: larger;
                        "><span class="icon">
                            <div class="icon">🟢</div>
                            <div class="bg-[#9c9a9a] p-2 text-center border text-white"></div>
                        </span>
                        <span style="
                          font-size: large;
                                            ">stock_max</span></span>
                    <span class="kaba">
                        <div class="icon">🔵</div>Paviol
                    </span>
                    <span class="paviol1">
                        <div class="bg-[##090970] p-2 text-center border text-white"></div> Kaba
                    </span>

                    <div id="utilisateure">
                        <h1 class="utilisateure">les utilisateurs actuels :</h1>
                        <div class="display-container" id="displayContainer">
                            <!-- Le nom de l'utilisateur sera affiché ici -->
                        </div>
                    </div>
                </div>

                <div id="lad">
                    <div id="lad_poste">
                        <div id="lad1">
                            <div id="lad_name">
                                <h6>LAD1</h6>
                            </div>
                            <div id="position_de_lad">
                                <div id="position">

                                </div>
                            </div>

                        </div>
                        <div id="lad2"></div>
                        <div id="lad3"></div>
                        <div></div>
                    </div>
                    <div id="statistique">

                    <div class="statistique-row">
                    <canvas id="myChart" width="116" width="116"></canvas>
                    <canvas id="chartpie" width="116" width="116"></canvas>

                    </div>


                    </div>
                    <div id="alerte">
                        <h1>etat de stock</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="container mt-5">
                    <h2 class="mb-4">Insert Data Form</h2>
                    <form id="insertForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="leoniPartNumber">lad:</label>
                                    <input type="text" class="form-control" id="lad" name="lad">
                                </div>
                                <div class="form-group">
                                    <label for="typeOfKaba"> type_de_position:</label>
                                    <input type="text" class="form-control" id="type_de_position"
                                        name="type_de_position">
                                </div>
                                <div class="form-group">
                                    <label for="updateDate">UPDATE Date:</label>
                                    <input type="text" class="form-control" id="updateDate" name="updateDate">
                                </div>
                            </div>
                            <label for="minQty">Min Qty:</label>
                            <input type="number" class="form-control" id="minQty" name="minQty">
                        </div>
                        <div class="form-group">
                            <label for="minQty">Max Qty:</label>
                            <input type="number" class="form-control" id="maxQty" name="maxQty">
                        </div>
                        <div class="form-group">
                            <!-- #region --> <label for="poste">Poste:</label>
                            <input type="number" class="form-control" id="poste" name="poste">
                        </div>
                        <div class="form-group">
                            <label for="positionY">Position :</label>
                            <input type="number" class="form-control" id="positionY" name="positionY">
                        </div>
                        <div class="form-group">
                            <label for="qtyPerLoop">Qty per Loop:</label>
                            <input type="number" class="form-control" id="qtyPerLoop" name="qtyPerLoop">
                        </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

            </form>
            <button onclick="closeModal()" class="btn btn-primary">close</button>

        </div>
    </div>
    </div>

</body>
<script src="./custom3.js"></script>

</html>
<?php




