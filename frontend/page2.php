<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Data Display</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js">
    </script>
    <script src="./custom.js?v=<?php echo time(); ?>"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- Option 1: Include in HTML -->
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
        <div id="ladname">
            <h1>LAD 01</h1>
        </div>
        <div id="data-list"></div>
        <div id="sidebar" class="style-7">
            <h2>
                Etat de Stock min
            </h2>
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
                            <label for="kurzname">Kurzname:</label>
                            <input required type="text" class="form-control" id="kurzname" name="kurzname">
                        </div>
                        <div class="form-group">
                            <label for="leoniPartNumber">Leoni Part Number:</label>
                            <input required type="text" class="form-control" id="leoniPartNumber" name="leoniPartNumber">
                        </div>
                        <div class="form-group">
                            <label for="customerPartNumber">Customer Part Number:</label>
                            <input required type="text" class="form-control" id="customerPartNumber" name="customerPartNumber">
                        </div>
                        <div class="form-group">
                            <label for="typeOfKaba">Type de position:</label>
                            <select class="form-control" id="typeOfKaba" name="typeOfKaba"> 
                                <option value="KABA0"> KABA0</option>
                                <option value="KABA1"> KABA1</option>
                                <opion value="KABA2">KABA2 </opion>
                                <option value="KABA3"> KABA3</option>
                                <option value="PAVIOL"> PAVIOL</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lad">LAD:</label>
                            <input required type="text" class="form-control" id="lad" name="lad">
                        </div>
                        <div class="form-group">
                            <label for="poste">Poste:</label>
                            <input required type="number" class="form-control" id="poste" name="poste">
                        </div>
                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input required type="text" class="form-control" id="position" name="position">
                        </div>
                        <div class="form-group">
                            <label for="color">Couleur:</label>
                            <select class="form-control" id="color" name="color">
                                <option value="WS">Blanc</option>
                                <option value="SW">Noir</option>
                                <option value="BR">Maroon</option>
                                <option value="BL">Blue</option>
                                <option value="GR">Green</option>
                                <option value="GE">Jaune</option>
                                <option value="RT">Rouge</option>
                                <option value="GN">Orange</option>
                                <option value="VI">Violet</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qtyPerLoop">Qty per Loop:</label>
                            <input required type="number" class="form-control" id="qtyPerLoop" name="qtyPerLoop">
                        </div>
                        <div class="form-group">
                            <label for="minQty">Min Qty:</label>
                            <input required type="number" class="form-control" id="minQty" name="minQty">
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight (gr):</label>
                            <input required type="text" class="form-control" id="weight" name="weight">
                        </div>
                        <div class="form-group">
                            <label for="maxQty">Max Qty:</label>
                            <input required type="number" class="form-control" id="maxQty" name="maxQty">
                        </div>
                        <div class="form-group">
                            <label for="poids_kaba">Poid de Kaba:</label>
                            <input required type="text" class="form-control" id="poids_kaba" name="poids_kaba">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <button onclick="closeModal()" class="btn btn-primary">Close</button>
        </div>
    </div>
</div>


</body>

</html>
<?php
