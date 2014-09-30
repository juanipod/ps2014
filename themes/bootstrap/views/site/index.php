<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name),
)); ?>
<p class='text-info'>Ingeniería Informática - Universidad Nacional Arturo Jauretche - (2014)</p>

<?php $this->endWidget(); ?>


<blockquote>
	Para más detalles sobre cómo desarrollar aún más esta aplicación, por favor,
	lea la <a href="http://www.yiiframework.com/doc/">documentación</a>.<br>
	No dude en consultar en el <a href="http://www.yiiframework.com/forum/">foro</a>,
	en caso de tener alguna pregunta.
</blockquote>
