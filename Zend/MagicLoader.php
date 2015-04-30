<?php

class Zend_MagicLoader extends Zend_Loader {

    public static function loadClass($class) {
        if (!@parent::autoload($class) && strpos($class, 'Zend_DataObject_') === 0) {
            $name = strtolower(
                    str_replace('Zend_DataObject_', '', $class) . 's'
            );
            $pk = strtolower(
                    str_replace('Zend_DataObject_', '', $class) . '_id'
            );
            eval(<<< CLASS
                    class $class extends Zend_DataObject_Abstract { protected \$_name = '$name'; protected \$_pk = '$pk'; }
CLASS
            );
            return true;
        }
        return false;
    }

}
