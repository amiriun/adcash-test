## Amir's Notes:
* Due to the fact that the name of the product or user's name might be changed after creating the order, I felt the need to denormalize the orders table and put  the  `cloned_product_name` and `cloned_user_fullname` in orders table.

* Discount rule is located in `params.php` and one can easily change anything in it when it is needed

##Instalation:
* First: configure the db file --> `config/db.php`
* Second: `composer install`
* Third: `php yii migrate`
* Fourth: `php yii serve`
* Fifth: go to `http://localhost:8080/index.php?r=order/index`



