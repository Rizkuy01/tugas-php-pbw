<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Books</title>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-image: url('https://cdn.pixabay.com/photo/2016/01/19/01/42/library-1147815_960_720.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .book-card {
            background-color: rgba(255, 255, 255, 0.8);
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="main w-80 d-flex align-items-center justify-content-center min-vh-100 text-light">
    <div class="container">
        <div class="d-flex justify-content-end mb-3"> 
            <button type="button" class="btn btn-primary addButton" data-bs-toggle="modal" data-bs-target="#bookModal">
                Add Book
            </button>
        </div>
        <table class="table" width="100%" id="table-book">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Code Book</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once 'connect.php';
            require_once 'delete.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            
                // Memanggil fungsi deleteBook untuk menghapus data dari database
                if (deleteBook($id)) {
                    echo "<div class='alert alert-success' role='alert'>Record deleted successfully</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Error deleting record</div>";
                }
            }
            
            $sql = "SELECT code_book, name, qty FROM books";
            $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["code_book"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["qty"] . "</td>";
                        echo "<td><a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Data not found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_book.php" method="POST">
                    <div class="mb-3">
                        <label for="code_book" class="form-label">Code Book</label>
                        <input type="text" class="form-control" id="code_book" name="code_book" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-book').DataTable();
        });
    </script>
</body>
</html>
