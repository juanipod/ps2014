<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' Contacto';
$this->breadcrumbs=array(
	'Contacto',);
?>


<?php if(Yii::app()->user->hasFlash('notice')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('notice'),
    )); ?>

<?php else: ?>

	<div class="form-actions">
		<b>
			<font size='5' color='#616161'>
				&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;
				Contactenos
			</font>
		</b>
		<font color='#BFBFBF'>
			&emsp;
			(Los campos con <span class="required">*</span> son requeridos)
		</font>
	</div>	

	<center>
		<p class='text-info'>Si tenes alguna consulta y/o sugerencia, por favor, completa el siguiente formulario. Muchas Gracias.</p>
	</center>
	<br>


	<div class="form">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'contact-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>


		<?php echo $form->errorSummary($model); ?>
		<?php echo $form->textFieldRow($model,'name'); ?>
		<?php echo $form->textFieldRow($model,'email'); ?>
		<?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'class'=>'span8')); ?>
		<?php if(CCaptcha::checkRequirements()): ?>
			<?php echo $form->captchaRow($model,'verifyCode'); ?>
		<?php endif; ?>

		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton',array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Enviar',
			)); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->

<?php endif; ?>
