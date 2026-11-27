                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>ID : </strong> <?php echo $data['id_user']; ?></li>
                    <li class="list-group-item"><strong>Nom : </strong> <?php echo $data['nom']; ?></li>
                    <li class="list-group-item"><strong>Email : </strong> <?php echo $data['email']; ?></li>
                </ul>
                <a href="<?= URL ?>user/update/<?php echo $data['id_user']; ?>" class="btn btn-warning">Modifier</a>
                <a href="<?= URL ?>user/delete/<?php echo $data['id_user']; ?>" class="btn btn-danger">Supprimer</a>