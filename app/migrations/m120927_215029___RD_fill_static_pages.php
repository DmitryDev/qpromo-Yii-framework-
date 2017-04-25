<?php
defined('TBL_PAGE') || define('TBL_PAGE', 'page');

class m120927_215029___RD_fill_static_pages extends CDbMigration
{
	public function up()
	{
        $this->insert(TBL_PAGE, array(            
            'name'          => 'Help / FAQ',            
            'slug'          => 'help-faq',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'content'       =>'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Neque eveniet laborum illo et nihil in perferendis inventore 
                                ipsam recusandae hic vero ratione veritatis quasi officiis dolor 
                                consectetur praesentium. Harum modi quaerat sint sequi 
                                accusantium laboriosam quam et excepturi rem nostrum dicta 
                                inventore voluptatum tempora soluta illo veniam vitae vero 
                                ipsam voluptate facere! At quia eum quis necessitatibus cumque 
                                esse ad incidunt quos alias officiis laudantium repellat 
                                voluptate in dolore iste exercitationem quasi! Alias beatae 
                                quas quibusdam doloremque magni repellendus sint quis dolor 
                                nulla perspiciatis cumque ut asperiores qui. A nesciunt explicabo 
                                illo eveniet ex at voluptatibus perferendis voluptatem minima 
                                nostrum odit impedit deserunt dolorum quas accusamus unde magni 
                                laudantium ab saepe harum? Iste totam reprehenderit quos facilis 
                                delectus eum fugiat voluptatum nulla animi modi nemo natus quia 
                                fugit cum ipsam ad reiciendis dolor pariatur accusamus nostrum. 
                                Veritatis vel beatae omnis ab esse nihil natus. Magnam possimus 
                                fugit nisi tenetur sapiente cumque exercitationem quos iusto 
                                impedit esse ex aspernatur quis asperiores veniam consectetur 
                                optio explicabo facilis recusandae dolorem culpa. Cupiditate error 
                                itaque dolorum eveniet nostrum quas pariatur odit a labore 
                                accusamus rem suscipit tenetur eius provident culpa! Temporibus 
                                inventore accusamus reiciendis dicta praesentium veritatis fugiat! 
                                Voluptatibus sit recusandae itaque esse saepe.</p>'
            ));  
        
            $this->insert(TBL_PAGE, array(            
            'name'          => 'Shipping & Returns',            
            'slug'          => 'shipping-returns',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'content'       =>'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Neque eveniet laborum illo et nihil in perferendis inventore 
                                ipsam recusandae hic vero ratione veritatis quasi officiis dolor 
                                consectetur praesentium. Harum modi quaerat sint sequi 
                                accusantium laboriosam quam et excepturi rem nostrum dicta 
                                inventore voluptatum tempora soluta illo veniam vitae vero 
                                ipsam voluptate facere! At quia eum quis necessitatibus cumque 
                                esse ad incidunt quos alias officiis laudantium repellat 
                                voluptate in dolore iste exercitationem quasi! Alias beatae 
                                quas quibusdam doloremque magni repellendus sint quis dolor 
                                nulla perspiciatis cumque ut asperiores qui. A nesciunt explicabo 
                                illo eveniet ex at voluptatibus perferendis voluptatem minima 
                                nostrum odit impedit deserunt dolorum quas accusamus unde magni 
                                laudantium ab saepe harum? Iste totam reprehenderit quos facilis 
                                delectus eum fugiat voluptatum nulla animi modi nemo natus quia 
                                fugit cum ipsam ad reiciendis dolor pariatur accusamus nostrum. 
                                Veritatis vel beatae omnis ab esse nihil natus. Magnam possimus 
                                fugit nisi tenetur sapiente cumque exercitationem quos iusto 
                                impedit esse ex aspernatur quis asperiores veniam consectetur 
                                optio explicabo facilis recusandae dolorem culpa. Cupiditate error 
                                itaque dolorum eveniet nostrum quas pariatur odit a labore 
                                accusamus rem suscipit tenetur eius provident culpa! Temporibus 
                                inventore accusamus reiciendis dicta praesentium veritatis fugiat! 
                                Voluptatibus sit recusandae itaque esse saepe.</p>'
            ));
            
            $this->insert(TBL_PAGE, array(            
            'name'          => 'Terms of Use',            
            'slug'          => 'terms-of-use',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'content'       =>'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Neque eveniet laborum illo et nihil in perferendis inventore 
                                ipsam recusandae hic vero ratione veritatis quasi officiis dolor 
                                consectetur praesentium. Harum modi quaerat sint sequi 
                                accusantium laboriosam quam et excepturi rem nostrum dicta 
                                inventore voluptatum tempora soluta illo veniam vitae vero 
                                ipsam voluptate facere! At quia eum quis necessitatibus cumque 
                                esse ad incidunt quos alias officiis laudantium repellat 
                                voluptate in dolore iste exercitationem quasi! Alias beatae 
                                quas quibusdam doloremque magni repellendus sint quis dolor 
                                nulla perspiciatis cumque ut asperiores qui. A nesciunt explicabo 
                                illo eveniet ex at voluptatibus perferendis voluptatem minima 
                                nostrum odit impedit deserunt dolorum quas accusamus unde magni 
                                laudantium ab saepe harum? Iste totam reprehenderit quos facilis 
                                delectus eum fugiat voluptatum nulla animi modi nemo natus quia 
                                fugit cum ipsam ad reiciendis dolor pariatur accusamus nostrum. 
                                Veritatis vel beatae omnis ab esse nihil natus. Magnam possimus 
                                fugit nisi tenetur sapiente cumque exercitationem quos iusto 
                                impedit esse ex aspernatur quis asperiores veniam consectetur 
                                optio explicabo facilis recusandae dolorem culpa. Cupiditate error 
                                itaque dolorum eveniet nostrum quas pariatur odit a labore 
                                accusamus rem suscipit tenetur eius provident culpa! Temporibus 
                                inventore accusamus reiciendis dicta praesentium veritatis fugiat! 
                                Voluptatibus sit recusandae itaque esse saepe.</p>'
            ));
            
            $this->insert(TBL_PAGE, array(            
            'name'          => 'Privacy Policy',            
            'slug'          => 'privacy-policy',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'content'       =>'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Neque eveniet laborum illo et nihil in perferendis inventore 
                                ipsam recusandae hic vero ratione veritatis quasi officiis dolor 
                                consectetur praesentium. Harum modi quaerat sint sequi 
                                accusantium laboriosam quam et excepturi rem nostrum dicta 
                                inventore voluptatum tempora soluta illo veniam vitae vero 
                                ipsam voluptate facere! At quia eum quis necessitatibus cumque 
                                esse ad incidunt quos alias officiis laudantium repellat 
                                voluptate in dolore iste exercitationem quasi! Alias beatae 
                                quas quibusdam doloremque magni repellendus sint quis dolor 
                                nulla perspiciatis cumque ut asperiores qui. A nesciunt explicabo 
                                illo eveniet ex at voluptatibus perferendis voluptatem minima 
                                nostrum odit impedit deserunt dolorum quas accusamus unde magni 
                                laudantium ab saepe harum? Iste totam reprehenderit quos facilis 
                                delectus eum fugiat voluptatum nulla animi modi nemo natus quia 
                                fugit cum ipsam ad reiciendis dolor pariatur accusamus nostrum. 
                                Veritatis vel beatae omnis ab esse nihil natus. Magnam possimus 
                                fugit nisi tenetur sapiente cumque exercitationem quos iusto 
                                impedit esse ex aspernatur quis asperiores veniam consectetur 
                                optio explicabo facilis recusandae dolorem culpa. Cupiditate error 
                                itaque dolorum eveniet nostrum quas pariatur odit a labore 
                                accusamus rem suscipit tenetur eius provident culpa! Temporibus 
                                inventore accusamus reiciendis dicta praesentium veritatis fugiat! 
                                Voluptatibus sit recusandae itaque esse saepe.</p>'
            ));
            
             $this->insert(TBL_PAGE, array(            
            'name'          => 'About Us',            
            'slug'          => 'about',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'content'       =>'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Neque eveniet laborum illo et nihil in perferendis inventore 
                                ipsam recusandae hic vero ratione veritatis quasi officiis dolor 
                                consectetur praesentium. Harum modi quaerat sint sequi 
                                accusantium laboriosam quam et excepturi rem nostrum dicta 
                                inventore voluptatum tempora soluta illo veniam vitae vero 
                                ipsam voluptate facere! At quia eum quis necessitatibus cumque 
                                esse ad incidunt quos alias officiis laudantium repellat 
                                voluptate in dolore iste exercitationem quasi! Alias beatae 
                                quas quibusdam doloremque magni repellendus sint quis dolor 
                                nulla perspiciatis cumque ut asperiores qui. A nesciunt explicabo 
                                illo eveniet ex at voluptatibus perferendis voluptatem minima 
                                nostrum odit impedit deserunt dolorum quas accusamus unde magni 
                                laudantium ab saepe harum? Iste totam reprehenderit quos facilis 
                                delectus eum fugiat voluptatum nulla animi modi nemo natus quia 
                                fugit cum ipsam ad reiciendis dolor pariatur accusamus nostrum. 
                                Veritatis vel beatae omnis ab esse nihil natus. Magnam possimus 
                                fugit nisi tenetur sapiente cumque exercitationem quos iusto 
                                impedit esse ex aspernatur quis asperiores veniam consectetur 
                                optio explicabo facilis recusandae dolorem culpa. Cupiditate error 
                                itaque dolorum eveniet nostrum quas pariatur odit a labore 
                                accusamus rem suscipit tenetur eius provident culpa! Temporibus 
                                inventore accusamus reiciendis dicta praesentium veritatis fugiat! 
                                Voluptatibus sit recusandae itaque esse saepe.</p>'
            ));
	}

	public function down()
	{
		
		Yii::app()->db->createCommand()                                
                ->delete(TBL_PAGE, 'slug=:slug', array(':slug'=>'help-faq'));
        Yii::app()->db->createCommand()
                ->delete(TBL_PAGE, 'slug=:slug', array(':slug'=>'shipping-returns'));
        Yii::app()->db->createCommand()
                ->delete(TBL_PAGE, 'slug=:slug', array(':slug'=>'terms-of-use'));
        Yii::app()->db->createCommand()
                ->delete(TBL_PAGE, 'slug=:slug', array(':slug'=>'privacy-policy'));
        Yii::app()->db->createCommand()
                ->delete(TBL_PAGE, 'slug=:slug', array(':slug'=>'about'));
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}