<?php 
    // tableau associatif
    $info = array(
        'prenom'            => 'Alexandre',
        'nom'               => 'Luquet',
        'adresse'           => 'allée de la butte aux cailles',
        'cp'                => 93160,
        'ville'             => 'Noisy',
        'email'             => 'qué@gmail.com',
        'tel'               => 0606060606,
        'date_naissance'    => new DateTime('1992-06-26') //
    );
    require('inc/header.php');
?>

    <div class="container">
        <ul class="list-group col-sm-6">
            <li class="list-group-item active">Infos</li>
            <!-- je parcours mon tableau -->
            <?php foreach($info AS $key => $value): ?>
                <!-- verif -->
                <?php if($key == 'date_naissance'):?>
                    <li class="list-group-item"><?= $key. ' : ' .$value->format('d/m/Y')// format fr  ?></li>
                <?php else: ?>
                    <!-- j'affiche les info de mon tableau dans des li-->
                    <li class="list-group-item"><?= $key. ' : ' .$value ?></li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
    </div>

<?php 
    require('inc/footer.php');