<?php

use App\Models\User;

isset($_GET['userid']) ? $userID = $_GET['userid']: exit();

$user = new User();
$users = [];

$userResult = $user->find($userID);

if (!$userResult) {
    echo 'No Account Found';
}
else{
    foreach ($userResult as $user) {
        $users[] = new User($user['id']);
    }
}

if (count($users) > 0) {
?>
    <table id="tablename-table">
        <thead>
            <th>No.</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>
                </tr>
        </thead>

        <tbody>
            <?php
            $no = 0;
                foreach ($users as $user) { $no++;?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><a href=<?php echo "?view=".$user->getId(); ?> ><?php echo $user->getId(); ?></a></td>
                        <td><?php echo $user->getName(); ?></td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td>
                            <p class="role"><?php echo ucfirst($user->getRole()); ?></p>
                        </td>
                        <td><button class="more-btn" type="button">⋮</button></td>
                    </tr>
                <?php
                }
            ?>

            <script>
                roleColor();
            </script>
        </tbody>


    </table>
</div>

<?php }; ?>