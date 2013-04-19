</div>

<noscript><h1>Ïåéçàæè, ïîðòðåòû, èñêóññòâî. Îôèöèàëüíàÿ ñòðàíèöà Äàâèäà Ëåâàøåíêî. Ìîëüáåðò ðàáîòàåò íà JavaScript</h1></noscript>	

<script src=footer.js></script>
	
<?php

	if(isset($one['fon']) && noempty($one['fon']))
		$fn = $one['fon'];
	else
		$fn = trim($FONS[BLOG]);

	if(!$fn)
		$fn = trim($bmc_vars['def_fon']);
	$fn=trim(tojs($fn));
	
	if($fn)
		echo"<script>
			p1.src = '$fn';
			setTimeout('if(!p1.complete)my_onload()', 6000);
		</script>";
	elseif(BLOG != 1)
		echo"<script type=\"text/javascript\">
			con.style.background = 'url(images/back7.gif) repeat';
			my_onload();
		</script>";

?>

</body>
</html>