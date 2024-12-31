<?php
$title = "Refund Info";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

if (isset($_GET['infoid'])) {
    $id = str_replace('_', ' ', $_GET['infoid']);
} else {
    echo "No refund ID provided.";
    exit();
}

?>

<main class="mt-5 pt-3">
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center my-3">Refund Info</h1>
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
                            <th scope="col">Stripe ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM bookings WHERE id='$id'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            if ($row = mysqli_fetch_assoc($result)) {
                                $user_name = $row['user_name'];
                                $invoice_no = $row['invoice_no'];
                                $invoice_date = $row['invoice_date'];
                                $refund_id = $row['refund_id'];
                                $stripe_id = $row['stripe_id'];
                                $refund_date = $row['refund_date'];
                                $refund_total = $row['refund_total'];

                                echo '<tr>
                                    <td>' . $refund_id . '</td>
                                    <td>' . $user_name . '</td>
                                    <td>' . $invoice_no . '</td>
                                    <td>' . $invoice_date . '</td>
                                    <td>' . $refund_date . '</td>
                                    <td>' . $refund_total . '</td>
                                    <td>' . $stripe_id . '</td>
                                </tr>';
                            } else {
                                echo '<tr><td colspan="6" class="text-center">No refund found with this ID.</td></tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6" class="text-center">Error fetching refund details: ' . mysqli_error($conn) . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>