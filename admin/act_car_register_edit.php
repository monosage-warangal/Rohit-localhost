<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User Profile</h6>
        </div>

        <div class="card-body">

            <?php if (isset($_POST['edit_btn'])) {
                $connection = mysqli_connect("localhost", "root", "", "car_users");
                $cid = $_POST['edit_carid'];
                $query = "SELECT * FROM cars WHERE car_id = '$cid'";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
                    $details = isset($row['details']) ? json_decode($row['details'], true) : [];
                    $images = isset($row['images']) ? json_decode($row['images'], true) : [];
            ?>

                    <form action="acar_code.php" method="post">
                        <input type="hidden" name="edit_carid" value="<?php echo $row['car_id'] ?>">
                        <div class="form-group">
                            <label>Car Name</label>
                            <input type="text" name="edit_carname" value="<?php echo $row['title'] ?>" class="form-control" placeholder="Enter Carname">
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" name="edit_year" value="<?php echo $row['year'] ?>" class="form-control" placeholder="Enter Year">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="edit_price" value="<?php echo $row['price'] ?>" class="form-control" placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label>Details</label>
                            <div id="details-group">
                                <!-- Initially show only the first detail input -->
                                <input type="text" name="edit_details[]" value="<?php echo $details[0] ?? ''; ?>" class="form-control mb-2" placeholder="Model">
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="addDetail()">Add More Details</button>
                        </div>
                        <div class="form-group">
                            <label>Images</label>
                            <div id="images-group">
                                <?php foreach ($images as $image) { ?>
                                    <input type="text" name="edit_images[]" value="<?php echo $image; ?>" class="form-control mb-2" placeholder="Enter Image URL">
                                <?php } ?>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="addImage()">Add More Images</button>
                        </div>
                        <div class="form-group">
                            <label>License Number</label>
                            <input type="text" name="edit_license_number" value="<?php echo $row['license_number'] ?>" class="form-control" placeholder="Enter License Number">
                        </div>
                        <div class="form-group">
                            <label>Owner Name</label>
                            <input type="text" name="edit_owner_name" value="<?php echo $row['car_owner'] ?>" class="form-control" placeholder="Enter Owner Name">
                        </div>
                        <div class="form-group">
                            <label>Car Status</label>
                            <input type="text" name="edit_car_status" value="<?php echo $row['car_status'] ?>" class="form-control" placeholder="Enter Car Status">
                        </div>
                        <a href="active_cars.php" class="btn btn-danger">CANCEL</a>
                        <button type="submit" name="cupdatebtn" class="btn btn-primary">Update</button>
                    </form>

            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<script>
    var detailNames = ["Model", "Type", "Large Bag", "Small Bags", "Persons", "Tagline", "l.km", "Detail 1", "Detail 2", "Detail 3", "Detail 4", "Detail 5"];
    var detailIndex = 1; // Start from the second detail since the first is already shown

    function addDetail() {
        if (detailIndex < detailNames.length) {
            var detailsGroup = document.getElementById('details-group');
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'edit_details[]';
            input.className = 'form-control mb-2';
            input.placeholder = detailNames[detailIndex];
            detailsGroup.appendChild(input);
            detailIndex++;
        }
    }

    function addImage() {
        var imagesGroup = document.getElementById('images-group');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'edit_images[]';
        input.className = 'form-control mb-2';
        input.placeholder = 'Enter Image URL';
        imagesGroup.appendChild(input);
    }
</script>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>