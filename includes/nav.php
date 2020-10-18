<nav class="nav-main-menu">
    <ul class="ul-main-menu">
        <?php
            $categories = getCategories();
            if(count($categories) == 0):
        ?>
                <li><a href="./index.php">Inicio</a></li>
            <?php else:?>
                <li><a href="./index.php">Inicio</a></li><!--
            <?php
                foreach ($categories as $key=>$category):
                    if($key + 1 < count($categories)):
            ?>
                        --><li><a href="./index.php?category=<?=$category['id']?>"><?=$category['name']?></a></li><!--
                    <?php else:?>
                        --><li><a href="./index.php?category=<?=$category['id']?>"><?=$category['name']?></a></li>
                    <?php endif?>
                <?php endforeach;?>
            <?php endif?>
    </ul>
</nav>