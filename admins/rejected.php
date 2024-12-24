<?php
$title = "Rejected";
require_once("includes/headerAdmins.php");
include "../db_conn.php";
?>

<main class="mt-5 pt-3">
    <div class="container mt-3 gap">
        <div class="row justify-content-center">
            <div class="col-md-13 mb-4">
                <div class="card ">
                    <div class="card-header">
                        <h2 class="card-title">Rejected Clients</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Clientname</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM clients WHERE status = 'Rejected'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $name = $row['full_name'];
                                            $client_name = $row['client_name'];
                                            $phonenum = $row['phone_num'];
                                            $email = $row['email'];
                                            $status = $row['status'];

                                            echo '<tr>
                                            <td>' . $id . '</td>
                                            <td>' . $name . '</td>
                                            <td>' . $client_name . '</td>
                                            <td>' . $phonenum . '</td>
                                            <td>' . $email . '</td>
                                            <td>' . $status . '</td>
                                            <td>
                                            <a title="View" href="clients-info.php?infoid=' . $id . '" class="ms-3"><i class="bi bi-eye-fill"></i></a>
                                                <a title="Update" href="clients-update.php?updateid=' . $id . '" class="ms-3"><i class="bi text-warning bi-pencil-fill"></i></a>
                                                <a title="Delete" href="clients-delete.php?deleteid=' . $id . '" class="ms-3"><i class="bi text-danger bi-trash-fill"></i></a>
                                            </td>
                                        </tr>';
                                        }
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
