<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>My sweet MVC</title>
        <link rel="stylesheet" href="/static/style.css">
    </head>
    <body>
        <?php View::show('common/header'); ?>
        <?php echo $A_view['body'] ?>
        <?php View::show('common/footer'); ?>
    </body>
</html>
