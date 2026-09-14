<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Future Value Calculator</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <main>
        <h1>Future Value Calculator</h1>

        <form action="display_results.php" method="post">

            <div>
                <label>Investment Amount:</label>
                <input type="text" name="investment">
            </div>

            <div>
                <label>Yearly Interest Rate:</label>
                <input type="text" name="interest_rate">
            </div>

            <div>
                <label>Number of Years:</label>
                <input type="text" name="years">
            </div>

            <div>
                <label>&nbsp;</label>
                <input type="submit" value="Calculate">
            </div>

        </form>
    </main>

</body>
</html>