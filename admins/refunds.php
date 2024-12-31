<?php
$title = "Refunds";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

?>

<main class="mt-5 pt-3">

    <div class="container mt-3 gap">
        <div class="row justify-content-center">
            <div class="col-md-13 mb-4">
                <div class="card ">
                    <div class="card-header">
                        <h2 class="card-title">Refunds Management</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Refund ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Invoice Date</th>
                                        <th scope="col">Refund Date</th>
                                        <th scope="col">Refund Total</th>
                                        <th scope="col">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM bookings WHERE refund_id IS NOT NULL AND refund_id != ''"; 
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $id = $row['id'];
                                                $refund_id = $row['refund_id'];
                                                $user_name = $row['user_name'];
                                                $invoice_no = $row['invoice_no'];
                                                $invoice_date = $row['invoice_date'];
                                                $refund_date = $row['refund_date'];
                                                $refund_total = $row['refund_total'];

                                                echo '<tr>
                                                <td>' . ($refund_id ? $refund_id : 'N/A') . '</td>
                                                <td>' . $user_name . '</td>
                                                <td>' . $invoice_no . '</td>
                                                <td>' . $invoice_date . '</td>
                                                <td>' . $refund_date . '</td>
                                                <td>' . $refund_total . '</td>
                                                <td>
                                                    <a title="View" href="refunds-info.php?infoid=' . $id . '" class="ms-5"><i class="bi bi-eye-fill"></i></a>
                                                </td>
                                            </tr>';
                                             }
                                        } else {
                                            echo '<tr><td colspan="7" class="text-center">No refunds found.</td></tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="7" class="text-center">Error executing query.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>