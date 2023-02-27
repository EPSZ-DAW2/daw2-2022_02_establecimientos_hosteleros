<?php 
    use yii\bootstrap5\LinkPager;

    use yii\bootstrap5\Nav;
    use yii\bootstrap5\NavBar;

        if(!Yii::$app->user->isGuest){
            NavBar::begin([
                'brandLabel' => '',
                'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
            ]);
            $items=[
                ['label' => 'Ver Convoctorias', 'url' => ['convocatoria/index']],
                ['label' => 'Crear convoctorias', 'url' => ['convocatoria/create']],
                ['label' => 'Administrar convocatorias propias', 'url' => ['convocatoria/verpropias']],
                ['label' => 'Administrar asistencias', 'url' => ['convocatoria/verinscripciones']],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => $items,
            ]);
            NavBar::end();
        }
?>