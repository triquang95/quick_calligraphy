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
<div class="container">
		<div class="col-md-9 bann-right">

<!-- Navigation -->
<?php include('partials/header.php'); ?>

<!-- Page Content -->
<div class="container" style="padding: 20px;">

    <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8" style="height: 100%;border: 1px solid #eee;padding: 20px;">


            <!-- Blog Post -->
            <?php
        if ($_GET['catid'] != '') {
            $_SESSION['catid'] = intval($_GET['catid']);
        }

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $total_pages_sql = "SELECT COUNT(*) as total FROM post left join category on category.id=post.CategoryId left join  subcategory on  subcategory.SubCategoryId=post.SubCategoryId where post.CategoryId='" . $_SESSION['catid'] . "' and post.Is_Active=1";
        if (isset($conn)) {
            $result = mysqli_query($conn, $total_pages_sql);
        }
        $row = mysqli_fetch_array($result);
        $total_rows = $row['total'];
        if ($total_rows > $no_of_records_per_page):
            $total_pages = ceil($total_rows / $no_of_records_per_page);
        endif;
        if (isset($_GET['page']) && is_numeric($_GET['page']) && (int)$_GET['page'] >= 1 && (int)$_GET['page'] <= $no_of_records_per_page):
            $page = $_GET['page'];
        else:
            $page = 1;
        endif;

        $start = ($pageno - 1) * $no_of_records_per_page;
        // echo "<script type='text/javascript'>alert('$total_pages');</script>";


        $query = mysqli_query($conn, "select post.id as pid,post.PostTitle as posttitle,
post.PostImage,category.CategoryName as category,subcategory.Subcategory as subcategory,
post.PostDetails as postdetails,post.PostingDate as postingdate,post.PostUrl as url from post left join category on category.id=post.CategoryId left join  subcategory on  subcategory.SubCategoryId=post.SubCategoryId where post.CategoryId='" . $_SESSION['catid'] . "' and post.Is_Active=1 order by post.id desc LIMIT $start, $no_of_records_per_page");

        $rowcount = mysqli_num_rows($query);
        if ($rowcount == 0) {
            echo "No record found";
        } else {
            while ($row = mysqli_fetch_array($query)) {


                ?>
                    <div class="card mb-4">
                        <div class="card-body">
                        <div class="blog-artical-info-img">

<img src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>"
     alt="<?php echo htmlentities($row['posttitle']); ?>">
</div>
                            <h4 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h4>
                            
                            
                            <a href="feedback.php?nid=<?php echo htmlentities($row['pid']) ?>" class="btn btn-primary">Read
                                More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on <?php echo htmlentities($row['postingdate']); ?>

                        </div>
                    </div>
                <?php } ?>

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
            <?php } ?>
            <!-- Pagination -->
            <?php include('partials/sidebar.php'); ?>
        </div>

        <!-- Sidebar Widgets Column -->

    </div>

</div>
</div>
    </div>
<!-- Footer -->
<?php include('partials/footer.php'); ?>

</body>

</html>
