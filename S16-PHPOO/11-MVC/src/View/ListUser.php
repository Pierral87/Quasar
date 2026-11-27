
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $user) : ?>
                    <tr>
                        <td><?php echo $user['id_user']; ?></td>
                        <td><?php echo $user['nom']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <a href="<?= URL ?>user/select/<?php echo $user['id_user']; ?>" class="btn btn-info btn-sm">Voir</a>
                            <a href="<?= URL ?>user/update/<?php echo $user['id_user']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="<?= URL ?>user/delete/<?php echo $user['id_user']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php var_dump($_GET); ?>
            </tbody>
        </table>