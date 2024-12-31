<?php
$title = "User Info";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

if (isset($_GET['infoid'])) {
    $id = str_replace('_', ' ', $_GET['infoid']);
} else {
    echo "No booking ID provided.";
    exit();
}

?>

<main class="mt-5 pt-3">
<div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center my-3">Clients Information</h1>
            </div>
            <div class="card-body">
                <?php
                $sql = "SELECT * FROM clients WHERE id='$id'";
                $result = mysqli_query($conn, $sql);

                if ($result && $row = mysqli_fetch_assoc($result)) {

                    $bookingDetails = [
                        "ID" => $row['id'],
                        "Client name" => $row['client_name'],
                        "Full name" => $row['full_name'],
                        "Email" => $row['email'],
                        "Phone Number" => $row['phone_num'],
                        "Status" => $row['status'],
                        "Address" => $row['address'],
                        "IC No" => $row['ic_no'],
                        "Driver No" => $row['driver_no'],
                        "Bank No" => $row['bank_no'],
                        "Bank Type" => $row['bank_type'],
                        "Date Created" => $row['date'],   
                    ];
                ?>
                    <div class="row justify-content-center">
                        <div class=" col-md-9">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <?php foreach ($bookingDetails as $key => $value): ?>
                                        <tr>
                                            <th><?php echo $key; ?></th>
                                            <td><?php echo $value; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                } else {
                    $errorMessage = $result ? "No booking found with this ID." : "Error fetching booking details: " . mysqli_error($conn);
                    echo "<p class='text-center text-danger'>{$errorMessage}</p>";
                }
                ?>
            </div>
        </div>
    </div>
</main>

