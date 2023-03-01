<?php include'../view/header.php'; ?>

<section class="dashboard">
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li><a href="admin/add_post.php"><i class="uil uil-cloud-moon-hail"></i><h5>Add Post</h5></a></li>
                <li><a href="admin/manage_post.php"><i class="uil uil-cloud-exclamation"></i><h5>Manage Post</h5></a></li>
                <!-- only show the rest of the dashboard if user is an admin -->
                <li><a href="admin/add_user.php"><i class="uil uil-cloud-moon-hail"></i><h5>Add User</h5></a></li>
                <li><a href="admin/manage_users.php" class="active"><i class="uil uil-cloud-lock"></i><h5>Manage User</h5></a></li>
                <li><a href="admin/add_category.php"><i class="uil uil-cloud-bookmark"></i><h5>Add Category</h5></a></li>
                <li><a href="admin/manage_categories.php" class=""><i class="uil uil-cloud-times"></i><h5>Manage Categories</h5></a></li>
            </ul>
        </aside>


        <main>
            <h2>Manage Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Big Winner</td>
                        <td>acheiver</td>
                        <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.php" class="btn sm danger">Delete</a></td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Someone Special</td>
                        <td>minnie</td>
                        <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.php" class="btn sm danger">Delete</a></td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Night Sky</td>
                        <td>bacon</td>
                        <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.php" class="btn sm danger">Delete</a></td>
                        <td>No</td>
                    </tr>
                   
                </tbody>
            </table>
        </main>
    </div>
</section>
<!--======================================END OF TABLE================-->

<?php include'../view/footer.php'; ?>

