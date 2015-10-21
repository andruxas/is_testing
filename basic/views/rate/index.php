<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\editable\Editable;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
	
	/*
	GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'price',
            'name',
			'speed',
			[
				'attribute'=>'speed',
				'contentOptions' =>['class' => 'inlineEdit']

			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
	*/
	
	?>
    
<?php


$gridColumns = [
	[
    	'attribute'=>'id', 
	],	
	[
    	'attribute'=>'name', 
	],	
	[
    	'attribute'=>'price', 
	],		
	[
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'speed', 
    'readonly'=>function($model, $key, $index, $widget) {
        return (!$model->speed); 
    },
    'editableOptions'=>[
        'header'=>'Buy Amount', 
        'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
        'options'=>[
            'pluginOptions'=>['min'=>0, 'max'=>5000]
        ]
    ],
    'hAlign'=>'right', 
    'vAlign'=>'middle',
    'width'=>'7%',
    'format'=>['decimal', 2],
    'pageSummary'=>true
	],

	[
    'class'=>'kartik\grid\ActionColumn',

    'viewOptions'=>[],
    'updateOptions'=>[],
	],	
];


echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>$gridColumns,

	]);





?>
    
</div>




