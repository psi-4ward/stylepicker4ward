<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
<base href="<?php echo $this->base; ?>"></base>
<title><?php echo $this->title; ?> :: Contao Open Source CMS <?php echo VERSION; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->charset; ?>" />
<link rel="stylesheet" type="text/css" href="system/themes/<?php echo $this->theme; ?>/basic.css?<?php echo VERSION .'.'. BUILD; ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="system/themes/<?php echo $this->theme; ?>/main.css?<?php echo VERSION .'.'. BUILD; ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="plugins/calendar/css/calendar.css?<?php echo CALENDAR; ?>" media="screen" />
<?php if ($this->be27): ?>
<link rel="stylesheet" type="text/css" href="system/themes/<?php echo $this->theme; ?>/be27.css?<?php echo VERSION .'.'. BUILD; ?>" media="screen" />
<?php endif; ?>
<?php if ($this->isMac): ?>
<link rel="stylesheet" type="text/css" href="system/themes/<?php echo $this->theme; ?>/macfixes.css?<?php echo VERSION .'.'. BUILD; ?>" media="screen" />
<?php endif; ?>
<!--[if lte IE 7]><link type="text/css" rel="stylesheet" href="system/themes/<?php echo $this->theme; ?>/iefixes.css?<?php echo VERSION .'.'. BUILD; ?>" media="screen" /><![endif]-->
<!--[if IE 8]><link type="text/css" rel="stylesheet" href="system/themes/<?php echo $this->theme; ?>/ie8fixes.css?<?php echo VERSION .'.'. BUILD; ?>" media="screen" /><![endif]-->
<?php echo $this->stylesheets; ?>
<style type="text/css" media="screen">
<!--/*--><![CDATA[/*><!--*/
#container {
  margin:0 auto;
  padding:12px 0;
  width:750px;
}
#tl_helpBox {
  margin-left:-353px;
}
/*]]>*/-->
</style>
<script type="text/javascript" src="plugins/mootools/mootools-core.js?<?php echo MOOTOOLS_CORE; ?>"></script>
<script type="text/javascript" src="plugins/mootools/mootools-more.js?<?php echo MOOTOOLS_MORE; ?>"></script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
var CONTAO_THEME = '<?php echo $this->theme; ?>';
var CONTAO_COLLAPSE = '<?php echo $this->collapseNode; ?>';
var CONTAO_EXPAND = '<?php echo $this->expandNode; ?>';
//--><!]]>
</script>
<script type="text/javascript" src="contao/contao.js?<?php echo VERSION .'.'. BUILD; ?>"></script>
<script type="text/javascript" src="system/themes/<?php echo $this->theme; ?>/hover.js?<?php echo VERSION .'.'. BUILD; ?>"></script>
<script src="system/modules/_stylepicker4ward/html/stylepicker4ward.js"></script>
</head>

<body class="__ua__">

<div id="container">
<div id="main">

<h1 class="main_headline"><?php echo $this->headline; ?></h1>
<?php if ($this->error): ?>

<p class="tl_gerror"><?php echo $this->error; ?></p>
<?php endif; ?>

<?php /*** Wizard START ***/ ?>
<div class="tl_formbody_edit" id="styleItems" style="padding:10px">
<?php if(count($this->items)):?>
<?php foreach($this->items as $item):?>
	<div class="item" onmouseout="Theme.hoverDiv(this, 0);" onmouseover="Theme.hoverDiv(this, 1);">
	<div style="padding:5px 10px" class="clr">
		<input type="checkbox" style="float:right;" value="<?php echo $item['cssclass'];?>"/>
		<?php if(strlen($item['image'])):?><img src="<?php echo $this->getImage($item['image'],80,80,'proportional');?>" alt="" style="float:left;"/><?php endif;?>
		<div style="margin-left:100px">
			<h2><?php echo $item['title'];?> <span style="font-weight:normal">(<?php echo $item['cssclass'];?>)</span></h2>
			<?php if(strlen($item['description'])):?><p class="description"><?php echo $item['description'];?></p><?php endif;?>
		</div>
	</div>
		<hr style="height:1px;margin:0px;"/>
	</div>
	
<?php endforeach;?>
<?php else:?>
	<p class="error"><?php echo $GLOBALS['TL_LANG']['MSC']['stylepicker4ward_noItems'];?></p>
<?php endif;?>
</div>
<script>
<!--//--><![CDATA[//><!--
window.addEvent('domready',function(){
	new Stylepicker4ward($('styleItems'),'<?php echo $this->field;?>');
});
//--><!]]>
</script>

<?php /*** Wizard END ***/ ?>

</div>

<div class="clear"></div>

</div>

<?php echo $this->mootools; ?>

</body>
</html>