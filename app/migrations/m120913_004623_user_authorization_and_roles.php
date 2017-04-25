<?php

define('TBL_USER', 'user');
define('TBL_USERCREDENTIALS', 'user_credentials');
define('TBL_ASSIGNMENT', 'auth_assignment');
define('TBL_ITEM', 'auth_item');
define('TBL_ITEMCHILD', 'auth_itemchild');


class m120913_004623_user_authorization_and_roles extends CDbMigration
{
    const AUTH_ROLE      = 2;
    const AUTH_TASK      = 1;
    const AUTH_OPERATION = 0;
    
    const ADMIN_USER_ID = 1; //User id is autoincrement field.
                             //For the first created user it's equal 1
    const DEMO_USER_ID  = 2; //For the second created user it's equal 2

    const IDENT_TYPE_PASSWORD = 1; //Password identity type        
    
    
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->init();
        $this->createUserTbl();
        $this->createUserIdentityTbl();
        $this->createAuthItem();
        $this->createAuthItemChild();
        $this->createAuthAssignment();
        $this->finalize();
    }

    public function safeDown()
    {
        $this->dropAuthAssignment();
        $this->dropAuthItemChild();
        $this->dropAuthItem();
        $this->dropUserIdentityTbl();
        $this->dropUserTbl();
    }
    
    
    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_ASSIGNMENT.'`;
                drop table if exists `'.TBL_ITEMCHILD.'`;
                drop table if exists `'.TBL_ITEM.'`;
                drop table if exists `'.TBL_USERCREDENTIALS.'`;
                drop table if exists `'.TBL_USER.'`;';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createUserTbl() {         
         $this->createTable(TBL_USER, array(
            'id'            => 'INT NOT NULL AUTO_INCREMENT',
            'user_name'     => 'VARCHAR(32) NOT NULL',
            'first_name'    => 'VARCHAR(45) NOT NULL',
            'last_name'     => 'VARCHAR(45) NOT NULL',
            'email'         => 'VARCHAR(64) NOT NULL',
            'birthday'      => 'DATE NULL',
            'created_at'    => 'DATETIME NOT NULL',
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );
         
        $this->insert(TBL_USER, array(
            'user_name'     => 'admin',
            'first_name'    => 'admin',
            'last_name'     => 'admin',
            'email'         => 'admin@store.com',
            'created_at'    => date('Y-m-d H:i:s')
        ));
        
        $this->insert(TBL_USER, array(
            'user_name'     => 'demo',
            'first_name'    => 'demo',
            'last_name'     => 'demo',
            'email'         => 'demo@store.com',
            'created_at'    => date('Y-m-d H:i:s')
        ));
    }
    
    private function dropUserTbl() {
        $this->dropTable(TBL_USER);
    }
    
    private function createUserIdentityTbl() {        
        $this->createTable(TBL_USERCREDENTIALS, array(
            'id'            => 'INT NOT NULL AUTO_INCREMENT',
            'user_id'       => 'INT NOT NULL',
            'type_id'       => 'TINYINT NOT NULL',
            'password'      => 'VARCHAR(32) NOT NULL',                                    
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );
        $this->createIndex('fk_'.TBL_USERCREDENTIALS.'_'.TBL_USER,
                            TBL_USERCREDENTIALS, 'user_id');
        $this->addForeignKey('fk_'.TBL_USERCREDENTIALS.'_'.TBL_USER, 
                            TBL_USERCREDENTIALS, 'user_id',
                            TBL_USER, 'id', 'CASCADE', 'CASCADE');
        
        $this->insert(TBL_USERCREDENTIALS, array(
            'user_id'       => self::ADMIN_USER_ID,
            'type_id'       => self::IDENT_TYPE_PASSWORD,
            'password'      => md5('admin')            
        ));
        $this->insert(TBL_USERCREDENTIALS, array(
            'user_id'       => self::DEMO_USER_ID ,
            'type_id'       => self::IDENT_TYPE_PASSWORD,
            'password'      => md5('demo')            
        ));
    }
    
    private function dropUserIdentityTbl() {
        $this->dropForeignKey('fk_'.TBL_USERCREDENTIALS.'_'.TBL_USER, TBL_USERCREDENTIALS);
        $this->dropIndex('fk_'.TBL_USERCREDENTIALS.'_'.TBL_USER, TBL_USERCREDENTIALS);
        $this->dropTable(TBL_USERCREDENTIALS);
    }
    
     private function createAuthItem() {         
         $this->createTable(TBL_ITEM, array(            
            'name'          => 'VARCHAR(64) NOT NULL',
            'type'          => 'INT NOT NULL',
            'description'   => 'TEXT',
            'bizrule'       => 'TEXT',            
            'data'          => 'TEXT',
            'PRIMARY KEY (`name`)' ),
            'ENGINE = InnoDB'
        );

        $auth=Yii::app()->authManager;
        $role=$auth->createRole('admin', 'Store administrator');
        $role=$auth->createRole('customer', 'Registered customer', 
                'return !Yii::app()->user->isGuest;');//bizrule

    }
    
    private function createAuthItemChild() {         
         $this->createTable(TBL_ITEMCHILD, array(            
            'parent'        => 'VARCHAR(64) NOT NULL',
            'child'         => 'VARCHAR(64) NOT NULL',            
            'PRIMARY KEY (`parent`, `child`)' ),
            'ENGINE = InnoDB'
        );
         
        $this->createIndex('fk_parent', TBL_ITEMCHILD,
                            'parent');
        $this->addForeignKey('fk_parent', TBL_ITEMCHILD,
            'parent', TBL_ITEM, 'name', 'CASCADE', 'CASCADE');
        $this->createIndex('fk_child', TBL_ITEMCHILD,
                            'child');
        $this->addForeignKey('fk_child', TBL_ITEMCHILD,
            'child', TBL_ITEM, 'name', 'CASCADE', 'CASCADE');
    }
    
    private function createAuthAssignment() {         
         $this->createTable(TBL_ASSIGNMENT, array(            
            'itemname'      => 'VARCHAR(64) NOT NULL',
            'userid'        => 'VARCHAR(64) NOT NULL',            
            'bizrule'       => 'TEXT',            
            'data'          => 'TEXT',
            'PRIMARY KEY (`itemname`, `userid`)' ),
            'ENGINE = InnoDB'
        );
         
        $this->createIndex('fk_itemname', TBL_ASSIGNMENT,
                            'itemname');
        $this->addForeignKey('fk_itemname', TBL_ASSIGNMENT,
            'itemname', TBL_ITEM, 'name', 'CASCADE', 'CASCADE');  
        
        /*$this->createIndex('fk_'.TBL_ASSIGNMENT.'_'.TBL_USER,
                            TBL_ASSIGNMENT, 'userid');
        $this->addForeignKey('fk_'.TBL_ASSIGNMENT.'_'.TBL_USER, 
                            TBL_ASSIGNMENT, 'userid',
                            TBL_USER, 'id', 'CASCADE', 'CASCADE');
        */
                
        $auth=Yii::app()->authManager;
        $auth->assign('admin', self::ADMIN_USER_ID);        
    }
    
    private function dropAuthItem() {
        $this->dropTable(TBL_ITEM);
    }
    
    private function dropAuthItemChild() {
        $this->dropForeignKey('fk_child', TBL_ITEMCHILD);
        $this->dropIndex('fk_child', TBL_ITEMCHILD);
        $this->dropForeignKey('fk_parent', TBL_ITEMCHILD);
        $this->dropIndex('fk_parent', TBL_ITEMCHILD);
        $this->dropTable(TBL_ITEMCHILD);
    }
    
    private function dropAuthAssignment() {
        $this->dropForeignKey('fk_itemname', TBL_ASSIGNMENT);
        $this->dropIndex('fk_itemname', TBL_ASSIGNMENT);
        $this->dropTable(TBL_ASSIGNMENT);
    }
}