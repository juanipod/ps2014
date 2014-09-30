<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' Mi perfil';
$this->breadcrumbs=array(
	'Mi perfil',
);
?>

<?php if(Yii::app()->user->hasFlash('success'))
	$this->widget('bootstrap.widgets.TbAlert', array('alerts'=>array('success'),));
?>
<div class="form-actions">
	<b>
		<font size='5' color='#616161'>
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;
			Mi perfil de usuario
		</font>
	</b>
</div>	

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'perfil-form',
		'type'=>'horizontal',
		'action' => Yii::app()->createUrl('site/perfil'),
		'enableClientValidation'=>true,
		'enableAjaxValidation' => true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	));
	?>
	
		<?php echo $form->textFieldRow($model,'name_surname', array('value'=>$model->name_surname, 'readonly'=>'false')); ?>
		<?php echo $form->textFieldRow($model,'address', array('value'=>$model->address, 'readonly'=>'false')); ?>
		<?php echo $form->textFieldRow($model,'email', array('value'=>$model->email, 'readonly'=>'false')); ?>
		<?php echo $form->textFieldRow($model,'fecha_alta', array('value'=>$model->fecha_alta, 'readonly'=>'false')); ?>
		<?php echo $form->textAreaRow($model,'description', array('value'=>$model->description, 'readonly'=>'false')); ?>

<?php $this->endWidget(); ?>
