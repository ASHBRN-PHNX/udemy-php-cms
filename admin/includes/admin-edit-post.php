<?php
/**
 * Created by PhpStorm.
 * User: Pacific Frost
 * Date: 5/12/2017
 * Time: 9:31 PM
 */
if(isset($_POST['edit_post'])) {
    var_dump($_POST);

    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_author = $_POST['post_author'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 1;
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $query = "UPDATE posts SET ";
    $query .= "post_category_id = {$post_category_id} ";
    $query .= "post_title = {$post_title} ";
    $query .= "post_author = {$post_author} ";
    $query .= "post_date = now() ";
    $query .= "post_image = {$post_image} ";
    $query .= "post_content = {$post_content} ";
    $query .= "post_tags = {$post_tags} ";
    $query .= "post_comment_count = {$post_comment_count} ";
    $query .= "post_status = {$post_status} ";

    $edit_post = mysqli_query($connection, $query);

    check_query($edit_post);

}
if(isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $edit_post_query = mysqli_query($connection, $query);

    check_query($edit_post_query);

    $row = mysqli_fetch_assoc($edit_post_query);

    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];

?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select class="form-control" name="post_category_id">
            <?php
            $query = "SELECT * FROM categories";
            $select_all_categories = mysqli_query($connection, $query);
            check_query($select_all_categories);

            while($row = mysqli_fetch_assoc($select_all_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <div class="row">
            <div class="col-xs-12" style="margin-bottom: 10px;">
                <img src="../images/<?php echo $post_image; ?>" alt="Original Post Image" width="400">
            </div>
        </div>
        <input type="file" class="form-control" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
    </div>
</form>

<?php }