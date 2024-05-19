<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->


<div class="aPropos">
    <p>
KHAALISS est bien plus qu'une simple application de gestion de comptes bancaires. C'est un projet ambitieux né de la volonté de réinventer la manière dont les gens interagissent avec leur argent au quotidien.
</p>
<p>
Notre équipe passionnée travaille sans relâche pour offrir à nos utilisateurs une expérience bancaire moderne, adaptée aux besoins et aux exigences de notre époque. Nous croyons en l'innovation, en la simplicité et en la sécurité, et ces valeurs fondamentales se reflètent dans chaque aspect de notre application.
</p>
<p>
Chez KHAALISS, nous sommes convaincus que la technologie peut rendre la gestion financière plus accessible, plus transparente et plus efficace pour tous. C'est pourquoi nous mettons tout en œuvre pour développer des fonctionnalités avancées et des solutions intuitives qui facilitent la vie de nos utilisateurs.
</p>
<p>
Nous sommes fiers de vous offrir une application robuste, sécurisée et conviviale qui répond à vos besoins les plus divers en matière de finances personnelles et professionnelles. Nous vous remercions de votre confiance et nous nous engageons à continuer à améliorer KHAALISS pour vous offrir la meilleure expérience possible.
</p>
<p>
Merci de faire partie de notre communauté KHAALISS !
</p>
</div>

<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template2.php";
 ?>
