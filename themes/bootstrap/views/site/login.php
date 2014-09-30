<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' Iniciar sesión';
$this->breadcrumbs=array('Iniciar sesión');
?>

<?php if(Yii::app()->user->hasFlash('success'))
	$this->widget('bootstrap.widgets.TbAlert', array('alerts'=>array('success'),));
?>

<?php //else: ?>

	<div class="form-actions">
		<b>
			<font size='5' color='#616161'>
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;
				Ingresá tus datos
			</font>
		</b>
		<font color='#BFBFBF'>
			&emsp;
			(Los campos con <span class="required">*</span> son requeridos)
		</font>
	</div>	



	<div class="form">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'login-form',
			'type'=>'horizontal',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

		<?php echo $form->errorSummary($model); ?>
		<?php echo $form->textFieldRow($model,'username'); ?>
		<?php echo $form->passwordFieldRow($model,'password'); ?>
		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Ingresar',
			)); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->

<?php //endif; ?>
