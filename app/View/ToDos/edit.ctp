<h3>Edition d'une liste</h3>

<?php echo $this->Form->create('ToDo'); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Form->input('ToDo.name', array('label' => 'Nom : ')); ?>
	<?php echo $this->Form->input('ToDo.frequency', array('options' => array('Journalier', 'Hebdomadaire', 'Mensuel'),'empty' => 'Aucune repetition'));?>   
    <?php echo $this->Form->input("ToDo.expirationDate", array('label' => "Date : ", 'type' => 'text', 'class' => 'fl tal vat w300p', 'error' => false , 'id' => 'select_date')); ?>
	<?php echo $this->Html->div('datepicker_img w100p fl pl460p pa', $this->Html->image('jquery/datepicker_calendar_icon.gif'),array('id' => 'datepicker_img')); ?>
    <?php echo $this->Html->div('datepicker fl pl460p pa', ' ' ,array('id' => 'datepicker')); ?>
<?php echo $this->Form->end('Editer une liste'); ?>

<?php echo $this->Html->div('datepicker fl pl460p pa', ' ' ,array('id' => 'datepicker')); ?>

<?php
	// Script du calendrier en JQuery
	echo $this->Html->css('jquery-ui');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-ui'); 
?>

<script type="text/javascript">
$(document).ready(function(){-
            $("#datepicker_img img").click(function(){
                $("#datepicker").datepicker({
					dateFormat: 'yy-mm-dd',
					onSelect: function(dateText, inst){
						$('#select_date').val(dateText);
						$("#datepicker").datepicker("destroy");
						}
                });
            });
        });
</script>