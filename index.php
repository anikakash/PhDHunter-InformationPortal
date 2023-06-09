<?php include("header.php"); ?>
<?php include("dbcon.php"); ?>

<div class="mx-auto" style="width: 80vw;">
    <form action="" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" required value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control" placeholder="Search University">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <?php
    $query = "SELECT * FROM unis ORDER BY id ASC";
    if (isset($_GET['search'])) {
        $filtervalues = $_GET['search'];
        $query = "SELECT * FROM unis WHERE (location LIKE '%$filtervalues%' OR uniName Like '%$filtervalues%')";
    }
    $query_run = mysqli_query($connection, $query);
   if($query_run){
    $num_rows = mysqli_num_rows($query_run);
        if ($num_rows>0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <div class='university-list'>
                    <h2><?php echo $row['uniName']; ?></h2>
                    <div class="info" style="display: flex">
                        <h5><i class="fa-duotone fa-map-location"></i> <?php echo $row['location']; ?></h5>
                        <h5><i class="fa-duotone fa-graduation-cap"></i> <?php echo $row['semester']; ?> Semesters</h4>
                        <h5><i class="fa-duotone fa-building-columns"></i> <?php echo $row['type']; ?></h4>
                    </div>
                    <p><?php echo $row['description']; ?> <a href="university_info.php?id=<?php echo $row['id'];?>">Learn More</a></p>
                </div>
        <?php
            }
        } 
        else {
            ?><div class='university-list'> <p>No Data</p> </div><?php
        }
        
   }
    ?>
</div>

<?php include("footer.php"); ?>
