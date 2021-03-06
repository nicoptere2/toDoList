<div id="tasks" ng-app="Tasks" ng-controller="tasksController" ng-init="list_id=<?php echo $list['id'] ?>" >
	<table style="width:100%">
            <tr>
                <td>
                	<h2><?php echo $list['name'] ?> - <span class="created"> <?php echo $this->Date->date($list['created']) ?></span></h2>
                </td>
				<td>
		
        <div class="dropdown dropdown-right" ng-controller="addTaskController" align="right">
    	<div class="dropdown">
    		<button ng-click="ajouterTache(<?php echo $idToDo; ?>)" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
    		<?php if($right == 1 ||$right == 4){echo "disabled";}
		?>

    		>
    			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    		</button>
    		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    			<div bind-unsafe-html="pageTest">

    			</div>

    		</ul>
    	</div>
    	</div>
    	</td>
    </table>
	<ul class="list-group" ng-model="tasks" ng-init="
			tasks=<?php echo htmlentities(json_encode($tasks)) ?>
			">
		<li class="list-group-item item"
			ng-repeat="(key, value) in tasks" 
			ng-class="
				{
					taskCompleted : value.Task.completed,
					taskHalf : value.Task.half,
					taskEmpty : value.Task.empty
				}"
			ng-model="value"
			ng-click=""
		>
			{{qteCompleted = value.Task.qteCompleted; ""}}
			{{qte = value.Task.quantity; ""}}

			<label class="checked">
				<input 
					type="checkbox"
					class="checkbox"
					ng-name="value.Task.id"
					ng-model="value.checkBoxValue"
					ng-checked="value.Task.completed"
					ng-click="boxClick(key)"
				>

				<span class="rounded"> <span class="glyphicon glyphicon-ok tick" ng-show="value.Task.completed"></span> </span>


				<div class="task-content">
					<div class="task">
						<div class="task-name">{{value.Task.name}}</div>
						<div class="task-user" ng-repeat="(user_key, checked) in value.Checked" >
							<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>{{checked.User.username}} : {{checked.quantity}} sur {{value.Task.quantity}}
						</div>
					</div>
					
					<form action="#" ng-submit="boxClick(key)">
						<input 
							type="number"
							name="quantity" 
							ng-model="value.quantity"
							ng-show="value.Task.quantitatif && !value.Task.completed"
							placeholder="quantité"
							ng-blur="boxClick(key)"
						>
					</form>

					<div class="quantity" ng-show="value.Task.half">
						<div>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="{{qteCompleted / qte * 100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{qteCompleted / qte * 100}}%;">
									{{qteCompleted / qte * 100}}%
								</div>
							</div>
						</div>
						<span>{{qteCompleted}} / {{qte}}</span>
					</div>
				</div>
                                <a 
                                <?php 
                                if($right == 2 || $right == 3 || $right == 5){ ?>
                                ng-href="{{base}}/Tasks/delete_task/<?php echo $idToDo ?>/{{value.Task.id}}"
                                onclick="return confirm('Voulez-Vous supprimer l\'élément ?\n Cette action est irreversible.')"
                                <?php } ?>
                                class="btn-delete"
                                >
					<span class="glyphicon glyphicon-minus"></span>
				</a>
            </label>
		</li>
	</ul>

    <div class="dropdown dropdown-right" ng-controller="showMembersController" align="right">
    	<div class="dropup">
    		<button ng-click="afficherMembres(<?php echo $idToDo; ?>)" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
    		</button>
    		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    			<div bind-unsafe-html="pageTest">

    			</div>

    		</ul>
    	</div>
    </div>

<script type="text/javascript">
	$('.dropdown-menu ul').on('click',function(){
		console.log("message a la con");
		return false;
	});
</script>

<?php echo $this->Html->script('dateHelper') ?>
<?php echo $this->Html->script('tasksCtrler') ?>
<script type="text/javascript">
	var userId = <?php  echo AuthComponent::user('id'); ?>;
</script> 

        <a ng-href="{{base}}/ToDos/quit_todos/<?php echo $idToDo ?>" class="bouton btn-add" onclick="return confirm('Voulez-Vous quitter cette liste ?\n Cette action est irreversible.')">
                <span class="glyphicon glyphicon-minus">quitter</span>
        </a>
        <?php
        echo $this->Html->link('afficher les utilisateurs', array('controller' => 'Members',
                                                  'action' => 'show_members',$idToDo
                                                  ));
        ?>
</div>