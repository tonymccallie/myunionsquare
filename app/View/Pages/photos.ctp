<?php
	$arNames = array(
		"Hotter N' Hell 100 - 2014",
		"2014 Employee Photo Shoot - Outakes and Fun Stuff!",
		"2013 Halloween",
		"2013 Race For The Cure",
		"2013 HHH",
		"2013 Battle Of The Vaults!",
		"New Kemp Branch Construction!",
		"2013 April WF Chapter of Credit Unions Social",
		"Shop at Teea's CU Shirt Store",
		"Trainer's Corner"
	)
?>
<h3>Photos</h3>
<div class="row-fluid">
	<?php
		foreach($arNames as $k=>$folder):
			if((($k % 3)==0)&&($k!=0)) {
				echo '</div><div class="row-fluid">';
			}
	?>
	<div class="span4 text-center">
		<?php echo $this->Html->link($this->Html->image('photo-image.png').'<br>'.$folder.'<br><i>10 Documents</i>','/pages/resource',array('escape'=>false)) ?>
	</div>
	<?php endforeach ?>
</div>