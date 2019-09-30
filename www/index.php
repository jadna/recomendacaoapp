
<?php
require 'config/kint_debugger/kint.phar';
require 'services/RecommendationSystemService.class.php';

$servicie = new RecommendationSystemService();

/* Get all places on database */
d($servicie->showAllPlaces());



?>

