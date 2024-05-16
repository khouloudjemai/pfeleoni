<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 1</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


    <style>
        body {
            background-image: url('Hblack.png');
            background-repeat: no-repeat;
            background-size: cover;

        }

        .container {
            background-color: #0000004d;
            width: fit-content;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            border-radius: 16px;
            -webkit-box-shadow: 10px 10px 41px -53px rgba(255, 255, 255, 1);
            -moz-box-shadow: 10px 10px 41px -53px rgba(255, 255, 255, 1);
            box-shadow: 10px 10px 41px -53px rgba(255, 255, 255, 1);
        }

        form {
            width: 400px;
            display: flex;
            flex-direction: column;
            justify-items: center;
            justify-content: center;

        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            justify-content: center;
            align-items: center;
            display: block;
            margin: 0 auto;


        }

        button:hover {
            background-color: #0056b3;
        }

        #error_msg {
            border: 1px solid;
            margin: 10px 0px;
            padding: 15px 10px 15px 50px;
            background-repeat: no-repeat;
            background-position: 10px center;
            color: #D8000C;
            background-color: #FFBABA;
            background-image: url('https://i.imgur.com/GnyDvKN.png');
        }

        .khulud {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .khulud .title {
            color: #fff;
            font-family: "Montserrat", sans-serif;
            /* font-style: italic; */
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <section class="khulud">
        <div class="container">
            <img src="leoni.png" alt="" srcset="" height="75">
            <h1 class="title">Stock Managing application</h1>
            <form method="POST" action="auth.php">
                <input type="text" id="username" name="username" placeholder="username" required><br>
                <input type="password" id="password" name="password" placeholder="password" required><br>
                <div id="error_msg" style="display : none"> </div>

                <button type="button" onclick="submitform()">Login <i class="bi bi-box-arrow-in-left"></i></button>
            </form>
        </div>
    </section>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var usernameinput = document.getElementById('username');
        var passwordinput = document.getElementById('password');

        usernameinput.addEventListener('keydown', function (event) {
            if (event.key === "Enter") {
                event.preventDefault()
                submitform();
            }
        });
        passwordinput.addEventListener('keydown', function (event) {
            if (event.key === "Enter") {
                event.preventDefault()
                submitform();
            }
        });

    });

    function submitform() {
        var username = document.getElementById('username').value;
        var passsword = document.getElementById('password').value;
        var xhr = new XMLHttpRequest();


        xhr.open("POST", 'auth.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            console.log(3)

            if (xhr.readyState === 4) {
                console.log(2)

                if (xhr.status === 200) {
                    console.log(1)
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    if (response.success) {
                        window.location.href = 'page2.php';
                        document.getElementById('error_msg').style.display = "none"

                    } else {
                        document.getElementById('error_msg').style.display = "block"
                        document.getElementById('error_msg').innerHTML = response.message;
                        console.log(response.message);
                    }
                } else {
                    console.error("Error :", xhr.status)
                }
            }
        };
        var data = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(passsword)
        xhr.send(data)
    }
</script>

</html>