<section class="container-fluid mb-3">
	<div class="row">
		<div class="col-md-12 col-lg-12 mt-3">
			<div class="card card-body">
				<header>
					<?php
					if(isset($_SESSION['idmembre']))
					{
						?>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item active">Observations</li>
							<li class="breadcrumb-item"><a href="index.php?module=consultation&amp;action=consultation" rel="nofollow">Consultation</a></li>
							<li class="breadcrumb-item"><a href="index.php?module=consultation&amp;action=consultcarto" rel="nofollow">Consultation carto</a></li>
						</ol>
						<?php
					}
					?>
					<h1 id="titrep" class="h2 text-center">Les dernières observations</h1>
				</header>
				<?php
				if(isset($rjson_site['observatoire']))
				{
					?>
					<ul class="list-inline">						
						<?php
						if($obser == 'aucun')
						{
							?><li id="aucun" class="list-inline-item idvar color1"><i class="cercleicone fe-webobs fa-2x curseurlien" title="Tous"></i></li><?php
						}
						else
						{
							?><li id="aucun" class="list-inline-item idvar"><i class="cercleicone fe-webobs fa-2x curseurlien" title="Tous"></i></li><?php
						}
						foreach ($menuobservatoire as $n)
						{
							if($n['var'] == $obser)
							{
								?><li id="<?php echo $n['var'];?>" class="list-inline-item idvar color1"><i class="cercleicone <?php echo $n['icon'];?> fa-2x curseurlien" title="<?php echo $n['nom'];?>"></i></li><?php
							}
							else
							{
								?><li id="<?php echo $n['var'];?>" class="list-inline-item idvar"><i class="cercleicone <?php echo $n['icon'];?> fa-2x curseurlien" title="<?php echo $n['nom'];?>"></i></li><?php
							}								
						}
						?>
					</ul>							
					<?php
				}
				?>
				<form class="form-inline">
					<div class="form-group">
						<label for="regroup">tri par</label>							
						<select id="tri" class="form-control form-control-sm ml-2">
							<option value="dateobs">Date d'observation</option>
							<option value="datesaisie">Date de saisie</option>							
						</select>
					</div>
					&nbsp;
					<div class="form-group">
						<label for="regroup">Regroupement par</label>							
						<select id="regroup" class="form-control form-control-sm">
							<option value="date">Date</option>
							<option value="espece">Espèce</option>
							<?php
							if($dep == 'oui')
							{
								?><option value="departement">Département</option><?php
							}
							?>
							<option value="commune">Commune</option>
							<option value="observateur">Observateur</option>
						</select>
					</div>
					&nbsp;
					<div class="form-group" id="indice">
						<span class="badge badge-default idind curseurlien" id="E" data-toggle="tooltip" data-placement="top" title="Exeptionnelle">E</span>
						<span class="badge badge-default idind curseurlien" id="TR" data-toggle="tooltip" data-placement="top" title="Très rare">TR</span>
						<span class="badge badge-default idind curseurlien" id="R" data-toggle="tooltip" data-placement="top" title="Rare">R</span>
						<span class="badge badge-default idind curseurlien" id="AR" data-toggle="tooltip" data-placement="top" title="Assez rare">AR</span>
						&nbsp;<span class="badge badge-default idind curseurlien" id="indicet" data-toggle="tooltip" data-placement="top" title="Suppression du filtre">Tous</span>
					</div>
				</form>				
			</div>
			<div class="card card-body mt-2">
				<div id="listeobs">
					<div class="mt-2"><p class="text-warning text-center"><span class="fa fa-spin fa-spinner fa-2x"></span> Chargement des données...</p></div>
				</div>
				<div class="row mb-1">					
					<div class="col-md-12 col-lg-12 text-center">
						<div id="pagination" class="float-right"></div>
						<button class="btn color1_bg" type="button" id="bttrhaut"><i class="fa fa-arrow-up blanc"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input id="lat" type="hidden" value="<?php echo $rjson_emprise['lat'];?>"/><input id="lng" type="hidden" value="<?php echo $rjson_emprise['lng'];?>"/><input id="p" type="hidden" value="1"/>
	<input id="sel" name="sel" type="hidden" value="<?php echo $obser;?>"/><input id="dep" type="hidden" value="<?php echo $dep;?>"/><input id="mt" type="hidden" value="<?php echo $rjson_emprise['nbmaille'];?>"/>
</section>
<div class="modal fade" id="fiche">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>				
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div id="listefiche"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>			
<div class="modal fade" id="obs">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-pencil fa-lg curseurlien" title="Modifier votre observation"></i></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>				
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-7">
							<h5>Informations sur l'observation n° <span class="obsidobs"></span><span class="lienidobs"></span>
								<?php
								if(isset($_SESSION['idmembre']))
								{
									?><span class="modobs"></span><?php
								}
								?>
							</h5>
							<p>
								<span class="diffcdref"></span><br />
								<span class="obsdatefr"></span> - <span class="obsfloutage"></span><br /><br />
								<span class="obsobservateur"></span>
							</p>
							<h6>Détail de l'observation</h6>
							<p>
								<span class="obsligne"></span><br />
								<span class="obsdeterminateur"></span>								
							</p>
							<div class="row obsphoto popup-gallery"></div>
							<div class="obscommentaire"></div>
							<?php 
							if(isset($_SESSION['idmembre']))
							{
								?>
								<form>
									<div class="form-group">
										<label for="commentaire">Ajouter un commentaire</label>
										<textarea class="form-control" id="commentaire"></textarea>
									</div>
									<div class="form-group">
										<button type="button" id="BttVcom" class="btn btn-success" data-dismiss="modal">Envoyer</button>
									</div>
									<input id="idobscom" type="hidden"/><input id="idmcom" type="hidden" value="<?php echo $_SESSION['idmembre'];?>"/><input id="idmor" type="hidden"/>
								</form>								
								<?php
							}
							?>
						</div>
						<div class="col-md-5">
							<div id="mapobser"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>