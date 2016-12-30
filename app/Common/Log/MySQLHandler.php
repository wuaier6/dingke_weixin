<?php
/**
 * Created by PhpStorm.
 * User: Scott
 * Date: 2016/2/25 0025
 * Time: 11:50
 */

namespace App\Common\Log;

use App\Common\HttpHelper;
use App\Common\SessionHelper;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use PDO;
use PDOStatement;

class MySQLHandler extends AbstractProcessingHandler
{

    /**
     * @var bool defines whether the MySQL connection is been initialized
     */
    private $initialized = false;
    /**
     * @var PDO pdo object of database connection
     */
    protected $pdo;
    /**
     * @var PDOStatement statement to insert a new record
     */
    private $statement;
    /**
     * @var string the table to store the logs in
     */
    private $table = 'z_opt_log';


    /**
     * @var string[] additional fields to be stored in the database
     *
     * For each field $field, an additional context field with the name $field
     * is expected along the message, and further the database needs to have these fields
     * as the values are stored in the column name $field.
     */
    private $additionalFields = array();


    /**
     * Constructor of this class, sets the PDO and calls parent constructor
     *
     * @param PDO $pdo PDO Connector for the database
     * @param bool $table Table in the database to store the logs in
     * @param array $additionalFields Additional Context Parameters to store in database
     * @param bool|int $level Debug level which this handler should store
     * @param bool $bubble
     */
    public function __construct(
        PDO $pdo = NULL,
        $table,
        $additionalFields = array(),
        $level = Logger::DEBUG,
        $bubble = true
    )
    {
        if (!is_null($pdo)) {
            $this->pdo = $pdo;
        }
        $this->table = $table;
        $this->additionalFields = $additionalFields;
        parent::__construct($level, $bubble);
    }


    /**
     * Initializes this handler by creating the table if it not exists
     */
    private function initialize()
    {
        $this->statement = $this->pdo->prepare(
            'INSERT INTO `' . $this->table . '` ( log_type, url, user_id, user_name, create_at, ip, sql_content, status, message, log_level)
            VALUES (:log_type, :url, :user_id, :user_name, :create_at, :ip, :sql_content, :status, :message, :log_level)'
        );
        $this->initialized = true;
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     *
     * @return void
     */
    protected function write(array $record)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        if (!isset($record['context']["ip"])) {
            $ip = \Request::ip();
            $record['context']["ip"] = $ip == NULL ? '0.0.0.0' : $ip;
        }
        if (!isset($record['context']["user_id"])) {
            $record['context']["user_id"] = 0;
        }
        if (!isset($record['context']["user_name"])) {
            $record['context']["user_name"] = '';
        }
        if (!isset($record['context']["log_type"])) {
            $record['context']["log_type"] = config('zzmed.site.id');
        }
        if (!isset($record['context']["url"])) {
            $record['context']["url"] = \Request::path();
        }
        if (!isset($record['context']["sql_content"])) {
            $record['context']["sql_content"] = "";
        }
        if (!isset($record['context']["status"])) {
            $record['context']["status"] = 1;
        }
        //'context' contains the array
        $contentArray = array_merge(array(
            'log_level' => $record['level_name'],
            'message' => 'channel:' . $record['channel'] . '||message:' . $record['message'],
            'create_at' => $record['datetime']->format('Y-m-d H:i:s')
        ), $record['context']);
        //Fill content array with "null" values if not provided
//        $contentArray = $contentArray + array_combine(
//                $this->additionalFields,
//                array_fill(0, count($this->additionalFields), NULL)
//            );

        $this->statement->execute($contentArray);
    }
}