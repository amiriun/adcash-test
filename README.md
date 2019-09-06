## Amir's Notes:
* Due to the fact that the name of the product or user's name might be changed after creating the order, I felt the need to denormalize the orders table and put  the  `cloned_product_name` and `cloned_user_fullname` in orders table.

* Discount rule is located in `params.php` and one can easily change anything in it when it is needed

* I have created my own folder with the name of `/adcash` in the root directory and have put my repositories and services on it.

Here is the online demo link:
http://adcash.idea197.com/web/index.php?r=order/index

## Instalation:
* First: configure the db file --> `config/db.php`
* Second: `composer install`
* Third: `php yii migrate`
* Fourth: `php yii serve`
* Fifth: go to `http://localhost:8080/index.php?r=order/index`



