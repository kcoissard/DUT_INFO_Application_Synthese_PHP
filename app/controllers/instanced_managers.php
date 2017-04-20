<?php

$arbitre_manager = new ArbitreManager($pdo);
$championnat_manager = new ChampionnatManager($pdo);
$division_manager = new DivisionManager($pdo);
$equipe_manager = new EquipeManager($pdo);
$groupe_manager = new GroupeManager($pdo);
$match_championnat_manager = new MatchChampionnatManager($pdo);
$match_tournoi_manager = new MatchTournoiManager($pdo);
$pays_manager = new PaysManager($pdo);
$saison_manager = new SaisonManager($pdo);
$tournoi_manager = new TournoiManager($pdo);
$random = new Random($pdo);