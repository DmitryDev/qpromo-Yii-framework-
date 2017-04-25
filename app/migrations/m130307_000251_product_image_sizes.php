<?php


class m130307_000251_product_image_sizes extends CDbMigration
{
	public function up()
	{
        $sql = 'ALTER TABLE `product_image` CHANGE `path_small` `small` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
        $sql = 'ALTER TABLE `product_image` CHANGE `path_large` `large` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
        $sql = 'ALTER TABLE `product_image` CHANGE `path_tiny` `huge` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
        $sql = 'ALTER TABLE `product_image` CHANGE `path_thumbnail` `full` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
        $sql = 'ALTER TABLE `product_image` CHANGE `path_origin` `origin` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
	}

	public function down()
	{
		$sql = 'ALTER TABLE `product_image` CHANGE `small` `path_small` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
        $sql = 'ALTER TABLE `product_image` CHANGE `large` `path_large` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
        $sql = 'ALTER TABLE `product_image` CHANGE `huge` `path_tiny` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
        $sql = 'ALTER TABLE `product_image` CHANGE `full` `path_thumbnail` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
        $sql = 'ALTER TABLE `product_image` CHANGE `origin` `path_origin` VARCHAR(255) NOT NULL';
        $this->execute($sql, array());
	}
}