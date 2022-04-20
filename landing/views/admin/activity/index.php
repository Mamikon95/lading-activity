<?php
use yii\grid\GridView;
use yii\bootstrap4\LinkPager;

$this->title = 'Activity';
?>

<?= /** @var \yii\data\ArrayDataProvider $provider */
GridView::widget([
    'dataProvider' => $provider,
    'summary' => '',
    'columns' => [
        'url',
        'visitCounts',
        'lastVisitDate',
    ],
]) ?>

<?= /** @var \yii\data\Pagination $pages */
LinkPager::widget([
    'pagination' => $pages,
]);?>
