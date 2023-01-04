<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>
    <script>
        let send = () => {
            request = new XMLHttpRequest();
            request.onreadystatechange = showResult;

            let keyword = document.getElementById("keyword").value;
            let url = "process.php?keyword=" + keyword;
            request.open("GET", url, true);
            request.send(null);
        }

        function showResult() {
            if (request.readyState == 4) {
                if (request.status == 200) {
                    document.getElementById("result").innerHTML = request.responseText;
                }
            }
        }
    </script>
    <input type="text" id="keyword" onkeyup="send()">
    <div id="result"></div>
</body>

</html>