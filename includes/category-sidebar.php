<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
        <nav class="yamm megamenu-horizontal">
            <ul class="nav"><?php 
                 while($rowNavCat = $cate->fetch()){?>
                    <li class="dropdown menu-item"> 
                        <a href="category.php?category=<?php echo $rowNavCat['category_id'];?>" class="dropdown-toggle">
                            <i class="icon fa fa-shopping-bag" aria-hidden="true"></i><?php echo $rowNavCat['category_name'];?>
                        </a>
                    </li><?php
                } ?>
            </ul>
        </nav>
    </div>