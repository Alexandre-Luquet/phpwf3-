<?php 

    function moneyConvert ($montant, $devise = 'USD')
    {
        if( is_numeric($montant) ) // valeur uniquement numérique
        {
        return $montant . '€ = ' . ($montant * 1.085965) . ' $'; // traite $ par defaut

        if($devise == 'EUR'){ // traitement €
            
                return $montant . '$ = ' . ($montant * 0.085965 + $montant) . ' €';
        }
        }

    }
    require('inc/header.php');
?>
    <div class="container">
        <div class="alert alert-info text-center">
            <?= moneyConvert(10)?>
            <hr>
            <?= moneyConvert(25, 'USD')?>
            <hr>
            <?= moneyConvert(8, 'EUR')?>
        </div>
    </div>

<?php 
    require('inc/footer.php');