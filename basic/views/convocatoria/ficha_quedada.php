<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
?>
<div class="card mx-3 my-3 info" style="width: 18rem;">
  <div class="card-body">
      <h5><?= html::encode("{$convocatoria->texto}")?></h5>
  </div>
</div>