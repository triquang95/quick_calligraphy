<?php
session_start();
error_reporting(0);
include('partials/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include("partials/head.php");
?>

<body>

<!-- Navigation -->
<?php include('partials/header.php'); ?>

<!-- Page Content -->
<div class="container" style="padding: 20px;">

    <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8" style="height: 100%;border: 1px solid #eee;padding: 20px;">


            <!-- Blog Post -->
            <?php
            if ($_POST['searchtitle'] != ''):
                $st = $_SESSION['searchtitle'] = $_POST['searchtitle'];
            endif;
            $st;
            if (isset($_GET['pageno'])) :
                $pageno = $_GET['pageno'];
            else :
                $pageno = 1;
            endif;
            $no_of_records_per_page = 5;
            $offset = ($pageno - 1) * $no_of_records_per_page;
            $total_pages_sql = "SELECT COUNT(*) FROM post";
            if (isset($conn)) {
                $result = mysqli_query($conn, $total_pages_sql);
            }
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $query = mysqli_query($conn, "select post.id as pid,post.PostTitle as posttitle,
       category.CategoryName as category,subcategory.Subcategory as subcategory,post.PostDetails as postdetails,
       post.PostingDate as postingdate,post.PostUrl as url from post left join category
        on category.id=post.CategoryId left join  subcategory on  subcategory.SubCategoryId=post.SubCategoryId
        where post.PostTitle like '%$st%' and post.Is_Active=1 LIMIT $offset, $no_of_records_per_page");
            $rowcount = mysqli_num_rows($query);
            if ($rowcount == 0):
                echo "No record found";
            else :
                while ($row = mysqli_fetch_array($query)) :
                    ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                            <a href="feedback.php?nid=<?php echo htmlentities($row['pid']) ?>" class="btn btn-primary">Read
                                More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on <?php echo htmlentities($row['postingdate']); ?>

                        </div>
                    </div>
                <?php endwhile; ?>

                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
                    <li class="<?php if ($pageno <= 1) {
                        echo 'disabled';
                    } ?> page-item">
                        <a href="<?php if ($pageno <= 1) {
                            echo '#';
                        } else {
                            echo "?pageno=" . ($pageno - 1);
                        } ?>" class="page-link">Prev</a>
                    </li>
                    <li class="<?php if ($pageno >= $total_pages) {
                        echo 'disabled';
                    } ?> page-item">
                        <a href="<?php if ($pageno >= $total_pages) {
                            echo '#';
                        } else {
                            echo "?pageno=" . ($pageno + 1);
                        } ?> " class="page-link">Next</a>
                    </li>
                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                </ul>
            <?php endif; ?>
            <!-- Pagination -->
            <?php include('partials/sidebar.php'); ?>
        </div>

        <!-- Sidebar Widgets Column -->

    </div>

</div>

<!-- Footer -->
<?php include('partials/footer.php'); ?>

</body>

</html>
