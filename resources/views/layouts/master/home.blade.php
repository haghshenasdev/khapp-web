
@include("header")
@include("menus/homemenu")
@include("footer")


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="<?= base_url('js/my-js.js'); ?>"></script>

<?php

$madadjoo = (int) $setting[0]->data;
$khanevar = (int) $setting[1]->data;
$project_omrani = (int) $setting[2]->data;

?>
<script type="text/javascript">
    var madadjoo = "<?= "$madadjoo" ?>";
    var khanevar = "<?= "$khanevar" ?>";
    var project_omrani = "<?= "$project_omrani" ?>";

    window.onload = vmsNumber(madadjoo, "madadjoo");
    window.onload = vmsNumber(khanevar, "khanevar");
    window.onload = vmsNumber(project_omrani, "project-omrani");
</script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</main>
</body>

</html>
