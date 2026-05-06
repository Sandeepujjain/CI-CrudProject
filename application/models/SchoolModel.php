<?php

use Symfony\Component\ExpressionLanguage\Node\FunctionNode;

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class ExtendFunctionModel
 * 
 * This class extends the CI_Model and provides additional functionality for CRUD operations.
 */
class ExtendFunctionModel extends CI_Model
{
    /**
     * ExtendFunctionModel constructor.
     * 
     * Initializes the ExtendFunctionModel.
     */
    protected $tableAlias = '';
    protected $selectColumns = '*';
    protected $whereConditions = [];
    protected $whereInConditions = [];
    protected $whereNotInConditions = [];
    protected $joinTables = [];
    protected $groupBy = '';
    protected $havingConditions = '';
    protected $orderBy = '';

    protected $limit = '';

    protected $distinct = false;
    public $lastQueryString = '';
    public $lastInsertedId = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Load form validation library in constructor
    }

    /**
     * Check the uniqueness of a field in a database table.
     *
     * This function checks if a given field value is unique in a specified table.
     * Optionally, it can exclude a specific record from the uniqueness check by 
     * considering its primary key value.
     *
     * @param string $table The name of the database table.
     * @param string $field The field/column to be checked for uniqueness.
     * @param string|null $primaryKey The primary key column name (optional).
     * @param mixed|null $primaryKeyValue The value of the primary key to exclude from the uniqueness check (optional).
     * @return bool Returns `false` if the value exists, otherwise `true`.
     */
    public function check_unique($table, $field, $primaryKey = null, $primaryKeyValue = null)
    {
        // Use $this to access class properties
        $CI = &get_instance();
        $CI->load->database();

        // Set the field value and condition
        $CI->db->where($field, $CI->input->post($field));
        if ($primaryKey !== null && $primaryKeyValue !== null) {
            $CI->db->where($primaryKey . ' !=', $primaryKeyValue);
        }
        $query = $CI->db->get($table);

        // Check if any rows exist with the given condition
        if ($query->num_rows() > 0) {
            return false;  // Value already exists
        }
        return true;   // Value is unique
    }
    /**
     * Set the table alias for the query.
     *
     * @param string $alias The alias for the table.
     * @return $this The current instance of the model for method chaining.
     */
    public function tableAlias(string $alias)
    {
        $this->tableAlias = $alias;
        return $this;
    }

    /**
     * Add columns to the SELECT clause of the query.
     *
     * This method adds columns to the SELECT clause of the query.
     * If called multiple times, it either replaces the existing columns
     * if it's the first call, or it appends the new columns to the existing list.
     *
     * @param string|array $columns The columns to be selected.
     * @param bool $distinct Whether to select distinct values.
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function select($columns, $distinct = false)
    {
        // If distinct is true, prepend the SELECT statement with DISTINCT
        if ($distinct) {
            $this->distinct = $distinct;
        }
        // If the columns are provided as an array, implode them
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }

        if ($this->selectColumns === '*') {
            // If the current selected columns is '*', replace it with the new columns
            $this->selectColumns = $columns;
        } else {
            // Otherwise, append the new columns to the existing list
            $this->selectColumns .= ', ' . $columns;
        }
        return $this;
    }
    /**
     * Add a JOIN clause to the query.
     *
     * This method adds a JOIN clause to the query.
     * If called multiple times, it adds multiple JOIN conditions.
     *
     * @param string $table The table to join.
     * @param string $condition The join condition.
     * @param string $type The type of join (e.g., INNER, LEFT, RIGHT).
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function join(string $table, string $condition, string $type = 'inner')
    {
        $this->joinTables[] = [$table, $condition, $type];
        return $this;
    }

    /**
     * Add a WHERE clause to the query.
     *
     * This method adds a WHERE clause to the query.
     * If called multiple times, it adds multiple WHERE conditions.
     *
     * @param string $column The column to filter.
     * @param mixed|null $value The value to compare against.
     * @return $this The current instance of the ExtendFunctionModel class.
     */

    public function where(string $column, string $value = null)
    {
        $this->whereConditions[] = [$column, $value];
        return $this;
    }

    /**
     * Add a LIKE clause to the query.
     *
     * This method adds a LIKE clause to the query.
     * If called multiple times, it adds multiple LIKE conditions.
     *
     * @param string $column The column to filter.
     * @param string $value The value to compare against.
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function like(string $column, string $value)
    {
        $this->likeConditions[] = [$column, $value];
        return $this;
    }
    /**
     * Add a WHERE condition to the query using the OR operator.
     *
     * @param string $column The column name.
     * @param mixed $value The value to compare against.
     * @return $this
     */

    public function orWhere(string $column, mixed $value)
    {
        $this->whereConditions[] = [$column, $value, 'OR'];
        return $this;
    }

    /**
     * Add a WHERE IN clause to the query.
     *
     * This method adds a WHERE IN clause to the query.
     * If called multiple times, it adds multiple WHERE IN conditions.
     *
     * @param string $column The column to apply the WHERE IN condition on.
     * @param array $values An array of values for the WHERE IN condition.
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function whereIn(string $column, array $values)
    {
        $this->whereInConditions[] = [$column, $values];
        return $this;
    }
    /**
     * Add a WHERE NOT IN clause to the query.
     *
     * This method adds a WHERE NOT IN clause to the query.
     * If called multiple times, it adds multiple WHERE NOT IN conditions.
     *
     * @param string $column The column to apply the WHERE NOT IN condition on.
     * @param array $values An array of values for the WHERE NOT IN condition.
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function whereNotIn(string $column, array $values)
    {
        $this->whereNotInConditions[] = [$column, $values];
        return $this;
    }

    /**
     * Add a GROUP BY clause to the query.
     *
     * This method adds a GROUP BY clause to the query.
     * If called multiple times, it concatenates the columns.
     *
     * @param string $column The column to group by.
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function groupBy(string $column)
    {
        if (!empty($this->groupBy)) {
            $this->groupBy .= ', ' . $column;
        } else {
            $this->groupBy = $column;
        }
        return $this;
    }

    /**
     * Add a HAVING condition to the query.
     *
     * This method adds a HAVING condition to the query.
     * If called multiple times, it concatenates the conditions using 'AND'.
     *
     * @param string $condition The HAVING condition to add to the query.
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function having(string $condition)
    {
        if (!empty($this->havingConditions)) {
            $this->havingConditions .= ' AND ' . $condition;
        } else {
            $this->havingConditions = $condition;
        }
        return $this;
    }

    /**
     * Add a column and direction for ordering the query results.
     *
     * This method adds a column and direction for ordering the query results.
     * If called multiple times, it concatenates the ordering conditions.
     *
     * @param string $column The column to add to the ordering.
     * @param string $direction (Optional) The direction of sorting, either 'ASC' or 'DESC'. Default is 'ASC'.
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function orderBy($column, $direction = 'ASC')
    {
        if (!empty($this->orderBy)) {
            $this->orderBy .= ', ' . $column . ' ' . $direction;
        } else {
            $this->orderBy = $column . ' ' . $direction;
        }
        return $this;
    }
    public function reset()
    {
        $this->tableAlias = '';
        $this->selectColumns = '*';
        $this->joinTables = [];
        $this->whereConditions = [];
        $this->whereInConditions = [];
        $this->whereNotInConditions = [];
        $this->groupBy = '';
        $this->havingConditions = '';
        $this->orderBy = '';
        $this->limit = '';
        return $this;
    }
    /**
     * Retrieve all records from the table.
     *
     * @return array|string|false Array of records or false if no records found.
     */
    public function findAll(bool $arrayReturn = true, bool $returnQueryStringOnly = false)
    {
        $this->db->select($this->selectColumns);
        if (!empty($this->tableAlias)) {
            $this->db->from($this->tableName . ' as ' . $this->tableAlias);
        } else {
            $this->db->from($this->tableName);
        }
        if ($this->distinct) {
            $this->db->distinct();
        }

        foreach ($this->joinTables as $join) {
            $this->db->join($join[0], $join[1], $join[2]);
        }

        foreach ($this->whereConditions as $where) {
            if (isset($where[2]) && strtoupper($where[2]) === 'OR') {
                $this->db->or_where($where[0], $where[1]);
            } else {
                if (isset($where[1])) {
                    $this->db->where($where[0], $where[1]);
                } else {
                    $this->db->where($where[0]);
                }
            }
        }
        foreach ($this->whereInConditions as $whereIn) {
            $this->db->where_in($whereIn[0], $whereIn[1]);
        }
        foreach ($this->whereNotInConditions as $whereNotIn) {
            $this->db->where_not_in($whereNotIn[0], $whereNotIn[1]);
        }

        if (!empty($this->groupBy)) {
            $this->db->group_by($this->groupBy);
        }

        if (!empty($this->havingConditions)) {
            $this->db->having($this->havingConditions);
        }

        if (!empty($this->orderBy)) {
            $this->db->order_by($this->orderBy);
        }

        if (!empty($this->limit)) {
            $this->db->limit($this->limit);
        }

        // Store the last query string before execution
        if ($returnQueryStringOnly) {
            $this->reset();
            return $this->db->get_compiled_select();
        }


        // $query = $this->db->get();
        // if ($query->num_rows() > 0) {
        //     if ($arrayReturn) {
        //         $result = $query->result_array();
        //     } else {
        //         $result = $query->result();
        //     }
        //     $this->reset();
        //     return $result;
        // } else {
        //     $this->reset();
        //     return false;
        // }
        $query = $this->db->get();

        if ($query === false) {
            log_message('error', 'DB Query failed: ' . $this->db->last_query());
            $this->reset();
            return [];
        }

        if ($query->num_rows() === 0) {
            $this->reset();
            return [];
        }

        $result = $arrayReturn ? $query->result_array() : $query->result();

        $this->reset();
        return $result;
    }
    /**
     * Find a record by primary key.
     *
     * @param mixed $primaryKey The value(s) of the primary key(s).
     * @param bool $arrayReturn Whether to return the record(s) as an array (default) or an object.
     * @param bool $returnQueryStringOnly If true, returns the query string only without executing the query.
     * @return array|object|false The record array or object if found, otherwise false.
     */
    public function find($primaryKey, $arrayReturn = true, bool $returnQueryStringOnly = false)
    {
        // Assuming $this->tableName contains the name of the table
        if (is_array($primaryKey)) {
            $this->db->where_in($this->primaryKey, $primaryKey);
        } else {
            $this->db->where($this->primaryKey, $primaryKey);
        }
        $query = $this->db->get($this->tableName);

        if ($returnQueryStringOnly) {
            return $this->db->last_query();
        }

        if ($query->num_rows() == 1) {
            if ($arrayReturn) {
                return (is_array($primaryKey)) ? $query->result_array() : $query->row_array();
            } else {
                return (is_array($primaryKey)) ? $query->result() : $query->row();
            }
        } else {
            return false; // Return false when no data or multiple rows are found
        }
    }



    /**
     * Filter employees based on the FIND_IN_SET function.
     *
     * This method filters employees based on the FIND_IN_SET function.
     *
     * @param string $column The column name to search in.
     * @param mixed $value The value to search for.
     * @return array The filtered employees.
     */
    public function filterByFindInSet(string $column = null, $value = null)
    {
        if (!empty($column) && !empty($value)) {
            $condition = "FIND_IN_SET('" . $this->db->escape_str($value) . "', " . $column . ")";
            $this->where($condition);
        }
        return $this;
    }




    public function validateData(array &$data = null, $is_updated = false)
    {
        if (empty($data)) {
            return ['error' => 'No data provided for validation'];
        }

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        // if($is_updated){
        //     $isFieldPresent = false;
        // }
        // Set validation rules
        foreach ($this->validationRules as $fieldName => $rules) {
            // if($is_updated){
            //     if (array_key_exists($fieldName, $data)) {
            //         $isFieldPresent = true;
            //     }
            // }

            if (
                !empty($this->validationMessages) &&
                is_array($this->validationMessages) &&
                array_key_exists($fieldName, $this->validationMessages) &&
                is_array($this->validationMessages[$fieldName])
            ) {
                if ($is_updated) {
                    if (array_key_exists($fieldName, $data)) {
                        $this->form_validation->set_rules($fieldName, $fieldName, $rules, $this->validationMessages[$fieldName]);
                    }
                } else {
                    $this->form_validation->set_rules($fieldName, $fieldName, $rules, $this->validationMessages[$fieldName]);
                }
            }
        }

        // If no fields to validate are present in the input data, return true
        // if (!$isFieldPresent) {
        //     return true;
        // }

        // Run validation
        $isValid = $this->form_validation->run();

        if (!$isValid) {
            // Validation failed, collect error messages
            $errors = [];

            foreach ($this->validationRules as $fieldName => $rules) {
                // Check each field for validation errors
                $error = trim(form_error($fieldName, ' ', ' ')); // Get error message for the field
                if (!empty($error)) {
                    $errors[$fieldName] = $error;
                }
            }
            // return ['errors' => $errors];
            if (!empty($errors)) {
                return ['errors' => $errors];
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function insertmultiple(array $data)
    {
        $fields = $this->allowedFields;
        $dataToInsert = array_intersect_key($data, array_flip($fields));
        if (!$this->skipValidation) {
            $validationResult = $this->validateData($dataToInsert);

            // if ($validationResult !== true) {
            if ($validationResult !== true && !empty($validationResult['errors'])) {

                // Return validation errors if any
                return $validationResult;
            }
        }
        // Get table fields from allowedFields (optional safety check)
        $fields = array_keys($data[0]);

        // Build query for multiple inserts
        $sql = "INSERT INTO " . $this->tableName . " (" . implode(',', $fields) . ") VALUES ";

        // Prepare values for batch insert
        $values = [];
        foreach ($data as $row) {
            $rowValues = array_map([$this->db, 'escape'], array_values($row)); // Escape values
            $values[] = "(" . implode(",", $rowValues) . ")";
        }

        $sql .= implode(",", $values); // Combine all rows

        // Execute the batch insert query
        return $this->db->query($sql);
    }

    public function insert(array $data, $returnQueryStringOnly = false, $returnLastInsertedId = false)
    {
        // Filter data to include only allowed fields
        $fields = $this->allowedFields;
        $dataToInsert = array_intersect_key($data, array_flip($fields));

        // Run validation only if skipValidation is falses
        if (!$this->skipValidation) {
            $validationResult = $this->validateData($dataToInsert);

            // if ($validationResult !== true) {
            if ($validationResult !== true && !empty($validationResult['errors'])) {

                // Return validation errors if any
                return $validationResult;
            }
        }

        // Construct the insert query
        $this->db->set($dataToInsert);
        if ($returnQueryStringOnly) {
            return $this->db->get_compiled_insert($this->tableName);
        }

        // Check if primary key already exists
        if (isset($dataToInsert[$this->primaryKey])) {
            $existingRecord = $this->db->get_where($this->tableName, array($this->primaryKey => $dataToInsert[$this->primaryKey]))->row_array();
            if ($existingRecord) {
                throw new Exception("Record with primary key '" . $dataToInsert[$this->primaryKey] . "' already exists in '" . $this->tableName . "'");
            }
        }

        // Perform the insertion
        // $this->beforeInsert($data, $dataToInsert);
        $this->beforeInsert($data, $dataToInsert);
        $success = $this->db->insert($this->tableName, $dataToInsert);
        $this->afterInsert($data, $dataToInsert);

        if (!$success) {
            throw new Exception("Failed to insert record into '" . $this->tableName . "'");
        }

        // Return the insert ID
        $this->lastInsertedId = $this->db->insert_id();
        if ($returnLastInsertedId) {
            return $this->db->insert_id();
        } else {
            return true; // Return true on successful insert
        }
    }

    /**
     * Insert batch data into the table.
     *
     * This method inserts multiple records at once.
     *
     * @param array $data Array of data to be inserted.
     * @param bool $returnQueryStringOnly If true, returns the query string only without executing the query.
     * @param bool $returnLastInsertedId If true, returns the last inserted ID.
     * @return mixed True on success, array of errors if validation fails, or query string.
     * @throws \Exception
     */
    public function insert_batch(array $data, bool $returnQueryStringOnly = false, bool $returnLastInsertedId = false)
    {
        if (empty($data)) {
            return ['error' => 'No data provided for batch insert'];
        }

        // Filter data to include only allowed fields
        $fields = $this->allowedFields;
        $dataToInsert = [];

        foreach ($data as $row) {
            $filteredRow = array_intersect_key($row, array_flip($fields));
            if (!empty($filteredRow)) {
                $dataToInsert[] = $filteredRow;
            }
        }

        // Run validation for each row if skipValidation is false
        if (!$this->skipValidation) {
            foreach ($dataToInsert as $row) {
                $validationResult = $this->validateData($row);
                if ($validationResult !== true && !empty($validationResult['errors'])) {
                    return $validationResult;
                }
            }
        }

        // Apply beforeInsert callbacks
        // $this->beforeInsert($data, $dataToInsert);

        if ($returnQueryStringOnly) {
            // For query string, we'll simulate with the first row
            $query = $this->db->table($this->tableName)->set($dataToInsert[0])->getCompiledInsert();
            return $query;
        }

        // Check for duplicate primary keys
        if (isset($dataToInsert[0][$this->primaryKey])) {
            $primaryKeyValues = array_column($dataToInsert, $this->primaryKey);
            $existingRecords = $this->db->table($this->tableName)
                ->whereIn($this->primaryKey, $primaryKeyValues)
                ->get()
                ->getResultArray();

            if (!empty($existingRecords)) {
                $existingIds = array_column($existingRecords, $this->primaryKey);
                throw new \Exception("Records with primary keys '" . implode("', '", $existingIds) . "' already exist in '" . $this->tableName . "'");
            }
        }

        // Perform the batch insertion
        $success = $this->db->insert_batch($this->tableName, $dataToInsert);

        if (!$success) {
            throw new \Exception("Failed to insert batch records into '" . $this->tableName . "'");
        }

        // Apply afterInsert callbacks
        $this->afterInsert($data, $dataToInsert);

        // Return the last insert ID if requested
        $this->lastInsertedId = $this->db->insert_id();
        if ($returnLastInsertedId) {
            return $this->lastInsertedId;
        } else {
            return true;
        }
    }


    /**
     * Update an existing record in the table.
     *
     * @param array &$data The data to be updated.
     * @param string|int|null $primaryKey The value of the primary key.
     * @param bool $returnQueryStringOnly If true, returns the query string only without executing the query.
     * @return bool|string True on success, the compiled update query string if $returnQueryStringOnly is true.
     * @throws Exception If primary key is not found or the update fails.
     */
    public function update(array &$data, $primaryKey = null, bool $returnQueryStringOnly = false)
    {
        $dataToUpdate = array_intersect_key($data, array_flip($this->allowedFields));
        // $this->validateData($dataToUpdate);

        if (!$this->skipValidation) {
            $validationResult = $this->validateData($dataToUpdate, true);
            if ($validationResult !== true) {
                // Return validation errors if any
                return $validationResult;
            }
        }


        // Check if primary key is provided in the data
        if ($primaryKey === null) {
            if (array_key_exists($this->primaryKey, $dataToUpdate) && !empty($dataToUpdate[$this->primaryKey])) {
                $primaryKey = $dataToUpdate[$this->primaryKey];
            }
        }
        // If primary key is still null, throw an exception
        if ($primaryKey === null) {
            throw new Exception("Primary key '" . $this->primaryKey . "' not found");
        }
        // Check if the primary key exists in the database
        $existingRecord = $this->db->get_where($this->tableName, array($this->primaryKey => $primaryKey))->row_array();

        if (!$existingRecord) {
            throw new Exception("Record with primary key '" . $primaryKey . "' does not exist");
        }
        // Construct the update query
        $this->db->where($this->primaryKey, $primaryKey);
        $this->db->set($dataToUpdate);
        if ($returnQueryStringOnly) {
            return $this->db->get_compiled_update($this->tableName);
        }

        $data['before_updated_record_' . $this->tableName] = $existingRecord;
        $this->beforeUpdate($data, $dataToUpdate);
        $success = $this->db->update($this->tableName, $dataToUpdate);
        $this->afterUpdate($data, $dataToUpdate);
        return $success;
    }

    /**
     * Delete a record from the database table by primary key.
     *
     * @param string|int $primaryKey The value of the primary key.
     * @return bool TRUE if the deletion was successful, FALSE otherwise.
     * @throws Exception When the record with the provided primary key does not exist or the deletion fails.
     */


    public function delete($primaryKey, bool $returnQueryStringOnly = false)
    {
        // Check if the record with the provided primary key exists
        $existingRecord = $this->db->get_where($this->tableName, [$this->primaryKey => $primaryKey])->row_array();
        if (!$existingRecord) {
            throw new Exception("Record with primary key '" . $primaryKey . "' does not exist in '" . $this->tableName . "'");
        }

        // Construct the delete query
        $this->db->where($this->primaryKey, $primaryKey);

        if ($returnQueryStringOnly) {
            return $this->db->get_compiled_delete($this->tableName);
        }

        // Perform the deletion inside a try-catch block
        try {
            $this->beforeDelete($existingRecord, $existingRecord);
            $success = $this->db->delete($this->tableName);
            $this->afterDelete($existingRecord, $existingRecord);

            if (!$success) {
                throw new Exception("Failed to delete record with primary key '" . $primaryKey . "' from '" . $this->tableName . "'");
            }

            return true;
        } catch (Exception $e) {
            // Check if the error is related to foreign key constraints
            if ($this->db->error()['code'] == 1451) {
                throw new Exception("Cannot delete record because it is referenced by another table.");
            }

            // Rethrow other exceptions
            throw $e;
        }
    }

    /**
     * Delete all records from the database table where the specified field has the provided value.
     *
     * @param string $fieldName The name of the field to check.
     * @param mixed $fieldValue The value of the field.
     * @return bool TRUE if the deletion was successful, FALSE otherwise.
     * @throws Exception When the deletion fails.
     */
    public function deleteAll($fieldName, $fieldValue)
    {
        // Construct the delete query
        $this->db->where($fieldName, $fieldValue);

        // Perform the deletion
        $this->beforeDeleteAll($fieldName, $fieldValue);
        $success = $this->db->delete($this->tableName);
        $this->afterDeleteAll($fieldName, $fieldValue);

        if (!$success) {
            throw new Exception("Failed to delete records from '" . $this->tableName . "' where '$fieldName' = '$fieldValue'");
        }

        return true;
    }




    /**
     * Save a record into the database table.
     *
     * This method checks if the record with the provided primary key already exists
     * and performs an update if it exists, otherwise inserts a new record.
     *
     * @param array $data Array of data to be saved.
     * @return bool TRUE if the operation was successful, FALSE otherwise.
     */
    public function save(array &$data, bool $returnQueryStringOnly = false)
    {
        $dataToProcess = array_intersect_key($data, array_flip($this->allowedFields));
        $this->validateData($dataToProcess);
        if (isset($dataToProcess[$this->primaryKey]) && !empty($dataToProcess[$this->primaryKey])) {
            // Check if the primary key exists in the database
            $existingRecord = $this->db->get_where($this->tableName, array($this->primaryKey => $dataToProcess[$this->primaryKey]))->row_array();
            if ($existingRecord) {
                if ($returnQueryStringOnly) {
                    return $this->db->get_compiled_update($this->tableName);
                }
                $data['before_updated_record_' . $this->tableName] = $existingRecord;
                $this->beforeUpdate($data, $dataToProcess);
                $result = $this->update($dataToProcess);
                $this->afterUpdate($data, $dataToProcess);
                return $result;
            }
        }
        // Insert new record
        if ($returnQueryStringOnly) {
            return $this->db->get_compiled_insert($this->tableName);
        }
        $this->beforeInsert($data, $dataToProcess);
        $result = $this->insert($dataToProcess);
        $this->afterInsert($data, $dataToProcess);
        $this->lastInsertedId = $this->db->insert_id();
        return $result; // Operation succeeded
    }
    /**
     * Executes an array of callback functions.
     *
     * This method iterates over an array of callback functions and calls each function
     * if it exists within the current class instance. It passes two arrays as parameters
     * to each callback function, which can be used for passing data if needed.
     *
     * @param array $callBackFunctions An array of callback function names.
     * @param array &$complete_data (Optional) An array containing complete data to be passed to callback functions.
     * @param array &$intersect_data (Optional) An array containing intersect data to be passed to callback functions.
     * @throws Exception If a specified callback function does not exist in the current class.
     */
    protected function callBackFunction(array $callBackFunctions = [], array &$complete_data = [], array &$intersect_data = [])
    {
        foreach ($callBackFunctions as $method) {
            if (method_exists($this, $method)) {
                // Call the method if it exists
                $this->{$method}($complete_data, $intersect_data);
            } else {
                // Handle case where method doesn't exist
                // You can throw an exception, log an error, or handle it in any other appropriate way
                throw new Exception("Method {$method} does not exist in class " . get_class($this));
            }
        }
    }
    /**
     * Execute callback functions before update operation.
     */
    // protected function beforeInsert(array &$complete_data = [], array &$intersect_data = [])
    // {
    //     if (isset($this->beforeInsert) && is_array($this->beforeInsert) && !empty($this->beforeInsert)) {
    //         $this->callBackFunction($this->beforeInsert, $complete_data, $intersect_data);
    //     }
    // }
    protected function beforeInsert(array &$complete_data = [], array &$intersect_data = [])
    {
        if (isset($this->beforeInsert) && is_array($this->beforeInsert) && !empty($this->beforeInsert)) {
            // Apply the callback functions and ensure the data is updated
            foreach ($this->beforeInsert as $callback) {
                $intersect_data = $this->$callback($intersect_data);
            }
        }
    }

    /**
     * Execute callback functions before update operation.
     */
    protected function beforeUpdate(array &$complete_data = [], array &$intersect_data = [])
    {
        // if (isset($this->beforeUpdate) && is_array($this->beforeUpdate) && !empty($this->beforeUpdate)) {
        //     $this->callBackFunction($this->beforeUpdate, $complete_data, $intersect_data);
        // }
        if (isset($this->beforeUpdate) && is_array($this->beforeUpdate) && !empty($this->beforeUpdate)) {
            // Apply the callback functions and ensure the data is updated
            foreach ($this->beforeUpdate as $callback) {
                $intersect_data = $this->$callback($intersect_data);
            }
        }
    }

    /**
     * Execute callback functions before delete operation.
     */
    protected function beforeDelete(array &$complete_data = [], array &$intersect_data = [])
    {
        if (isset($this->beforeDelete) && is_array($this->beforeDelete) && !empty($this->beforeDelete)) {
            $this->callBackFunction($this->beforeDelete, $complete_data, $intersect_data);
        }
    }

    /**
     * Execute callback functions after insert operation.
     */
    protected function afterInsert(array &$complete_data = [], array &$intersect_data = [])
    {
        if (isset($this->afterInsert) && is_array($this->afterInsert) && !empty($this->afterInsert)) {
            $this->callBackFunction($this->afterInsert, $complete_data, $intersect_data);
        }
    }

    /**
     * Execute callback functions after update operation.
     */
    protected function afterUpdate(array &$complete_data = [], array &$intersect_data = [])
    {
        if (isset($this->afterUpdate) && is_array($this->afterUpdate) && !empty($this->afterUpdate)) {
            $this->callBackFunction($this->afterUpdate, $complete_data, $intersect_data);
        }
    }

    /**
     * Execute callback functions after delete operation.
     */
    protected function afterDelete(array &$complete_data = [], array &$intersect_data = [])
    {
        if (isset($this->afterDelete) && is_array($this->afterDelete) && !empty($this->afterDelete)) {
            $this->callBackFunction($this->afterDelete, $complete_data, $intersect_data);
        }
    }


    /**
     * Execute callback functions before deleteAll operation.
     */
    protected function beforeDeleteAll(string $fieldName, $fieldValue)
    {
        if (isset($this->beforeDeleteAll) && is_array($this->beforeDeleteAll) && !empty($this->beforeDeleteAll)) {
            // Assuming you want to pass the field name and value to the callback functions
            $this->callBackFunction($this->beforeDeleteAll, $fieldName, $fieldValue);
        }
    }

    /**
     * Execute callback functions after deleteAll operation.
     */
    protected function afterDeleteAll(string $fieldName, $fieldValue)
    {
        if (isset($this->afterDeleteAll) && is_array($this->afterDeleteAll) && !empty($this->afterDeleteAll)) {
            // Assuming you want to pass the field name and value to the callback functions
            $this->callBackFunction($this->afterDeleteAll, $fieldName, $fieldValue);
        }
    }


    public function whereSociety($fieldName)
    {
        $session_data = $this->session->userdata('emp_data_session');
        $id = $session_data['emp_societyid'];
        return $this->filterByFindInSet($fieldName, $id);
    }

    public function whereSchool(string $fieldName)
    {
        $session_data = $this->session->userdata('emp_data_session');
        $id = $session_data['emp_schoolid'];
        return $this->filterByFindInSet($fieldName, $id);
    }

    public function whereAcademic($fieldName)
    {
        $session_data = $this->session->userdata('emp_data_session');
        $id = $session_data['acdemic_year_id'];
        return $this->where($fieldName, $id);
    }

    /**
     * Trims all string fields before insert and update operations.
     *
     * @param array $data Data to be inserted or updated
     * @return array Modified data with trimmed string fields
     */
    public function allTrim(array $data): array
    {
        foreach ($data as $key => &$value) {

            if (isset($this->excludeTrimFields) && in_array($key, $this->excludeTrimFields, true)) {
                continue;
            }

            if (is_string($value)) {
                $value = trim($value);
            }

            if ($value === '') {
                $value = null;
            }
        }

        return $data;
    }

    public function deleteAllWithMultiWhere($conditions)
    {
        // Check if $conditions is a valid array
        if (is_array($conditions)) {
            // Loop through each condition and add it to the WHERE clause
            foreach ($conditions as $fieldName => $fieldValue) {
                // Call the `beforeDeleteAll` function for each condition
                $this->beforeDeleteAll($fieldName, $fieldValue);

                // Add each condition as a separate `where` clause in the query
                $this->db->where($fieldName, $fieldValue);
            }
        } else {
            // If $conditions is not an array, throw an exception
            throw new Exception("The conditions parameter must be an associative array.");
        }

        // Perform the deletion operation using the table name defined in the model
        $success = $this->db->delete($this->tableName);

        // Loop through each condition again to call the `afterDeleteAll` function for each condition
        foreach ($conditions as $fieldName => $fieldValue) {
            // Call the `afterDeleteAll` function after the deletion for each field and value
            $this->afterDeleteAll($fieldName, $fieldValue);
        }

        // Check if the delete operation was successful
        if (!$success) {
            // If the delete failed, throw an exception with a meaningful message
            throw new Exception("Failed to delete records from '" . $this->tableName . "' with given conditions.");
        }

        // Return true if the deletion was successful
        return true;
    }

    /**
     * Get the count of records in a given table based on conditions.
     *
     * @param array $conditions Additional conditions to filter records.
     * @return int The total count of records.
     */
    public function getCount(array $conditions = []): int
    {
        if (empty($this->tableName) || empty($this->primaryKey)) {
            throw new Exception("Table name or primary key is not set.");
        }

        $this->db->select("COUNT($this->primaryKey) AS count");

        if (!empty($conditions)) {
            $this->db->where($conditions);
        }

        $query = $this->db->get($this->tableName);
        $result = $query->row();

        return $result ? (int) $result->count : 0;
    }

    /**
     * Set the LIMIT clause for the query.
     *
     * This method sets the limit and offset for the query.
     *
     * @param int $value The maximum number of rows to return.
     * @param int $offset The number of rows to skip (optional, defaults to 0).
     * @return $this The current instance of the ExtendFunctionModel class.
     */
    public function limit($value, $offset = 0)
    {
        // Ensure value is an integer and greater than 0
        $value = (int) $value;
        $offset = (int) $offset;

        if ($value > 0) {
            $this->limit = "$value, $offset";
        }
        return $this;
    }
}

class SchoolModel extends ExtendFunctionModel {}

class AcademicYearModel extends ExtendFunctionModel
{
    public string $tableName = "academic_year";
    public string $primaryKey = "acdemic_year_id";
    public array $allowedFields = ['acdemic_year_id', 'acdemic_from', 'acdemic_to', 'acdemic_year_name', 'academic_status', 'created_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    public array $validationRules = [
        'acdemic_year_id' => 'permit_empty',
        'acdemic_from' => "required|is_unique[academic_year.acdemic_from,acdemic_year_id]",
        'acdemic_to' => "required|is_unique[academic_year.acdemic_to,acdemic_year_id]",
        'acdemic_year_name' => "required|is_unique[academic_year.acdemic_year_name,acdemic_year_id]",

    ];
    public array $validationMessages = [
        'acdemic_from' => [
            'required' => 'This field is required.',
            'is_unique' => 'Academic from Date already exists.',
        ],
        'acdemic_to' => [
            'required' => 'This field is required.',
            'is_unique' => 'Academic to Date already exists.',
        ],
        'acdemic_year_name' => [
            'required' => 'This field is required.',
            'is_unique' => 'Academicyear Name  already exists.',
        ],

    ];
    public bool $skipValidation = false;

    /**
     * Get the default academic year, i.e., the current active year.
     * Returns an array containing a single row representing the current active year.
     *
     * @return array|null The current active academic year record.
     */
    public function getDefaultAcademicYear($data = null)
    {
        // Fetching the current active academic year
        $record = [];

        if (!empty($data)) {
            $record = $this->where('acdemic_year_id', $data)->findAll();
        } else {
            $record = $this->where('academic_status', '1')->findAll();
        }

        return $record;
    }

    public function getAcademicyear(&$filter = null)
    {
        try {
            $this->select('*');
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to Academic Year categories: ' . $e->getMessage());
            throw $e;
        }
    }

    function getLastFiveAcademicYears($currentYear)
    {
        $years = [];
        for ($i = 4; $i >= 0; $i--) {
            $startYear = date('Y', strtotime("-$i year", strtotime("$currentYear-04-01")));
            $endYear = date('y', strtotime("-$i year", strtotime("$currentYear-04-01 +1 year")));

            $startYearShort = substr($startYear, -2);
            $endYearShort = substr($endYear, -2);

            // Store academic year format like AY21-22
            $years[] = "AY$startYearShort-$endYearShort";
        }
        return $years;
    }

    /**
     * Get academic year ID based on a given date.
     *
     * @param string $date Date in 'Y-m-d' format.
     * @return int|false Returns academic_year_id if found, otherwise false.
     */
    public function getAcademicYearIdByDate(string $date)
    {
        $records = $this->where("acdemic_from <=", $date)
            ->where("acdemic_to >=", $date)
            ->findAll();

        return !empty($records) ? $records[0]['acdemic_year_id'] : false;
    }
}

class AssignCounselorModel extends ExtendFunctionModel
{
    public string $tableName = "add_assign_counselor";
    public string $primaryKey = "assigncounselor_id";
    public array $allowedFields = ['assigncounselor_id', 'assigncounselor_empid', 'assigncounselor_empname', 'assigncounselor_level', 'assigncounselor_areaid', 'assign_counselorcreatedate', 'assign_by_status', 'created_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    public array $validationRules = [];
    public array $validationMessages = [];
    public bool $skipValidation = false;
}

class HostelRoomTypeModel extends ExtendFunctionModel
{
    public string $tableName = "hostelroom_type";
    public string $primaryKey = "hostel_room_id";
    public array $allowedFields = ['hostel_room_id', 'hostel_room_type_name', 'created_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    public array $validationRules = [
        'hostel_room_id' => 'permit_empty',
        'hostel_room_type_name' => "required|regex_match[/^[a-zA-Z\s.,'-]+$/]|is_unique[hostelroom_type.hostel_room_type_name,hostel_room_id]",
    ];


    public array $validationMessages = [
        'hostel_room_type_name' => [
            'required' => 'This field is required.',
            'regex_match' => 'Invalid format',
            'is_unique' => 'Roomtype Name already exists.',
        ],
    ];
    public bool $skipValidation = false;
}


class HostelAllotmentModel extends ExtendFunctionModel
{
    public string $tableName = "hostel_allotment";
    public string $primaryKey = "alloted_id";
    public array $allowedFields = ['alloted_id', 'academic_year_id', 'school_id', 'alloted_date', 'alloted_student_id', 'alloted_employee_id', 'alloted_hostel_id', 'alloted_floor_id', 'alloted_room_id', 'hostel_leave_date', 'hostel_leave_remark', 'allotment_status', 'created_by', 'created_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    // public array $validationRules = [];
    // public array $validationMessages = [];
    public bool $skipValidation = false;

    public array $validationRules = [
        // 'alloted_id' => 'permit_empty',
        'school_id' => 'required',
        'alloted_date' => 'required',
        'alloted_hostel_id' => 'required',
        'alloted_floor_id' => 'required',
        'alloted_room_id' => 'required',

    ];

    public array $validationMessages = [
        'alloted_date' => [
            'required' => 'This field is required.',
        ],
        'alloted_hostel_id' => [
            'required' => 'This field is required.',

        ],
        'alloted_floor_id' => [
            'required' => 'This field is required.',

        ],
        'alloted_room_id' => [
            'required' => 'This field is required.',

        ],



    ];





    public function getHostelAllotDataShowApi(&$filter = null)
    {
        try {
            $this->tableAlias('hostelallot');
            $this->select(
                "
                hostelallot.*,
                hostelrooms.hostel_room_name,
                students.stu_admission_id,
                TRIM(CONCAT(
                    COALESCE(students.stu_firstname, ''), ' ',
                    COALESCE(students.stu_middlename, ''), ' ',
                    COALESCE(students.stu_lastname, '')
                )) AS allot_studentname,
                classlist.classlist_name,
                students.stu_fathername,
                students.stu_fathermobile,
                students.stu_fatheremail,
                students.present_streetno,
                hostel.hostel_name,
                floor.hostel_floor_name,
                employeeModel.empautonumber,
                employeeModel.emp_contactno,
                CONCAT(employeeModel.emp_firstname, ' ', employeeModel.emp_middlename, ' ', employeeModel.emp_lastname) AS hostel_employeename,
                CASE 
                    WHEN hostelallot.alloted_student_id IS NOT NULL AND hostelallot.alloted_student_id <> 0 
                        THEN TRIM(CONCAT(
                            COALESCE(students.stu_firstname, ''), ' ',
                            COALESCE(students.stu_middlename, ''), ' ',
                            COALESCE(students.stu_lastname, '')
                        ))
                    WHEN hostelallot.alloted_employee_id IS NOT NULL AND hostelallot.alloted_employee_id <> 0 
                        THEN CONCAT(employeeModel.emp_firstname, ' ', employeeModel.emp_middlename, ' ', employeeModel.emp_lastname)
                    ELSE NULL
                END AS unified_username",
                false
            );


            $this->where('hostelallot.allotment_status', '0');

            $this->join('hostel_rooms as hostelrooms', 'hostelallot.alloted_room_id=hostelrooms.hostel_room_id', 'left');
            $this->join('hostel as hostel', 'hostelallot.alloted_hostel_id=hostel.hostel_id', 'left');
            $this->join('hostel_floor as floor', 'hostelallot.alloted_floor_id=floor.hostel_floor_id', 'left');

            $this->join('students as students', 'hostelallot.alloted_student_id=students.student_id', 'left');
            $this->join('class_list as classlist', 'students.stu_class=classlist.classlist_id', 'left');

            $this->join(_LM_NewEmployeeModel()->tableName . " as employeeModel", "employeeModel.employee_id = hostelallot.alloted_employee_id", 'left');




            if (!empty($filter['school_id'])) {
                $this->where('hostelallot.school_id', $filter['school_id']);
            }

            if (!empty($filter['alloted_id'])) {
                $this->where('hostelallot.alloted_id', $filter['alloted_id']);
            }

            if (!empty($filter['alloted_student_id'])) {
                $this->where('hostelallot.alloted_student_id', $filter['alloted_student_id']);
            }

            if (!empty($filter['alloted_employee_id'])) {
                $this->where('hostelallot.alloted_employee_id', $filter['alloted_employee_id']);
            }
            $this->orderBy('hostelallot.alloted_id', 'DESC');
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Rooms Allot Data:' . $e->getMessage());
            throw $e;
        }
    }

    public function getAllotedHostelRoomsData(&$filter = null)
    {
        try {
            // $academicYearModel = _LM_AcademicYearModel()->getDefaultAcademicYear();
            $this->tableAlias('hostelallot');

            $this->select('hostelallot.*,hostelrooms.hostel_room_name,CONCAT(students.stu_firstname, " ", students.stu_middlename, " ", students.stu_lastname) AS allot_studentname,
            students.stu_admission_id,hostel.hostel_name,floor.hostel_floor_name,occupancy.occupancy_name,
             employeeModel.empautonumber,
                CONCAT(employeeModel.emp_firstname," ",employeeModel.emp_middlename," ",employeeModel.emp_lastname) as hostelallot_employeename');
            $this->where('hostelallot.allotment_status', '0');
            $this->join('hostel_rooms as hostelrooms', 'hostelallot.alloted_room_id=hostelrooms.hostel_room_id', 'left');
            $this->join('hostel as hostel', 'hostelallot.alloted_hostel_id=hostel.hostel_id', 'left');

            $this->join('hostel_floor as floor', 'hostelallot.alloted_floor_id=floor.hostel_floor_id', 'left');
            $this->join('students as students', 'hostelallot.alloted_student_id=students.student_id', 'left');
            $this->join('occupancy_type as occupancy', 'hostelrooms.hostel_occupancy_id=occupancy.occupancy_id', 'left');

            $this->join(_LM_NewEmployeeModel()->tableName . " as employeeModel", "employeeModel.employee_id = hostelallot.alloted_employee_id", 'left');

            if (!empty($filter['school_id'])) {
                $this->where('hostelallot.school_id', $filter['school_id']);
            }

            if (!empty($filter['employee_id'])) {
                $this->where('hostelallot.alloted_employee_id', $filter['employee_id']);
            }

            if (!empty($filter['student_id'])) {
                $this->where('hostelallot.alloted_student_id', $filter['student_id']);
            }

            if (!empty($filter['hostel_id'])) {
                $this->where('hostelallot.alloted_hostel_id', $filter['hostel_id']);
            }

            if (!empty($filter['hostel_floor_id'])) {
                $this->where('hostelallot.alloted_floor_id', $filter['hostel_floor_id']);
            }
            $this->orderBy('hostelallot.alloted_id', 'DESC');
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Rooms Allot Data:' . $e->getMessage());
            throw $e;
        }
    }

    public function getHostelLeaveData(&$filter = null)
    {
        try {

            $this->tableAlias('hostelallot');

            $this->select('hostelallot.*,hostelrooms.hostel_room_name,CONCAT(students.stu_firstname, " ", students.stu_middlename, " ", students.stu_lastname) AS allot_studentname,
            students.stu_admission_id,hostel.hostel_name,floor.hostel_floor_name,
            employeeModel.empautonumber,
                CONCAT(employeeModel.emp_firstname," ",employeeModel.emp_middlename," ",employeeModel.emp_lastname) as hostellers_employeename');
            $this->where('hostelallot.allotment_status', '1');
            $this->join('hostel_rooms as hostelrooms', 'hostelallot.alloted_room_id=hostelrooms.hostel_room_id', 'left');
            $this->join('hostel as hostel', 'hostelallot.alloted_hostel_id=hostel.hostel_id', 'left');

            $this->join('hostel_floor as floor', 'hostelallot.alloted_floor_id=floor.hostel_floor_id', 'left');
            $this->join('students as students', 'hostelallot.alloted_student_id=students.student_id', 'left');
            // $this->join('occupancy_type as occupancy', 'hostelrooms.hostel_occupancy_id=occupancy.occupancy_id', 'left');
            $this->join(_LM_NewEmployeeModel()->tableName . " as employeeModel", "employeeModel.employee_id = hostelallot.alloted_employee_id", 'left');

            if (!empty($filter['school_id'])) {
                $this->where('hostelallot.school_id', $filter['school_id']);
            }

            if (!empty($filter['hostel_id'])) {
                $this->where('hostelallot.alloted_hostel_id', $filter['hostel_id']);
            }
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Data:' . $e->getMessage());
            throw $e;
        }
    }

    function CheckStudentEmployeeExist($filter = null)
    {
        try {
            if (!empty($filter['alloted_student_id'])) {
                $existing_student = _LM_HostelAllotmentModel()
                    ->where('allotment_status', '0')
                    ->where('alloted_student_id', $filter['alloted_student_id'])
                    ->findAll();
                if ($existing_student) {
                    return [
                        'errors' => [
                            'alloted_student_id' => 'This User room already allotted.'
                        ]
                    ];
                }
            } elseif (!empty($filter['alloted_employee_id'])) {


                $existing_employee = _LM_HostelAllotmentModel()
                    ->where('allotment_status', '0')
                    ->where('alloted_employee_id', $filter['alloted_employee_id'])
                    ->findAll();


                if ($existing_employee) {
                    return [
                        'errors' => [
                            'alloted_employee_id' => 'This User room already allotted.'
                        ]
                    ];
                }
            }
            return true;
        } catch (Exception $e) {
            log_message('error', 'CheckStudentEmployeeExist Error: ' . $e->getMessage());
            return [
                'errors' => [
                    'exception' => 'An error occurred while checking allotment.'
                ]
            ];
        }
    }

    public function getAllotedHostelByStudent(&$filter = null)
    {
        try {
            $this->tableAlias('hostelallot');
            $this->select('hostelallot.*,hostelrooms.hostel_room_name,hostel.hostel_name,floor.hostel_floor_name');
            $this->where('hostelallot.allotment_status', '0');
            $this->join('hostel_rooms as hostelrooms', 'hostelallot.alloted_room_id=hostelrooms.hostel_room_id', 'left');
            $this->join('hostel as hostel', 'hostelallot.alloted_hostel_id=hostel.hostel_id', 'left');
            $this->join('hostel_floor as floor', 'hostelallot.alloted_floor_id=floor.hostel_floor_id', 'left');
            if (!empty($filter['student_id'])) {
                $this->where('hostelallot.alloted_student_id', $filter['student_id']);
            }
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Data:' . $e->getMessage());
            throw $e;
        }
    }
}

class HostelMessModel extends ExtendFunctionModel
{
    public string $tableName = "hostel_mess";
    public string $primaryKey = "hostel_mess_id";
    public array $allowedFields = ['hostel_mess_id', 'hostel_id', 'hostel_mess_date', 'hostel_mess_dishname', 'created_at', 'updated_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    // public array $validationRules = [];
    // public array $validationMessages = [];
    public bool $skipValidation = false;

    public array $validationRules = [
        'hostel_mess_id' => 'permit_empty',
        'hostel_id' => 'required|integer',
        'hostel_mess_date' => 'required',
        'hostel_mess_dishname' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
    ];
    public array $validationMessages = [
        'hostel_id' => [
            'required' => 'This field is required.',

        ],
        'hostel_mess_date' => [
            'required' => 'This field is required.',

        ],
        'hostel_mess_dishname' => [
            'required' => 'This field is required.',
            'regex_match' => 'please alphabetic characters and spaces Allow. ',

        ],
    ];

    public function getHostelMessData(&$filter = null)
    {
        try {
            $this->tableAlias('hostelmess');
            $this->select('hostelmess.*, hostel.hostel_name,');
            $this->join('hostel as hostel', 'hostelmess.hostel_id=hostel.hostel_id', 'left');
            if (!empty($filter['hostel_id'])) {
                $this->where('hostelmess.hostel_id', $filter['hostel_id']);
            }
            // if (!empty($filter['school_id'])) {
            //     $this->where('hostelmess.school_id', $filter['school_id']);
            // }
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Mess Data: ' . $e->getMessage());
            throw $e;
        }
    }
}

class HostelRoomsModel extends ExtendFunctionModel
{
    public string $tableName = "hostel_rooms";
    public string $primaryKey = "hostel_room_id";
    public array $allowedFields = ['hostel_room_id', 'school_id', 'hostel_id', 'hostel_floor_id', 'hostel_room_name', 'hostel_room_type_id', 'hostel_occupancy_id', 'alloted_status', 'created_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    // public array $validationRules = [];
    // public array $validationMessages = [];
    public bool $skipValidation = false;
    public array $validationRules = [
        'hostel_room_id' => 'permit_empty',
        'school_id' => 'required|integer',
        'hostel_id' => 'required|integer',
        'hostel_floor_id' => 'required|integer',
        'hostel_room_type_id' => 'required|integer',
    ];

    public array $validationMessages = [
        'school_id' => [
            'required' => 'This field is required.',
        ],

        'hostel_id' => [
            'required' => 'This field is required.',
        ],
        'hostel_floor_id' => [
            'required' => 'This field is required.',

        ],
        'hostel_room_type_id' => [
            'required' => 'This field is required.'
        ],
    ];

    public function getHostelRoomsDataShowApi(&$filter = null)
    {
        try {
            $this->tableAlias('hostelrooms');
            $this->select('hostelrooms.*,hostel.hostel_name,floor.hostel_floor_name,roomtype.hostel_room_type_name,occupancytype.occupancy_name');

            $this->join('hostel as hostel', 'hostelrooms.hostel_id=hostel.hostel_id', 'left');

            $this->join('hostel_floor as floor', 'hostelrooms.hostel_floor_id=floor.hostel_floor_id', 'left');

            $this->join('hostelroom_type as roomtype', 'hostelrooms.hostel_room_type_id=roomtype.hostel_room_id', 'left');

            $this->join('occupancy_type as occupancytype', 'hostelrooms.hostel_occupancy_id=occupancytype.occupancy_id', 'left');

            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Rooms Data:' . $e->getMessage());
            throw $e;
        }
    }

    public function getRoomnameByFloor($filter = null)
    {
        try {
            $this->tableAlias('rooms');
            $this->select('rooms.*,occupancytype.occupancy_name');

            // if (!empty($filter['hostel_floor_id'])) {
            $this->where('rooms.hostel_floor_id', $filter['hostel_floor_id']);
            // }
            $this->join('occupancy_type as occupancytype', 'rooms.hostel_occupancy_id=occupancytype.occupancy_id', 'left');
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Failed to room Name: ' . $e->getMessage());
            throw $e;
        }
    }

    public function check_hostelroom_available(&$filter = null)
    {
        try {
            // Select total rooms and allotted rooms for each occupancy type
            $this->tableAlias('hostelrooms');
            $this->select('occupancy.occupancy_name, occupancy.no_of_bed,
                       COUNT(hostelrooms.hostel_room_id) AS total_rooms,
                       COUNT(CASE WHEN hostelallot.allotment_status = 0 THEN hostelallot.alloted_room_id END) AS allotted_rooms_count');

            // Join tables
            $this->join('hostel_allotment as hostelallot', 'hostelrooms.hostel_room_id = hostelallot.alloted_room_id', 'left');
            $this->join('occupancy_type as occupancy', 'hostelrooms.hostel_occupancy_id = occupancy.occupancy_id', 'left');

            // Apply filter if provided
            // if (!empty($filter)) {
            $this->where('hostelrooms.hostel_room_id', $filter);
            // }

            $this->groupBy('occupancy.occupancy_name, occupancy.no_of_bed');
            $result = $this->findAll();

            // Calculate available rooms for each occupancy type
            foreach ($result as &$row) {
                $row['available_rooms'] = ($row['total_rooms'] * $row['no_of_bed']) - $row['allotted_rooms_count'];
            }

            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Room Availability Data: ' . $e->getMessage());
            throw $e;
        }
    }


    public function getHostelViewData(&$filter = null)
    {
        try {
            $this->tableAlias('hostelrooms');
            $this->select('hostelrooms.*, hostel.hostel_name, floor.hostel_floor_name, occupancytype.occupancy_name,occupancytype.no_of_bed,
            COUNT(hostelrooms.hostel_room_id) AS total_rooms,
            COUNT(CASE WHEN hostelallot.allotment_status = 0 THEN hostelallot.alloted_room_id END) AS allotted_rooms_count,
            COUNT(CASE WHEN hostelallot.allotment_status = 1 THEN hostelallot.alloted_room_id END) AS not_allotted_rooms_count,
            CONCAT(students.stu_firstname, " ", students.stu_middlename, " ", students.stu_lastname) AS Assign_bed_studentname');

            $this->join('hostel as hostel', 'hostelrooms.hostel_id=hostel.hostel_id', 'left');
            $this->join('hostel_floor as floor', 'hostelrooms.hostel_floor_id=floor.hostel_floor_id', 'left');
            $this->join('occupancy_type as occupancytype', 'hostelrooms.hostel_occupancy_id=occupancytype.occupancy_id', 'left');
            $this->join('hostel_allotment as hostelallot', 'hostelrooms.hostel_room_id = hostelallot.alloted_room_id', 'left');
            $this->join('students as students', 'hostelallot.alloted_student_id=students.student_id', 'left');

            if (!empty($filter['school_id'])) {
                $this->where('hostelrooms.school_id', $filter['school_id']);
            }

            if (!empty($filter['hostel_id'])) {
                $this->where('hostelrooms.hostel_id', $filter['hostel_id']);
            }

            $this->groupBy('hostelrooms.hostel_room_id, hostel.hostel_name, floor.hostel_floor_name, occupancytype.occupancy_name, occupancytype.no_of_bed');

            $result = $this->findAll();
            foreach ($result as &$row) {
                // Calculate available beds
                $row['available_bed'] = ($row['total_rooms'] * $row['no_of_bed']) - $row['allotted_rooms_count'];
            }

            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Rooms Data: ' . $e->getMessage());
            throw $e;
        }
    }
}

class HostelRulesModel extends ExtendFunctionModel
{
    public string $tableName = "hostel_rules";
    public string $primaryKey = "rule_id";
    public array $allowedFields = ['rule_id', 'rules', 'created_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    public array $validationRules = [
        'rule_id' => 'permit_empty',
        'rules' => "required|is_unique[hostel_rules.rules,rule_id]",
    ];


    public array $validationMessages = [
        'rules' => [
            'required' => 'This field is required.',
            'regex_match' => 'Invalid format',
            'is_unique' => 'Rules Name already exists.',
        ],
    ];
    public bool $skipValidation = false;
}

class HostelModel extends ExtendFunctionModel
{
    public string $tableName = "hostel";
    public string $primaryKey = "hostel_id";
    public array $allowedFields = ['hostel_id', 'hostel_society', 'hostel_school', 'hostel_name', 'hostel_address', 'hostel_state_id', 'hostel_city_id', 'hostel_pincode', 'hostel_contact', 'hostel_type', 'hostel_no_of_floor', 'created_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    // public array $validationRules = [];
    // public array $validationMessages = [];
    public bool $skipValidation = false;
    public array $validationRules = [
        'hostel_id' => 'permit_empty',
        'hostel_school' => 'required|integer',
        'hostel_name' => 'required',
        'hostel_address' => 'required',
        'hostel_state_id' => 'required',
        'hostel_city_id' => 'required',
        'hostel_pincode' => 'required|regex_match[/^[0-9]{6}$/]', // Assuming Indian PIN code format
        'hostel_contact' => 'required|regex_match[/^[0-9]{10}$/]', // Assuming Indian mobile number format
        'hostel_type' => 'required',
        'hostel_no_of_floor' => 'required|integer',


    ];

    public array $validationMessages = [
        'hostel_name' => [
            'required' => 'This field is required.',
        ],

        'hostel_address' => [
            'required' => 'This field is required.',
        ],
        'hostel_state_id' => [
            'required' => 'This field is required.',
        ],
        'hostel_city_id' => [
            'required' => 'This field is required.',
        ],
        'hostel_pincode' => [
            'required' => 'This field is required.',
            'regex_match' => 'Invalid PIN code format. It should be a 6-digit number.'
        ],
        'hostel_contact' => [
            'required' => 'This field is required.',
            'regex_match' => 'Invalid contact number format. It should be a 10-digit number.'
        ],
        'hostel_no_of_floor' => [
            'required' => 'This field is required.',
            'integer' => 'Number of floors must be an integer.'
        ],
        'hostel_type' => [
            'required' => 'This field is required.',
        ],
    ];


    public function getHostelDataShowApi(&$filter = null)
    {
        try {
            $this->tableAlias('hostel');
            $this->select('*,hostel.hostel_id,floor.hostel_floor_id,floor.hostel_floor_name,floor.floor_number_of_rooms');

            $this->join('hostel_floor as floor', 'hostel.hostel_id=floor.hostel_id', 'left');
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Hostel Data: ' . $e->getMessage());
            throw $e;
        }
    }
}
class HostelFloorModel extends ExtendFunctionModel
{
    public string $tableName = "hostel_floor";
    public string $primaryKey = "hostel_floor_id";
    public array $allowedFields = ['hostel_floor_id', 'hostel_id', 'hostel_floor_name', 'floor_number_of_rooms', 'create_at'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    public array $validationRules = [];
    public array $validationMessages = [];
    public bool $skipValidation = false;


    public function getRoomsByFloorname($filter = null)
    {
        try {
            $this->tableAlias('floor');
            $this->select('*');
            if (!empty($filter['hostel_floor_id'])) {
                $this->where('floor.hostel_floor_id', $filter['hostel_floor_id']);
            }
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Failed to fetch Floor Name: ' . $e->getMessage());
            throw $e;
        }
    }


    public function getFloorByHostel(&$filter = null)
    {
        try {
            $this->tableAlias('floor');
            $this->select('*');
            if ($filter['hostel_id']) {
                $this->where('floor.hostel_id', $filter['hostel_id']);
            }
            $result = $this->findAll();
            return $result;
        } catch (Exception $e) {
            // Log the error and rethrow the exception if needed
            log_message('error', 'Failed to fetch Floor Name: ' . $e->getMessage());
            throw $e;
        }
    }
}



class ProductsModel extends ExtendFunctionModel
{
    public string $tableName = "products";
    public string $primaryKey = "product_id";
    public array $allowedFields = ['product_id', 'product_name', 'category_id', 'subcategory_id'];
    // Callback functions
    // Before Create,Update,Delete
    public array $beforeInsert = ['alltrim'];
    public array $beforeUpdate = ['alltrim'];
    public array $beforeDelete = [];
    // After Create,Update.Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];
    // public array $validationRules = [];
    // public array $validationMessages = [];
    public bool $skipValidation = false;

    public array $validationRules = [
        // 'product_id' => 'permit_empty',
        // 'product_name' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
        // 'category_id' => 'required|integer',
        // 'subcategory_id' => 'required|integer',
    ];
    public array $validationMessages = [
        // 'product_id' => [
        //     'required' => 'This field is required.',
        // ],
        // 'product_name' => [
        //     'required' => 'This field is required.',
        //     'regex_match' => 'Please enter alphabetic characters and spaces only.',
        // ],
        // 'category_id' => [
        //     'required' => 'This field is required.',

        // ],
        // 'subcategory_id' => [
        //     'required' => 'This field is required.',
        // ]
    ];

    // public function getProductsData(&$filter = null)
    // {
    //     try {
    //         $this->tableAlias('products');
    //         $this->select('products.*');

    //         $result = $this->findAll();
    //         return $result;
    //     } catch (Exception $e) {
    //         // Log the error and rethrow the exception if needed
    //         log_message('error', 'Failed to fetch Products Data: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }
}
class UsersModel extends ExtendFunctionModel
{
    public string $tableName = "users";
    public string $primaryKey = "id";
    public array $allowedFields = ['id', 'name', 'email', 'password', 'token', 'created_at'];

    // Callback functions
    public array $beforeInsert = ['alltrim', 'hashPassword'];
    public array $beforeUpdate = ['alltrim', 'hashPassword'];
    public array $beforeDelete = [];

    // After Create, Update, Delete
    public array $afterInsert = [];
    public array $afterUpdate = [];
    public array $afterDelete = [];

    public bool $skipValidation = false;

    public array $validationRules = [
        // 'name' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
        // 'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        // 'password' => 'required|min_length[6]',
    ];

    public array $validationMessages = [
        // 'name' => [
        //     'required' => 'This field is required.',
        //     'regex_match' => 'Please enter alphabetic characters and spaces only.',
        // ],
        // 'email' => [
        //     'required' => 'This field is required.',
        //     'valid_email' => 'Please enter a valid email address.',
        //     'is_unique' => 'This email address is already registered.',
        // ],
        // 'password' => [
        //     'required' => 'This field is required.',
        //     'min_length' => 'Password must be at least 6 characters long.',
        // ]
    ];

    public function verifyCredentials($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $user = $query->row_array();

        // Check if user exists and password matches
        if ($user && $user['password'] == $password) {
            return $user;
        }

        return false;
    }
}




// class TemplateModel extends ExtendFunctionModel
// {
//     public string $tableName = "template";
//     public string $primaryKey = "template_id";
//     public array $allowedFields = [
//         'template_id',
//         'template_type',
//         'template_heading',
//         'email_send',
//         'email_subject',
//         'email_cc',
//         'email_body',
//         'email_attachment',
//         'sms_send',
//         'sms_template_name',
//         'sms_dlt_id',
//         'sms_message',
//         'notification_send',
//         'notification_title',
//         'notification_body',
//         'template_placeholder',
//         'created_at',
//         'updated_at'
//     ];

//     // Callback functions
//     // Before Create, Update, Delete
//     public array $beforeInsert = ['alltrim'];
//     public array $beforeUpdate = ['alltrim'];
//     public array $beforeDelete = [];

//     // After Create, Update, Delete
//     public array $afterInsert = [];
//     public array $afterUpdate = [];
//     public array $afterDelete = [];

//     public bool $skipValidation = false;

//     public array $validationRules = [
//         'template_type' => 'required|min_length[3]',
//         'template_heading' => 'required|min_length[3]',
//         'email_send' => 'required',
//         'email_attachment' => 'required',
//         'sms_send' => 'required',
//     ];

//     public array $validationMessages = [
//         'template_type' => [
//             'required' => 'This Field is required.',
//         ],
//         'template_heading' => [
//             'required' => 'This Field is required.',
//         ],
//         'email_send' => [
//             'required' => 'This Field status is required.',
//             'in_list' => 'This Field must be either 0 or 1.',
//         ],
//         'email_attachment' => [
//             'required' => 'This Field status is required.',
//             'in_list' => 'This Field must be either 0 or 1.',
//         ],
//         'sms_send' => [
//             'required' => 'SMS send status is required.',
//             'in_list' => 'SMS send must be either 0 or 1.',
//         ],
//     ];

//     public function updateBooleanFields($data)
//     {
//         $booleanFields = $this->booleanFields ?? null;

//         if (!isset($data['data']) || !is_array($data['data'])) {
//             return $data; // Handle edge case where 'data' is not set or not an array
//         }

//         foreach ($booleanFields as $key => $field) {
//             // Check if the field exists in the data and if its value indicates it's checked
//             if (isset($data['data'][$field])) {
//                 $data['data'][$field] = ($data['data'][$field] == 1 || $data['data'][$field] == 'on') ? 1 : 0; // Ensure it's explicitly set to 1 or 0
//             }
//         }

//         return $data;
//     }
// }

// class ThirdPartyIntegrationModel extends ExtendFunctionModel
// {
//     public string $tableName = "third_party_integration";
//     public string $primaryKey = "third_party_integration_id";
//     public array $allowedFields = [
//         'third_party_integration_heading',
//         'third_party_integration_type',
//         'third_party_integration_image',
//         'third_party_integration_testing_data',
//         'third_party_integration_production_data',
//         'third_party_integration_is_production',
//         'third_party_integration_is_active',
//         'created_at',
//         'updated_at'
//     ];

//     // Callback functions
//     // Before Create, Update, Delete
//     public array $beforeInsert = ['alltrim'];
//     public array $beforeUpdate = ['alltrim'];
//     public array $beforeDelete = [];

//     // After Create, Update, Delete
//     public array $afterInsert = [];
//     public array $afterUpdate = [];
//     public array $afterDelete = [];

//     public bool $skipValidation = false;

//     public array $validationRules = [
//         'third_party_integration_heading' => 'required|is_unique[third_party_integration.third_party_integration_heading,third_party_integration_id]',
//         'third_party_integration_type' => 'required|is_unique[third_party_integration.third_party_integration_type,third_party_integration_id]',
//         'third_party_integration_testing_data' => 'required',
//         'third_party_integration_production_data' => 'required',
//         'third_party_integration_is_production' => 'required',
//         'third_party_integration_is_active' => 'required'
//     ];
//     public array $validationMessages = [
//         'third_party_integration_heading' => [
//             'required' => 'This Field is required.',
//             'is_unique' => 'This Field must be unique.'
//         ],
//         'third_party_integration_type' => [
//             'required' => 'This Field is required.',
//             'is_unique' => 'This Field must be unique.'
//         ],
//         'third_party_integration_testing_data' => [
//             'required' => 'This Field is required.'
//         ],
//         'third_party_integration_production_data' => [
//             'required' => 'This Field is required.'
//         ],
//         'third_party_integration_is_production' => [
//             'required' => 'This Field is required.'
//         ],
//         'third_party_integration_is_active' => [
//             'required' => 'This Field is required.'
//         ]
//     ];
//     // protected function JwtEncodeThirdPartyInteragationData($data)
//     // {
//     //     // Retrieve JWT secret key from environment variables
//     //     $key = $_ENV['SECRET_KEY'] ?? "";
//     //     // Check if JWT secret key is set
//     //     if (empty($key)) {
//     //         throw new RuntimeException('SECRET_KEY not set in ENV');
//     //     }

//     //     // Algorithm for JWT token
//     //     $algorithm = 'HS256';
//     //     if (isset($data['data']['third_party_integration_testing_data'])) {
//     //         try {
//     //             // Generate JWT token
//     //             $token = $this->myjwt->generateToken($data['data']['third_party_integration_testing_data'] ?? []);
//     //             $data['data']['third_party_integration_testing_data'] = $token;
//     //         } catch (Exception $e) {
//     //             // Handle token generation error
//     //             throw new RuntimeException('Error generating JWT token: ' . $e->getMessage());
//     //         }
//     //     }
//     //     if (isset($data['data']['third_party_integration_production_data'])) {
//     //         try {
//     //             // Generate JWT token
//     //             $token = $this->myjwt->generateDataIntoJwtToken($data['data']['third_party_integration_testing_data'] ?? [],$key);
//     //             $data['data']['third_party_integration_production_data'] = $token;
//     //         } catch (Exception $e) {
//     //             // Handle token generation error
//     //             throw new RuntimeException('Error generating JWT token: ' . $e->getMessage());
//     //         }
//     //     }
//     //     return $data;
//     // }
//     public function getIntegrationDataByType(string $third_party_integration_type): array
//     {
//         $data = $this->where('third_party_integration_type', $third_party_integration_type)->findAll() ?: [];
//         $data = $data[0] ?? [];

//         if (!empty($data)) {
//             $data['third_party_integration_testing_data'] = (array) $this->myjwt->decodeToken($data['third_party_integration_testing_data']);

//             $data['third_party_integration_production_data'] = (array) $this->myjwt->decodeToken($data['third_party_integration_production_data']);
//         } else {
//             $data['third_party_integration_testing_data'] = [];
//             $data['third_party_integration_production_data'] = [];
//         }

//         return $data;
//     }
//     public function getEmailIntegrationFileds()
//     {
//         return [
//             [
//                 "field_name" => "protocol",
//                 "field_title" => "",
//                 "field_label" => "Protocol",
//                 "field_type" => "select",
//                 "field_validation" => "required",
//                 "field_default_value" => "smtp",
//                 "field_value" => null,
//                 "field_options" => ['smtp' => 'SMTP', 'mail' => 'MAIL', 'sendmail' => 'SEND MAIL'],
//             ],
//             [
//                 "field_name" => "smtp_host",
//                 "field_title" => "",
//                 "field_label" => "SMTP Host",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "smtp_port",
//                 "field_title" => "",
//                 "field_label" => "SMTP Port",
//                 "field_type" => "number",
//                 "field_validation" => "required|numeric",
//                 "field_default_value" => "587",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "sender_name",
//                 "field_title" => "Sender Name",
//                 "field_label" => "Sender Name",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "sender_email",
//                 "field_title" => "Sender Email",
//                 "field_label" => "Sender Email",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "smtp_user",
//                 "field_title" => "",
//                 "field_label" => "SMTP Username",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "smtp_pass",
//                 "field_title" => "",
//                 "field_label" => "SMTP Password",
//                 "field_type" => "password",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "mail_type",
//                 "field_title" => "",
//                 "field_label" => "Mail Type",
//                 "field_type" => "select",
//                 "field_validation" => "required",
//                 "field_default_value" => "html",
//                 "field_value" => null,
//                 "field_options" => ['html' => 'HTML', 'text' => 'Plain Text'],
//             ],
//             [
//                 "field_name" => "smtp_timeout",
//                 "field_title" => "",
//                 "field_label" => "SMTP Timeout (in seconds)",
//                 "field_type" => "number",
//                 "field_validation" => "required|numeric",
//                 "field_default_value" => 5,
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "smtp_crypto",
//                 "field_title" => "",
//                 "field_label" => "SMTP Encryption",
//                 "field_type" => "select",
//                 "field_validation" => "required",
//                 "field_default_value" => "tls",
//                 "field_value" => null,
//                 "field_options" => ['' => 'None', 'tls' => 'TLS', 'ssl' => 'SSL'],
//             ],
//         ];
//     }
//     public function getRozorpayIntegrationFileds()
//     {
//         return [
//             [
//                 "field_name" => "api_key",
//                 "field_title" => "",
//                 "field_label" => "Api Key",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "api_secret_key",
//                 "field_title" => "",
//                 "field_label" => "Api Secret Key",
//                 "field_type" => "password",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//         ];
//     }
//     public function getSmsIntegrationFileds()
//     {
//         return [
//             [
//                 "field_name" => "send_sms_url",
//                 "field_title" => "
//                 Placeholders:{{api_key}},{{username}},{{password}},{{sendername}},{{smstype}},{{peid}},{{templateid}},{{message}},{{numbers}}
//                 Sample Url:http://sms.messageindia.in/v2/sendSMS?username={{username}}&message={{message}}&sendername={{sendername}}&smstype={{smstype}}&numbers={{numbers}}&apikey={{api_key}}&peid={{peid}}&templateid={{templateid}}
//                 ",
//                 "field_label" => "Send Sms Url",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "http://sms.messageindia.in/v2/sendSMS?username={{username}}&message={{message}}&sendername={{sendername}}&smstype={{smstype}}&numbers={{numbers}}&apikey={{api_key}}&peid={{peid}}&templateid={{templateid}}",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "api_key",
//                 "field_title" => "",
//                 "field_label" => "Api Key",
//                 "field_type" => "text",
//                 "field_validation" => "",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "username",
//                 "field_title" => "",
//                 "field_label" => "Username",
//                 "field_type" => "text",
//                 "field_validation" => "",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "password",
//                 "field_title" => "",
//                 "field_label" => "Password",
//                 "field_type" => "password",
//                 "field_validation" => "",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "sendername",
//                 "field_title" => "",
//                 "field_label" => "Sender Name",
//                 "field_type" => "text",
//                 "field_validation" => "",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "smstype",
//                 "field_title" => "",
//                 "field_label" => "SMS TYPE",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "peid",
//                 "field_title" => "",
//                 "field_label" => "DLT PEID",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],

//             [
//                 "field_name" => "templateid",
//                 "field_title" => "",
//                 "field_label" => "Template ID",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//         ];
//     }
//     public function getFirebaseIntegrationFileds()
//     {
//         return [
//             [
//                 "field_name" => "firebase_project_number",
//                 "field_title" => "Project Setting -> General -> Project Number",
//                 "field_label" => "Project number",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "firebase_web_api_key",
//                 "field_title" => "Project Setting -> General -> Web API key",
//                 "field_label" => "Web API key",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "firebase_app_id",
//                 "field_title" => "Project Setting -> General -> Your Apps -> App ID",
//                 "field_label" => "App ID",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "firebase_config",
//                 "field_title" => "Project Setting -> General -> Your Apps -> SDK setup and configuration -> Config",
//                 "field_label" => "Firebase Config (JSON) Object",
//                 "field_type" => "textarea",
//                 "field_validation" => "required rows='5'",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "firebase_sender_id",
//                 "field_title" => "Project Setting -> Cloud Messaging -> Firebase Cloud Messaging API (V1) -> Sender ID",
//                 "field_label" => "Firebase Cloud Messaging API (V1) Sender ID",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "firebase_web_push_certificate_key_pair",
//                 "field_title" => "Project Setting -> Cloud Messaging -> Web configuration -> Web Push certificates",
//                 "field_label" => "Web Push certificates Key pair",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "firebase_web_push_certificate_private_key",
//                 "field_title" => "Project Setting -> Cloud Messaging -> Web configuration -> Web Push certificates -> Private key",
//                 "field_label" => "Web Push certificates Private Key",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "firebase_service_account_private_key",
//                 "field_title" => "Project Setting -> Cloud Messaging -> Web configuration -> Web Push certificates -> Private key",
//                 "field_label" => "Service Account Private Key (JSON) Object",
//                 "field_type" => "textarea",
//                 "field_validation" => "required rows='5'",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//         ];
//     }
//     public function getWhatsAppIntegrationsFileds()
//     {
//         return [
//             [
//                 "field_name" => "whatsapp_api_url",
//                 "field_title" => "",
//                 "field_label" => "WhatsApp URL",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//         ];
//     }
//     public function getGpsIntegrationFileds()
//     {
//         return [
//             [
//                 "field_name" => "gps_api_url",
//                 "field_title" => "GPS API URL (Header based authentication)",
//                 "field_label" => "GPS API URL",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//             [
//                 "field_name" => "gps_api_username",
//                 "field_title" => "This username will be passed in API request header",
//                 "field_label" => "API Username (Header)",
//                 "field_type" => "text",
//                 "field_validation" => "required",
//                 "field_default_value" => "",
//                 "field_value" => null,
//             ],
//         ];
//     }

//     // public function getGoogleoauthIntegrationFileds()
//     // {
//     //     return [
//     //         [
//     //             "field_name" => "api_key",
//     //             "field_title" => "",
//     //             "field_label" => "Api Key",
//     //             "field_type" => "text",
//     //             "field_validation" => "required",
//     //             "field_default_value" => "",
//     //             "field_value" => null,
//     //         ],
//     //         [
//     //             "field_name" => "api_secret_key",
//     //             "field_title" => "",
//     //             "field_label" => "Api Secret Key",
//     //             "field_type" => "password",
//     //             "field_validation" => "required",
//     //             "field_default_value" => "",
//     //             "field_value" => null,
//     //         ],
//     //     ];
//     // }
// }
