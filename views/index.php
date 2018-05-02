<table border="1" align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
        </tr>
    </thead>
    <?php foreach ($data as $user): ?>

        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['surname'] ?></td>
            <td><?= $user['email'] ?></td>
        </tr>

    <?php endforeach; ?>
</table>