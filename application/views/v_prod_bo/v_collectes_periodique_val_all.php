<?php show_breadcrumbs($breadcrumbs);   ?>

<!-- 
<body>
    <form action="" method="POST">
        <input type="checbox" name="case[]" value="cc">
        <input type="submit">
    </form>

</body> -->

<a href="<?php echo site_url('saisie-valider-all-donnees/' . $code_elt)   ?>">
    <div>
        <button type="submit" class="btn btn-success">Valider tout</button>
    </div>

</a>