<?php include '../view/header.php';
      
?>
<section class="dashboard">
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
         <ul>
                <li><a href="admin/?controllerRequest=show_add_post"><i class="uil uil-cloud-moon-hail"></i><h5>Add Post</h5></a></li>
                <li><a href="admin/?controllerRequest=show_user_posts"class="active"><i class="uil uil-cloud-exclamation"></i><h5>Manage Post</h5></a></li> 

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) { ?>
                    <li><a href="admin/?controllerRequest=add_user"><i class="uil uil-cloud-moon-hail"></i><h5>Add User</h5></a></li>
                    <li><a href="admin/?controllerRequest=admin_display_users"><i class="uil uil-cloud-lock"></i><h5>Manage User</h5></a></li>
                    <li><a href="admin/?controllerRequest=add_category"><i class="uil uil-cloud-bookmark"></i><h5>Add Category</h5></a></li>
                    <li><a href="admin/?controllerRequest=admin_display_categories" class=""><i class="uil uil-cloud-times"></i><h5>Manage Categories</h5></a></li> 
                <?php } ?>
        </ul>

        </aside>
        <main>

            <h2>Manage Posts</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Created On</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?php echo $post->getTitle(); ?></td>
                            <td><?php echo $post->getDate_Time(); ?></td>
                      <td>   
                         <form action="admin/index.php" method="post">
                             <input type="hidden" name="controllerRequest" value="show_edit_post_form">
                             <input type="hidden" name="ID" value="<?php echo $post->getID(); ?>">
                            <!--need to put hidden var for category id--> 
                            <button type="submit" name="submit" class="btn sm">Edit</button>
                        </form>
                      </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </main>
    </div>
</section>
<?php include '../view/footer.php'; ?>

