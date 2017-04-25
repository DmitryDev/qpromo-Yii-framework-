<?php
/* @var $this UserController */
/* @var $model UserEntryForm */

$this->breadcrumbs=array(
    'Users'=>array('index'),
    $model->username=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    array('label'=>'Users List', 'url'=>array('index')),
    array('label'=>'Create User', 'url'=>array('create')),
    array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>Update user "<?php echo $model->username; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>