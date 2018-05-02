<script>
    jQuery(document).ready(function () {
        jQuery('.delete').click(function () {
            var id = jQuery(this).data('id');

            jQuery.ajax({
                method: 'DELETE',
                url: 'http://simple.rest/api/users/' + id,
                success: function (data) {
                    alert(data);
                }
            });
        });
    });
</script>

<table border="1" align="center">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th> </th>
    </tr>
    </thead>
    <?php foreach ($data as $user): ?>

        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['surname'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <div style="cursor: pointer;" class="delete" data-id="<?= $user['id'] ?>">
                    <b>X</b>
                </div>
            </td>
        </tr>

    <?php endforeach; ?>
</table>