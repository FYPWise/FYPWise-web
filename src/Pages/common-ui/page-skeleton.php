<?php
use App\Models\Base;

$base = new Base("Page Skeleton");
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu() ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle() ?></h1>
                    <!-- Content Goes Here -->
                    adiasdajidasidnasd
                    daiosdjaiosdjaosid
                    aiodjasiodjasoidjasiodjaiodjaiodjaiodas
                    dioasdjasiodjoasidjioasdjioadjioadjioadas\daiosdjaiosdjaosidad\aiodjasiodjasoidjasiodjaiodjaiodjaiodas\adiasdajidasidnasd
                    daiosdjaiosdjaosid
                    aiodjasiodjasoidjasiodjaiodjaiodjaiodas
                    dioasdjasiodjoasidjioasdjioadjioadjioadas\daiosdjaiosdjaosidad\aiodjasiodjasoidjasiodjaiodjaiodjaiodas\adiasdajidasidnasd
                    daiosdjaiosdjaosid
                    aiodjasiodjasoidjasiodjaiodjaiodjaiodas
                    dioasdjasiodjoasidjioasdjioadjioadjioadas\daios
                    djaiosdjaosidad\aiodjasiodjasoidjasiodjaiodjaiodjaiodas\adiasdajidasidnasd
                    daiosdjaiosdjaosid
                    aiodjasiodjasoidjasiodjaiodjaiodjaiodas
                    dioasdjasiodjoasidjioasdjioadjioadjioadas\daiosdjaiosdjaosidad\aiodjasiodjasoidjasiodjaiodjaiodjaiodas\adiasdajidasidnasd
                    daiosdjaiosdjaosid
                    aiodjasiodjasoidjasiodjaiodjaiodjaiodas
                    dioasdjasiodjoasidjioasdjioadjioadjioadas\daiosdjaiosdjaosidad\aiodjasiodjasoidjasiodjaiodjaiodjaiodas\adiasdajidasidnasd
                    daiosdjaiosdjaosid
                    aiodjasiodjasoidjasiodjaiodjaiodjaiodas
                    dioasdjasiodjoasidjioasdjioadjioadjioadas\daiosdjaiosdjaosidad\aiodjasiodjasoidjasiodj
                </section>
            </div>


        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>