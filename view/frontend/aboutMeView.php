<php $title = "Qui suis-je ?";?>

<?php ob_start();?>

<section id="About">
    <div id="AboutMe">
        <h3>À propos de moi</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus eos nemo hic accusantium, iure officiis voluptas optio voluptatem aperiam beatae culpa totam consequatur eum minus, cupiditate temporibus possimus nobis deserunt!</p>
    </div>

    <div id="MyBooks">
        <ul>
            <li>lorem1</li>
            <li>lorem2</li>
            <li>lorem3</li>
            <li>lorem4</li>
        </ul>
    </div>

    <div id="WhyThisMethod">
        <h3>Pourquoi publier sur un blog et non dans un livre</h3>
            <p>Tout simplement pour rendre accessible aux plus grands nombres de passionnés la lecture</p>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>