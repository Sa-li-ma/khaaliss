<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->


<div class="texteAccueil">
    <p class="bienvenue">
    Bienvenue dans KHAALISS, votre compagnon de confiance pour une gestion intelligente et sécurisée de vos comptes bancaires !
    </p>
    <p>
    KHAALISS est une application innovante conçue pour simplifier votre vie financière. Que vous souhaitiez créer un nouveau compte, effectuer des opérations de dépôt, de retrait ou de virement, ou simplement suivre vos transactions, KHAALISS vous offre une expérience fluide et intuitive.
    </p>
    <p class="additional" style="display: none;">
    Grâce à une interface conviviale et des fonctionnalités puissantes, KHAALISS vous permet de gérer tous vos comptes bancaires en un seul endroit. Plus besoin de jongler entre différentes applications ou de vous rendre physiquement à la banque. Avec KHAALISS, vous avez le contrôle total de vos finances à portée de main, où que vous soyez.
    </p>
    <p class="additional" style="display: none;">
    La sécurité est notre priorité absolue chez KHAALISS. Toutes vos données personnelles et financières sont cryptées et protégées par les dernières technologies de sécurité. Vous pouvez donc utiliser notre application en toute tranquillité d'esprit, en sachant que vos informations sont en sécurité.
    </p>
    <p class="additional" style="display: none;">
    Que vous soyez un particulier ou un professionnel, KHAALISS est là pour vous accompagner dans la réalisation de vos objectifs financiers. Rejoignez-nous dès aujourd'hui et découvrez une nouvelle façon de gérer vos comptes bancaires, plus simple, plus rapide et plus sécurisée que jamais.
    </p>
    <button class="voir-plus">Voir plus</button>
    <button class="voir-moins" style="display: none;">Voir moins</button>
</div>
<h3><a href="ajouterAdmin.php">Ajouter un admin</a></h3>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const voirPlusBtn = document.querySelector('.voir-plus');
    const voirMoinsBtn = document.querySelector('.voir-moins');
    const additionalParagraphs = document.querySelectorAll('.additional');

    voirPlusBtn.addEventListener('click', function() {
        additionalParagraphs.forEach(function(paragraph) {
            paragraph.style.display = 'block';
        });
        voirPlusBtn.style.display = 'none';
        voirMoinsBtn.style.display = 'block';
    });

    voirMoinsBtn.addEventListener('click', function() {
        additionalParagraphs.forEach(function(paragraph) {
            paragraph.style.display = 'none';
        });
        voirPlusBtn.style.display = 'block';
        voirMoinsBtn.style.display = 'none';
    });
});
</script>

<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template2.php";
 ?>
