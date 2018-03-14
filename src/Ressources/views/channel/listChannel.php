

<span style="margin-right: 1em;">Name</span>
<span style="margin-right: 4em;">Description</span>
<span style="float: right;">Capacity</span>
<div class="list-group">
<?php foreach ($mychannels as $key => $value ):?>

<a style="margin-left: 440px;" class="btn btn-primary"
		href="?channel=<?=$value->getChannelId()?>&action=delete"role="button">x
<!-- lien get dans url avec l'id correspondant au channel et action souhaité-->

<!-- lien get dans url avec l'id correspondant au channel-->
	</a> <a href="channel?id=<?=$value->getChannelId()?>"
		class="list-group-item list-group-item-action list-group-item-info"> <span
		style="font-size: 1.2em; margin-right: 4em">
<?=$value->getChannelName()?>
</span> <em>
<?=$value->getChannelDescr()?>
</em> <b style="margin-left: 50px;"
		class="badge badge-primary badge-pill">
<?=$value->getChannelCapacity()?>
</b>
	</a>
<?php endforeach; ?>            
</div>

