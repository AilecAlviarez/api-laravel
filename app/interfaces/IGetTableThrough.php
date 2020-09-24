<?php


namespace App\interfaces;


interface IGetTableThrough
{
    public function _getTableThrough($table,$through,$ForeignTrough,$ForeignTable);
}
