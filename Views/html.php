<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Tentation sucrée répertorie de nombreuses recettes de pâtisseries partagées, notées et commentées par ses membres.">
        <meta name="keywords" content="tentation, sucrée, végan, budget, sans lactose, cuisson, préparation, recettes, pâtisseries, pâtisser">
        <title>Tentation sucrée</title>
        <link rel="icon" href="/static/img/favicon/favicon_32.png" type="image/png" sizes="32x32">
        <link rel="icon" href="/static/img/favicon/favicon_64.png" type="image/png" sizes="64x64">
        <link rel="icon" href="/static/img/favicon/favicon_128.png" type="image/png" sizes="128x128">
        <link rel="icon" href="/static/img/favicon/favicon_256.png" type="image/png" sizes="256x256">
        <link rel="icon" href="/static/img/favicon/favicon_512.png" type="image/png" sizes="512x512">
        <link rel="stylesheet" href="/static/style.css">
    </head>
    <body>
        <?php View::show('common/header'); ?>
        <?php echo $A_view['body'] ?>
        <?php View::show('common/footer'); ?>
    </body>
</html>
