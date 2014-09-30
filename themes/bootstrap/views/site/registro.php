<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' Registrate';
$this->breadcrumbs=array('Registrate',);

?>

<?php if(Yii::app()->user->hasFlash('info')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('info'),
    )); ?>

<?php else: ?>

	<div class="form-actions">
		<b>
			<font size='5' color='#616161'>
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;
				Formulario de registro
			</font>
		</b>
		<font color='#BFBFBF'>
			&emsp;
			(Los campos con <span class="required">*</span> son requeridos)
		</font>
	</div>	


	<div class="form">
		
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'registro-form',
		'type'=>'horizontal',
		'action' => Yii::app()->createUrl('site/registro'),
		'enableClientValidation'=>true,
		'enableAjaxValidation' => true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	));
	?>
		<?php echo $form->errorSummary($model); ?>
		
		<?php echo $form->textFieldRow($model,'username', array('placeholder'=>'12345678')); ?>
		<?php echo $form->textFieldRow($model,'name_surname', array('placeholder'=>'Nombre Apellido')); ?>
		<?php echo $form->textFieldRow($model,'address', array('placeholder'=>'Calle Número Localidad')); ?>
		<?php echo $form->textFieldRow($model,'email', array('placeholder'=>'Correo electrónico')); ?>
		<?php echo $form->textFieldRow($model,'repeat_email', array('placeholder'=>'Repite el correo electrónico')); ?>
		<?php echo $form->passwordFieldRow($model,'password', array('placeholder'=>'Contraseña')); ?>
		<?php echo $form->passwordFieldRow($model,'repeat_password', array('placeholder'=>'Repite la contraseña')); ?>
		<?php echo $form->textAreaRow($model,'description', array('rows'=>5), array('placeholder'=>'')); ?>
		<?php echo $form->checkBoxRow($model,'newsletter'); ?>
		<?php echo $form->checkBoxRow($model,'conditions'); ?>
		
		<?php if(CCaptcha::checkRequirements()): ?>
			<?php echo $form->captchaRow($model,'captcha_code', array('placeholder'=>'Ingresa el código captcha')); ?>
		<?php endif; ?>	
		
		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton',array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Registrarme',
			)); ?>
		</div>	
		
		<?php $this->endWidget(); ?>
	</div><!-- form -->
<?php endif; ?>
