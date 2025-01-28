<?php

use App\Models\User;

$userID = $_GET['userid'];

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
            <th><input title="select all" type="checkbox" id="select-all"></th>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>
                </tr>
        </thead>

        <tbody>
            <?php
                foreach ($users as $user) { ?>
                    <tr>
                        <td><input title="<?php echo $user->getId(); ?>" type="checkbox" class="row-checkbox" value="<?php echo $user->getId(); ?>"></td>
                        <td><a href=<?php echo "?userid=".$user->getId(); ?> ><?php echo $user->getId(); ?></a></td>
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