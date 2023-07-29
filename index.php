<?php
    // Connect to the MySQL database
    $conn = new mysqli('localhost', 'root', '', 'employeedata');

    // Check if the connection was successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Get the values entered in the textboxes
    $numRows = isset($_POST['NumberOfRecords']) ? (int)$_POST['NumberOfRecords'] : 0;
    $startIndex = isset($_POST['Index']) ? (int)$_POST['Index'] : 0;

    // Query the database to retrieve data from your table
    $result = $conn->query("SELECT * FROM employeeinfo");

    // Fetch the data as an associative array
    $data = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dataset Table</title>
        <style>
            body{
              
                background-color:hsla(0, 6%, 28%, 0.255);
            }
            /* Add styles for the sidebar */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 250px;
                background-image: url('sidebar-bg.jpg');
                background-color: #f5f5f5;
                padding: 20px;
                color: white;
            }

            /* Add styles for the main content */
            .main {
                margin-left: 220px;
                padding: 20px;
            }

            /* Add styles for the table */
            table {
                width:96%;
                border-collapse: collapse;
                margin-left: 5%;
                
                
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }
            div.List h2{
                margin-left: 288px;
                margin-top: 110px;
                background-color:white;
            }
            
        </style>
    </head>
    <body>

        <!-- Add a sidebar with two textboxes -->
        <div class="sidebar">
        <h1><i>Employee filter</i></h1><br><br><hr><br>
        <form method="POST">
        <p><i><center>Number of records:</center></i></p>
        <center><input type="number" id="numberofrecords" name="NumberOfRecords" required></center><br><br>

        <p><i><center>ID Starts:</center></i></p>
        <center><input type="number" id="index" name="Index" required></center><br><br>
        </form>
        </div>
        <div class="List">
            <h2><i>Employee List</i></h2>
        </div>

        <!-- Add the main content -->
        <div class="main">
            <!-- Display the data in an HTML table -->
            <table>
                <tr>
                    <?php foreach (array_keys($data[0]) as $col): ?>
                        <th><?= $col ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php for ($i = $startIndex; $i < count($data) && ($numRows == 0 || $i < $startIndex + $numRows); $i++): ?>
                    <tr>
                        <?php foreach ($data[$i] as $cell): ?>
                            <td><?= $cell ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>

        <!-- Add JavaScript code to listen for the keydown event on the input elements -->
        <script>
            // Get references to the input elements
            const inputs = document.querySelectorAll('#numberofrecords, #index');

            // Listen for the keydown event on each input element
            inputs.forEach(function(input) {
                input.addEventListener('keydown', function(event) {
                    // Check if the Enter key was pressed
                    if (event.key === 'Enter') {
                        // Submit the form
                        event.target.form.submit();
                    }
                });
            });
        </script>

    </body>
</html>
