<h3>Création d'une liste</h3><br>

<?php echo $this->Form->create('ToDo'); ?>
    <?php echo $this->Form->input('name', array('label' => 'Nom : ', 'placeholder' => 'Nom de la liste')); ?><br>
	<?php echo $this->Form->create(false); ?>
	
	<table height=10><tr><td valign="top">
	<?php echo $this->Form->input("expirationDate", array('label' => "Date : ", 'type' => 'text', 'class' => 'fl tal vat w300p', 'error' => false , 'id' => 'select_date', 'placeholder' => 'Date d\'expiration')); ?>
	</td><td valign="top" style="padding-left:10px">
	<?php echo $this->Html->div('datepicker_img w100p fl pl460p pa', $this->Html->image('jquery/datepicker_calendar_icon.gif'),array('id' => 'datepicker_img')); ?>
	<?php echo $this->Html->div('datepicker fl pl460p pa', ' ' ,array('id' => 'datepicker')); ?>
	</td></tr></table><br>
	
	<?php echo $this->Form->input('frequency', array('label' => 'Fréquence : ','style'=>'width:132px; height:26px;','options' => array('Journalier', 'Hebdomadaire', 'Mensuel'),'empty' => 'Sans repetition'));?><br>    
<?php echo $this->Form->end('Valider'); ?>

<?php echo $this->Html->div('datepicker fl pl460p pa', ' ' ,array('id' => 'datepicker')); ?>

<?php
	// Script du calendrier en JQuery
	echo $this->Html->css('jquery-ui');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-ui'); 
?>

<script type="text/javascript">
$(document).mouseup(function (e) {
    var container = $("#datepicker");

    if (!container.is(e.target)&& container.has(e.target).length === 0) {
		$("#datepicker").datepicker("destroy");
    }
});
$(document).ready(function(){
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