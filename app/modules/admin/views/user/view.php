<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);

$this->menu=array(	
    array('label'=>'Users List', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>
 
<h1>View user "<?php echo $model->username; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
        'username',
		'first_name',
		'last_name',
		'email',
        'phone',
        'company',
        'industry_asi',
        'industry_ppai',
        'industry_sage',
        'industry_upic',		
        'created_at',
		'updated_at',
        'is_banned',
        array('label'=>'Assigned Roles', 'type'=>'raw', 'value'=>$roles)
	),
)); ?>

<div id="shipping-billing">
        <div class="shipping">
            <p>Default Shipping Address:</p>
            <?php if($shippingAddr): ?>
            <?php echo $shippingAddr->first_name ?> <?php echo $shippingAddr->last_name; ?><br />
            <?php echo $shippingAddr->line1?> - <?php echo $shippingAddr->line2?><br />
            <?php echo $shippingAddr->city?>, <?php echo $shippingAddr->state_code?> <?php echo $shippingAddr->zip?><br />
            <?php echo $shippingAddr->country?><br />
            <?php if ($shippingAddr->phone):?>
            T: <?php echo $shippingAddr->phone?>
            <?php endif; ?>
            </span>
            <?php else: ?>
            <em>no address</em>
            <?php endif; ?>
        </div>
    
        <div class="billing">
            <p>Default Billing Address:</p>
            <?php if($billingAddr): ?>
            <?php echo $billingAddr->first_name ?> <?php echo $billingAddr->last_name; ?><br />
            <?php echo $billingAddr->line1?> - <?php echo $billingAddr->line2?><br />
            <?php echo $billingAddr->city?>, <?php echo $billingAddr->state_code?> <?php echo $billingAddr->zip?><br />
            <?php echo $billingAddr->country?><br />
            <?php if ($billingAddr->phone):?>
            T: <?php echo $billingAddr->phone?>
            <?php endif; ?>
            </span>
            <?php else: ?>
            <em>no address</em>
            <?php endif; ?>
        </div>
</div>

