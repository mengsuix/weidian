<?php
/**
 * Created by PhpStorm.
 * User: mengsuix
 * Date: 2019-01-10
 * Time: 19:56
 */

namespace App\Model\Traits;


trait DbTrait
{
    private $tableObj;

    /**
     * 查询单行数据
     * @param $field
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getOne($field)
    {
        return $this->tableObj->first($field);
    }

    /**
     * 查询多行数据
     * @param array $field
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getList($field = ['*'])
    {
        return $this->tableObj->get($field);
    }

    /**
     * 条件构造
     * @param null $where
     * @param null $groupBy
     * @param null $orderBy
     * @param null $limit
     * @param null $offset
     */
    public function condition($where = null, $groupBy = null, $orderBy = null, $limit = null, $offset = null)
    {
        //条件构造；条件结构：array(array(field => '字段', condition => 'condition', value => '值'), ...)
        if (!empty($where)) {
            foreach ($where as $item) {
                $this->tableObj->where($item['field'], $item['condition'], $item['value']);
            }
        }
        //分组构造；分组结构：array(value1, ...)
        if (!empty($groupBy)) {
            $this->tableObj->groupBy($groupBy);
        }
        //排序构造；排序结构：array(column => '字段', direction => 'desc/asc')
        if (!empty($orderBy)) {
            $this->tableObj->orderBy($orderBy['column'], $orderBy['direction']);
        }
        //条数限制；$limit = '数字'
        if (!empty($limit)) {
            $this->tableObj->limit($limit);
        }
        //偏移值；$offset = '数字'
        if (!empty($offset)) {
            $this->tableObj->offset($offset);
        }
    }
}