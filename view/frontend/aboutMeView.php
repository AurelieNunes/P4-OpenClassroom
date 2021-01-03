<php $title = "Qui suis-je ?";?>

<?php ob_start();?>

<section class="mt-5 mb-5" id="About">
    <div class="pb-4" id="AboutMe">
        <h3>À propos de moi</h3>
            <p>Passionné par les voyages et le développement personnel, j'ai décidé d'allier mes passions avec l'écriture. L'écriture est pour moi comme une méditation, on se retrouve face à soi-même à laisser aller ses pensées... Après ma rencontre avec Eckart Tolle, j'ai eu un déclic encore plus intense ! Qui suis-je réellement ? Quel est le but de ma vie ? Ces questions n'avaient points de réponses jusqu'à ce que je regarde INTO The WILD ! A ce moment précis, je me suis dis pourquoi vivre ici ? pourquoi rester dans un confort qui ne me rends pas plus heureux que ça ? J'ai donc décidé de faire mes valises, vendre mes biens, mes affaires, en deux semaines je n'avais plus rien ! J'étais LIBRE ! Enfin RÉELLEMENT LIBRE ! Sans plus aucuns bien matériels mais heureux ! Je me suis donc rendu à l'aéroport, pris un billet aller pour l'Alaska avec mon sac à dos à la recherche du fameux Bus 142 ! Je publierais donc sur ce blog mes récits jour après jour. En espérant que cela vous plaira ! Bonne lecture :)</p>
    </div>

    <div class="pb-4" id="MyBooks">
        <h3>Mes Autres Livres</h3>
        <ul>
            <li>Vivre le moment présent</li>
            <li>L'homme qui voulait être heureux</li>
            <li>Les 5 blessures</li>
        </ul>
    </div>

    <div class="pb-4" id="WhyThisMethod">
        <h3>Pourquoi publier sur un blog et non dans un livre ?</h3>
            <p>Pour rendre accessible aux plus grands nombres la lecture; A travers mon voyage, mes péripéties, je souhaite faire vivre les autres à travers mes récits; le but étant de vous ammener vous aussi à plus de paix intérieure.</p>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>