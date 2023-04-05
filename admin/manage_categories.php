<?php include'../view/header.php'; ?>

<section class="dashboard">
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li><a href="admin/?controllerRequest=show_add_post"><i class="uil uil-cloud-moon-hail"></i><h5>Add Post</h5></a></li>
                <li><a href="admin/?controllerRequest=show_user_posts"><i class="uil uil-cloud-exclamation"></i><h5>Manage Post</h5></a></li>
                <!-- only show the rest of the dashboard if user is an admin -->
                <li><a href="admin/add_user.php"><i class="uil uil-cloud-moon-hail"></i><h5>Add User</h5></a></li>
                <li><a href="admin/?controllerRequest=admin_display_users"><i class="uil uil-cloud-lock"></i><h5>Manage User</h5></a></li>
                <li><a href="admin/add_category.php"><i class="uil uil-cloud-bookmark"></i><h5>Add Category</h5></a></li>
                <li><a href="admin/?controllerRequest=admin_display_categories" class="active"><i class="uil uil-cloud-times"></i><h5>Manage Categories</h5></a></li>
            </ul>
        </aside>
        <main>

            <h2>Manage Categories</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category) : ?>
                    <tr>
                        <td><?php echo $category->getID(); ?></td>
                        <td><?php echo $category->getTitle(); ?></td>
                        <td>
                         <form action="admin/index.php" method="post">
                             <input type="hidden" name="controllerRequest" value="admin_edit_category_form">
                             <input type="hidden" name="ID" value="<?php echo $category->getID(); ?>">
                            <button type="submit" name="submit" class="btn sm">Edit</button>
                        </form>
                        </td>
                    </tr>
                    <?php endforeach;?> 
                </tbody>
            </table>

        </main>
    </div>
</section>


<?php include'../view/footer.php'; ?>

