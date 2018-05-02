<script>
    jQuery(document).ready(function () {
        jQuery('#user-update').submit(function (e) {
            var data = jQuery(this).serializeArray();
            var id = jQuery(this).data('id');

            jQuery.ajax({
                url: 'http://simple.rest/api/users/' + id,
                method: 'PUT',
                data: {
                    name : data[0]['value'],
                    surname : data[1]['value'],
                    email : data[2]['value'],
                },
                success: function (data) {
                    console.log(data);
                },
            });

            console.log(data[0]['value']);

            e.preventDefault();
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

        <form id="user-update" data-id="<?= $user['id'] ?>" method="post">

            <tr>
                <td><?= $user['id'] ?></td>
                <td><input type="text" name="name" value="<?= $user['name'] ?>" /></td>
                <td><input type="text" name="surname" value="<?= $user['surname'] ?>" /></td>
                <td><input type="text" name="email" value="<?= $user['email'] ?>" /></td>
                <td><button>Update</button></td>
            </tr>

        </form>

    <?php endforeach; ?>
</table>