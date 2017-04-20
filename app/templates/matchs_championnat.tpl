{include file="header.tpl" title=foo}

<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8 deconnected">
	<h1> {$message} </h1>
	
	{foreach from=$liste_matchs item=match}
	  	<div class="panel panel-default">
		 	<div class="panel-heading">
		   		 <h3 class="panel-title">{$match.date_match_championnat}</h3>
		  	</div> 
		  
		 	<div class="panel-body">
		 		<table class="table table-striped" style="border:0;">
		 			<tr>
					    <td> Match aller </td>
					    <td></td>
					    <td>{$match.equipe_visiteur}</td>
					    <td>{$match.equipe_domicile}</td>
					    <td></td>
					</tr>
					<tr>
						<form action="" method="post">
							<td></td>
							<td></td>
							<td><input type="numeric" value="{$match.buts_equipe_visiteur}" name="but_visiteur" /></td>
							<td><input type="numeric" value="{$match.buts_equipe_domicile}" name="but_domicile" /></td>
							<td><input type="hidden" name="id_match_championnat" value="{$match.id_match_championnat}" /><input type="submit" name="afficher_calendrier" value="modifier" /></td>
						</form>
					</tr>
				</table>
				<p>Arbitres : {$match.arbitre1} | {$match.arbitre2} | {$match.arbitre3} | {$match.arbitre4} | {$match.remplacant}</p>
		 	</div>
		</div>
		{/foreach}
		<form action="" method="post" style="text-align:center;">
		<ul class="pagination">
			{for $i=1 to $nb_page}
				<li><input type="submit" class="btn btn-default" value="{$i}" name="afficher_calendrier"/></li>
			{/for}
		</ul>
	</form>
	</div>
</div>


{include file="footer.tpl" title=foo}

