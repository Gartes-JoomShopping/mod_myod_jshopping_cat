<?php if (!empty($arResult)):?>
<style>
    .odcat a.parent {
        background-image: url(<?= JURI::root() ?>modules/mod_myod_jshopping_cat/assets/images/menu-arr-down.png);
        background-repeat: no-repeat;
        background-position: 99% 50%;
    }
    .odcat ul a.parent {
        background-image: url(<?= JURI::root() ?>modules/mod_myod_jshopping_cat/assets/images/menu-arr-down1.png);
        background-repeat: no-repeat;
        background-position: 98% 50%;
        opacity:0.8;
    }
</style>
<ul id="nav_list_first" class="odcat <?php if($class){ echo $class;}?>">
<?php 
$previousLevel = 0;
foreach($arResult as $arItem):?>
	<?php if ($previousLevel && $arItem["DEPTH"] < $previousLevel):?>
		<?php echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH"]));?>
	<?php endif?>
	<?php if ($arItem["IS_PARENT"]):?>
		<?php if ($arItem["DEPTH"] == 1):?>
			<li class="<?php if ($arItem["SELECTED"]):?> active<?php endif?>">
				<a href="<?php echo $arItem["LINK"]?>" class="root parent<?php if ($arItem["SELECTED"]):?> active<?php endif?>">
					<?if(($display_img == 1) and $arItem["IMG"]):?>
					<img src="<?php echo $jshopConfig->image_category_live_path."/".$arItem["IMG"]?>">
					<?endif?>
					<?php echo $arItem["NAME"]?><?php if($count){echo ' ('.$arItem["COUNT"].')';}?>
				</a>
				<ul class="odsubcat-<?php echo $arItem["DEPTH"]?>">
		<?php else:?>
			<li class="<?php if ($arItem["SELECTED"]):?> active<?php endif?>">
				<a href="<?php echo $arItem["LINK"]?>" class="parent<?php if ($arItem["SELECTED"]):?> active<?php endif?>">
					<?if(($display_img == 1) and $arItem["IMG"]):?>
					<img src="<?php echo $jshopConfig->image_category_live_path."/".$arItem["IMG"]?>">
					<?endif?>
					<?php echo $arItem["NAME"]?><?php if($count){echo ' ('.$arItem["COUNT"].')';}?>
				</a>
				<ul class="odsubcat-<?php echo $arItem["DEPTH"]?>">
		<?php endif?>
	<?php else:?>
			<?php if ($arItem["DEPTH"] == 1):?>
				<li class="<?php if ($arItem["SELECTED"]):?> active<?php endif?>">
					<a href="<?php echo $arItem["LINK"]?>" class="root<?php if ($arItem["SELECTED"]):?> active<?php endif?>">
						<?if(($display_img == 1) and $arItem["IMG"]):?>
						<img src="<?php echo $jshopConfig->image_category_live_path."/".$arItem["IMG"]?>">
						<?endif?>
						<?php echo $arItem["NAME"]?><?php if($count){echo ' ('.$arItem["COUNT"].')';}?>
					</a>
				</li>
			<?php else:?>
				<li class="<?php if ($arItem["SELECTED"]):?> active<?php endif?>">
					<a href="<?php echo $arItem["LINK"]?>" <?php if ($arItem["SELECTED"]):?>class="active"<?php endif?>>
						<?if(($display_img == 1) and $arItem["IMG"]):?>
						<img src="<?php echo $jshopConfig->image_category_live_path."/".$arItem["IMG"]?>">
						<?endif?>
						<?php echo $arItem["NAME"]?><?php if($count){echo ' ('.$arItem["COUNT"].')';}?>
					</a>
				</li>
			<?php endif?>
	<?php endif?>
	<?php $previousLevel = $arItem["DEPTH"];?>
<?php endforeach?>
<?php if ($previousLevel > 1)://close last item tags?>
	<?php echo str_repeat("</ul></li>", ($previousLevel-1) );?>
<?php endif?>
</ul>
<?php endif?>