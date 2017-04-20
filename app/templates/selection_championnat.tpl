{include file="header_ajout_match.tpl" title="Sélection d'un de championnat"}

<!-- {$saisons[0]} -->

<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8 deconnected">

	  	<div class="panel panel-default">
		 	<div class="panel-heading">
		   		 <h3 class="panel-title">Selection d'un championnat</h3>
		  	</div>
		  
		 	<div class="panel-body">
		 			<form  action="index.php?page=ajout_match_championnat" method="post" class="form-horizontal" role="form">
					  <div class="form-group">
					  	<label for="saison" class="col-sm-2 control-label"> Saison </label>
					  		<div class="col-sm-10">
								  <select class="form-control" name="saison" id="saison">
								   {foreach from=$saisons item=saison}
									 <option value="{$saison.id}">{$saison.libelle}</option>
									 {/foreach}
								  </select>
							</div>
					  </div>

					   <div class="form-group">
					  	<label for="pays" class="col-sm-2 control-label"> Pays </label>
					  		<div class="col-sm-10">
								  <select class="form-control" name="pays" id="pays">
									  {foreach from=$pays item=un_pays}
									 <option value="{$un_pays.id}">{$un_pays.libelle}</option>
									 {/foreach}
								  </select>
							</div>
					 	</div>					  

					  <div class="form-group">
					  	<label for="division" class="col-sm-2 control-label"> Division</label>
					  		<div class="col-sm-10">
								  <select class="form-control" name="division" id="division">
									 {foreach from=$divisions item=division}
									 <option value="{$division.id}">{$division.libelle}</option>
									 {/foreach}
								  </select>
							</div>
					  </div>
						
						<div class="form-group">
						    <!-- <div class="col-sm-offset-1 col-sm-10"> -->

						    <div class="">
						      <input class="btn btn-primary sign_up" type="submit" value="Selectionner" name="selection"/>
						     </div>
		 			   </div>
			    	</form>
					<hr/>
					
					<a href="index.php" type="submit" class="btn btn-default">Go back to the Main page </a>

		 	</div><!-- Form-Panel-Body -->
		</div><!-- panel panel-default -->
	  </div> <!-- col-md-8 -->
	  <div class="col-md-2"></div>
</div>
{include file="footer.tpl" title=foo}