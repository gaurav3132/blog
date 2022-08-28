<?php

namespace System\Core;

use System\Database\DB;
use System\Exceptions\DataNotFoundException;

abstract class Model extends DB
{
    protected string $table;

    protected string $pk="id";

    protected string $select="*";

    protected ?string $conditions;

    protected ?string $orderBy;

    protected ?int $offset;

    protected ?int $limit;

    protected ?string $query;

    protected bool $loaded= false;

    protected array $related=[];

    public function __construct(?string $value=null, string$column='id'){
        parent::__construct();

        if(!is_null($value)){
            $this->load($value,$column);
        }

    }

    public function select(string ...$columns): Model{
        if(count($columns)>0){
            $this->select=implode(', ',$columns);
        }
        return $this;
    }

    public function where(string $column,string $operator,?string $value=null): Model{
        if(is_null($value)) {
            $temp = "{$column} = '{$operator}'";
        }
            else{
                $temp="{$column} {$operator} '{$value}'";
            }
            if(empty($this->conditions)){
                $this->conditions=$temp;
            }
            else{
                $this->conditions .=" AND {$temp}";
            }
            return $this;
        }

        public function orWhere(string $column,string $operator,?string $value=null): Model{
            if(is_null($value)) {
                $this->conditions .= " OR {$column} = '{$operator}'";
            }
            else{
                $this->conditions .=" OR {$column} {$operator} '{$value}'";
            }
            return $this;
        }

        public function whereNUll(string $column): Model{
            if(empty($this->conditions)){
                $this->conditions="{$column} IS NULL";
            }
            else{
                $this->conditions .=" AND {$column} NULL";
            }
            return $this;
        }

    public function orwhereNUll(string $column): Model{
            $this->conditions .=" OR {$column} IS NULL";

        return $this;
    }

    public function whereNotNUll(string $column): Model{
        if(empty($this->conditions)){
            $this->conditions="{$column} IS NOT NULL";
        }
        else{
            $this->conditions .=" AND {$column} NOT NULL";
        }
        return $this;
    }

    public function orwhereNotNUll(string $column): Model{
        $this->conditions .=" OR {$column} IS NOT NULL";

        return $this;
    }

    public function orderBy(string $columns, string $direction='ASC'): Model {
        if(empty($this->orderBy)){
            $this->orderBy="{$columns} {$direction}";
        }
        else{
            $this->orderBy.=", {$columns} {$direction}";
        }
        return $this;
    }

    public function limit(int $offset, ?int $limit = null): Model {
        if(is_null($limit)){
            $this->offset= 0;
            $this->limit= $offset;
        }
        else{
            $this->offset = $offset;
            $this->limit= $limit;
        }

        return $this;
    }

    public function get(): array{
        $this->buildSelect();

        $this->run($this->query);
        if(empty($this->related)){
            $class=get_class($this);
        }
        else{
            $class= $this->related['class'];
        }

        $this->resetVars();

        if($this->count()>0){
            $data= $this->fetch();

            $class=get_class($this);

            $collection=[];

            foreach($data as $item){
                $obj= new $class;

                foreach($item as $k=> $v){
                    $obj->{$k}=$v;
                }

                $obj->setLoaded(true);

                $collection[]=$obj;
            }
            return $collection;
        }
        else{
            return [];
        }
    }

    public function first(): ?Model {
        $this->limit(1);

        $data = $this->get();

        if(!empty($data)){
            return $data[0];
        }
        else{
            return null;
        }
    }

    public function load(string $value,string $column ='id'){
        $this->where($column,$value);

        $this->buildSelect();

        $this->run($this->query);

        $this->resetVars();

        if($this->count()>0){
            $data=$this->fetch();

            foreach($data[0] as $k => $v){
                $this->{$k}=$v;
            }

            $this->setLoaded(true);
        }
        else{
            throw new DataNotFoundException("Data with condition '{$column}= {$value}' not found in the table '{$this->table}'");
        }
    }

    public function save(){
        if($this->loaded){
            $this->buildUpdate();

        }
        else{
            $this->buildInsert();
        }
        $this->run($this->query);
        $this->resetVars();

        if($this->loaded){
            $id=$this->{$this->pk};
        }
        else{
            $id=$this->last_id();
        }
        $this->load($id);
    }

    public function delete(){
        $this->buildDelete();

        $this->run($this->query);
        $this->resetVars();

        $variables= $this->getDataVariables();

        foreach($variables as $k => $v){
            unset($this->{$k});
        }
        $this->setLoaded(false);
    }

    public function setLoaded(bool $data){
        $this->loaded= $data;
    }

    protected function related(string $class,string $table,string $fk,string $pk='id',string $relation ='child'):Model{
        $this->related=[
            'class'=>$class,
            'table'=>$table,
            'fk'=>$fk,
            'pk'=>$pk,
            'relation'=>$relation
        ];
        return $this;
    }

    private function buildSelect(){
        if(empty($this->related)){
            $this->query="SELECT {$this->select} FROM {$this->table}";
        }
        else{
            $this->query="SELECT {$this->select} FROM {$this->related['table']}";
            if($this->related['relation']=='child'){
                $this->where($this->related['fk'],$this->{$this->pk});
            }
            else{
                $this->where($this->related['pk'],$this->{$this->related['fk']});
            }
        }


        if(!empty($this->conditions)){
            $this->query.= " WHERE {$this->conditions}";
        }

        if(!empty($this->orderBy)){
            $this->query .=" ORDER BY {$this->orderBy}";
        }

        if(!empty($this->offset) && !empty($this->limit)){
            $this->query .= " LIMIT {$this->offset}, {$this->limit}";
        }
    }

    private function buildInsert(){
        $variables= $this->getDataVariables();
        
        $set = [];

        foreach($variables as $k=>$v){
            if(empty($v)){
                $set[]="{$k}=NULL";
            }
            else{
                $set[]= "{$k} = '{$v}'";
            }
        }

        $this->query="INSERT INTO {$this->table} SET ".implode(", ",$set);

    }

    private function buildUpdate(){
        $variables= $this->getDataVariables();

        $set = [];

        foreach($variables as $k=>$v){
            if(empty($v)){
                $set[]="{$k}=NULL";
            }
            else{
                $set[]= "{$k} = '{$v}'";
            }
        }

        $this->query="UPDATE INTO {$this->table} SET ".implode(", ",$set). " WHERE {$this->pk} ='{$this->{$this->pk}}' ";

    }

    private function buildDelete(){
        $this->query= "DELETE FROM {$this->table} WHERE {$this->pk} = '{$this->{$this->pk}}'";
    }

    private function getDataVariables():  array{
        $predefined= get_class_vars(get_class($this));
        $all= get_object_vars($this);

        return $filtered=array_diff_key($all,$predefined);
    }

    private function resetVars(){
        $this->select="*";
        $this->conditions=null;
        $this->orderBy=null;
        $this->offset=null;
        $this->limit=null;
        $this->query=null;
        $this->related=[];
    }




}