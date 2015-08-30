<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 8/30/2015
 * Time: 4:06 PM
 */

namespace Tim\CheatSheetBundle\Handler;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class LoggerDatabaseHandler extends AbstractProcessingHandler
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * @param integer $level The minimum logging level at which this handler will be triggered
     * @param Boolean $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * @param $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        if ('doctrine' == $record['channel']) {
            if ((int)$record['level'] >= Logger::WARNING) {
                error_log($record['message']);
            }
            return;
        }

        // todo: add save level from db
        if ((int)$record['level'] >= Logger::WARNING) {
            try {
                $em = $this->container->get('doctrine')->getManager();
                $conn = $em->getConnection();

                $created = date('Y-m-d H:i:s');
                $data = null;
                $userId = null;

                /** @var Request $request */
                $request = $this->container->get('request');
                if (!is_null($request)) {
                    $serverData = array();
                    $serverData[] = $request->server->get("HTTP_USER_AGENT");
                    $serverData[] = $request->server->get("SERVER_SOFTWARE");
                    $serverData[] = $request->server->get("SCRIPT_FILENAME");
                    $serverData[] = $request->server->get("QUERY_STRING");
                    $serverData[] = $request->server->get("REQUEST_URI");
                    $data = implode("; ", $serverData);
                }

                if (!is_null($this->container->get('security.token_storage')->getToken())) {
                    if (!is_null($this->container->get('security.token_storage')->getToken()->getUser())) {
                        if (!is_string($this->container->get('security.token_storage')->getToken()->getUser())) {
                            $userId = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
                        } else {
                            $userId = 'NULL';
                        }
                    }
                }

                $query = $em->getConnection()->prepare(
                    'INSERT INTO log(message, level, level_name, data, created_at, updated_at, user_id) VALUES('.
                    $conn->quote($record['message']) .', \''. $record['level'] .'\', \''. $record['level_name'] .
                    '\', '. $conn->quote($data) .', \''. $created .
                    '\', \''. $created .'\', \''. $userId .'\');'
                );
                $query->execute();
            } catch (\Exception $e) {
                error_log($record['message']);
                error_log($e->getMessage());
            }
        }
    }
}