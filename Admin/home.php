<?php include("session-manage.php") ?>

<a href="create-user.php">Create User</a>
<a href="../logout.php">Logout</a>
<h1>UserList</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql_select = "SELECT users.id, users.username, users.email, roles.name as role FROM users INNER JOIN roles ON users.role_id=roles.id";
            $result = $conn->query($sql_select);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) {
                    
        ?>
                    <tr>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['username']?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['role']?></td>
                        <?php if(strcmp($row['role'], "admin") != 0){
                            ?>
                            <td>
                            <a href="edit-user.php?id=<?php echo $row['id']?>">Edit</a> |
                            <a href="delete-user.php?id=<?php echo $row['id']?>">Delete</a>
                            </td>
                        <?php
                            }
                        ?>
                    </tr>
        <?php
                }
            }
        ?>
        
    </tbody>

</table>