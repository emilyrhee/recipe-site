<?php
include "../components/connect.php";
session_name();

$errorMessage = " ";
$users_gathered = [];

if (isset($conn)) {
        $db = "recipemanagementsystem";

    try {
        $sql = ("SELECT id, username, role FROM Users");
        $statement = $conn->prepare($sql);
        $statement->execute();
        $users_gathered = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
            $errorMessage = "Something went wrong" . $e->getMessage();
        }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <div>
        <h2>Users Management</h2>
    </div>
    <?php if(!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>User-Id</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users_gathered as $users): ?>
                <tr>
                    <td><?php echo htmlspecialchars($users['id']); ?></td>
                    <td><?php echo htmlspecialchars($users['username']); ?></td>
                    <td><?php echo htmlspecialchars($users['role']); ?></td>

                    <td>
                        <form method="post" action="../handlers/admin_change_role.php" style="display: inline;">
                        <input type="hidden" name="userId" value="<?php echo htmlspecialchars($users['id'])?>" >
                        <select name="role">
                            <option value= "client" <?php if($users['role'] === 'client')echo "selected";?>>client</option>
                            <option value = "chef"<?php if($users['role'] === 'chef')echo "selected";?>>chef</option>
                            <option value = "admin "<?php if($users['role'] === 'admin')echo "selected";?>>admin</option>
                        </select>
                        <button type="submit" name="update_role">UPDATE ROLE</button>
                        </form>
                        <a>Delete User</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>