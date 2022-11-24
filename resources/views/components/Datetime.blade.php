<header class="d-flex justify-content-center py-3" style="font-size: 15px;">
    {{-- <?php

    $j = date('j');
    $m = date('n');
    $arry = $this->jdf->gregorian_to_jalali(date('Y'), date('n'), date('j'));
    $ogt = $this->owghat->owghatn($arry[1], $arry[2], 51.59604, 32.867154, 0, 1, 1);

    ?> --}}
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 ThemeStyle text-light p-2 px-3">
        <li id="date-time"></li>
        <li class="d-none d-lg-block"> | <?php echo " اذان صبح : " //. $ogt['s']; ?></li>
        <li class="d-none d-lg-block"> | <?php echo " طلوع آفتاب : " //. $ogt['t']; ?></li>
        <li class="d-none d-lg-block"> | <?php echo " اذان ظهر : " //. $ogt['z']; ?></li>
        <li class="d-none d-lg-block"> | <?php echo " غروب آفتاب : " //. $ogt['g']; ?></li>
        <li class="d-none d-lg-block"> | <?php echo " اذان مغرب : " //. $ogt['m']; ?></li>
        <li class="d-none d-lg-block"> | <?php echo " نیمه شب : " //. $ogt['n']; ?></li>
    </ul>
</header>
