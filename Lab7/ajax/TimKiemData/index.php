<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Live Search PHP va AJAX</title>

    <style>
        body {
            font-family: Arial;
            margin: 30px;
        }

        h2 {
            color: navy;
        }

        .search-box {
            width: 300px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            height: 35px;
            padding: 5px 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }

        .result {
            width: 100%;
            position: absolute;
            background: white;
            z-index: 999;
        }

        .result p {
            margin: 0;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-top: none;
            cursor: pointer;
        }

        .result p:hover {
            background: #eee;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
    $(document).ready(function() {

        $('.search-box input').on("keyup input", function() {

            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");

            if (inputVal.length > 0) {

                $.get("backend-search.php", {
                    term: inputVal
                }, function(data) {

                    resultDropdown.html(data);

                });

            } else {
                resultDropdown.empty();
            }
        });

        // Chon ket qua tim kiem
        $(document).on("click", ".result p", function() {

            $(this).parents(".search-box")
                   .find("input")
                   .val($(this).text());

            $(this).parent(".result").empty();

        });

    });
    </script>
</head>

<body>

    <h2>Tim kiem hoc phan</h2>

    <div class="search-box">

        <input type="text"
               placeholder="Nhap ten hoc phan..."
               autocomplete="off">

        <div class="result"></div>

    </div>

</body>
</html>