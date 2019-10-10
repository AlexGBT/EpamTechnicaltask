<?php
namespace Models;
use Services\Db;

abstract class ActiveRecordEntity
{
    abstract protected static function getTableName(): string;

    public static function getById(int $id) {
        $db = Db::getDbInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    public static function getByParameter($parameterName, $parameterValue){
        $db= Db::getDbInstance();
        return $db->query(
            'SELECT * FROM ' . static::getTableName() . ' WHERE ' . $parameterName . '=' .':parameterValue;',
            [':parameterValue' => $parameterValue],
            static::class
        );
    }

    public static function findAll(): array
    {
        $db = Db::getDbInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    public static function getWorkersAndTheirPayrolls()
    {
        $db = Db::getDbInstance();
            return $db->query('SELECT * FROM workers LEFT OUTER JOIN payrolls ON workers.id = payrolls.worker_id ',[] );
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $string) : string {
        return strtolower(preg_replace('~[A-Z]~', '_$0', $string));
    }

    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    public function save() {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null || $this->payrollId !== null) {
             $this->update($mappedProperties);
        } else {
             $this->insert($mappedProperties);
        }
    }

    private function update(array $mappedProperties){
        $str = '';
        foreach ($mappedProperties as $propertyName => $propertyValue ) {
            $str = $str . $propertyName . " = :" .  $propertyName . ",";
        }
        $str = substr(trim($str),0,-1);
        $db = Db::getDbInstance();
        $db->query("Update ". static::getTableName() ." SET " . $str ." WHERE  payroll_id = :payroll_id",$mappedProperties, static::class);
    }


    private function insert(array $mappedProperties){
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . $columnName. '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = Db::getDbInstance();
        $db->query($sql, $params2values, static::class);
        $this->payrollId = $db->getLastInsertId('payroll_id');
    }


}