<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.06.2018
 * Time: 16:41
 */

//use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use kartik\grid\GridView;
use kartik\grid\FormulaColumn;

?>

<?php
$resultData = [
    array("id"=>1,"name"=>"Cyrus","email"=>"risus@consequatdolorvitae.org"),
    array("id"=>2,"name"=>"Justin","email"=>"ac.facilisis.facilisis@at.ca"),
    array("id"=>3,"name"=>"Mason","email"=>"in.cursus.et@arcuacorci.ca"),
    array("id"=>4,"name"=>"Fulton","email"=>"a@faucibusorciluctus.edu"),
    array("id"=>5,"name"=>"Neville","email"=>"eleifend@consequatlectus.com"),
    array("id"=>6,"name"=>"Jasper","email"=>"lectus.justo@miAliquam.com"),
    array("id"=>7,"name"=>"Neville","email"=>"Morbi.non.sapien@dapibusquam.org"),
    array("id"=>8,"name"=>"Neville","email"=>"condimentum.eget@egestas.edu"),
    array("id"=>9,"name"=>"Ronan","email"=>"orci.adipiscing@interdumligulaeu.com"),
    array("id"=>10,"name"=>"Raphael","email"=>"nec.tempus@commodohendrerit.co.uk"),
];
$dataProvider = new ArrayDataProvider([
    'key'=>'id',
    'allModels' => $resultData,
    'sort' => [
        'attributes' => ['id', 'name', 'email'],
    ],
]);

$res = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'name',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
    ],
    ];

echo GridView::widget([
    'dataProvider'=> $dataProvider,

    'columns' => [
        [
            'attribute' => 'id',
            'options' => [
                'rowspan' => 2,
            ]
            /*'class'=>'kartik\grid\FormulaColumn',
            'header'=>'asd',
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],*/
        ],
        [
            'attribute' => 'name',
        ],
        [
            'attribute' => 'email'
        ],
        [
            'attribute' => 'name'
        ],
    ],
    /*'beforeHeader'=>[
        [
            'columns'=>[
                ['content' => 'Дата', 'options' => ['rowspan' => 2, 'class'=>'text-center warning']],
                ['content'=>'Выезд', 'options'=>['colspan'=>2, 'class'=>'text-center warning']],
                ['content'=>'Header Before 2', 'options'=>['colspan'=>4, 'class'=>'text-center warning']],
            ],
            'options'=>['class'=>'skip-export'] // remove this row from export
        ]
    ],*/
    'responsive'=>true,
    'hover'=>true
]);
?>
