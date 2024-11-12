<?php

namespace App\Utils;

class Logger
{
    private $logFile;

    public function __construct($logFile = __DIR__ . '/../../logs/app.log')
    {
        $this->logFile = $logFile;
        $this->ensureLogFileExists();
    }

    private function ensureLogFileExists()
    {
        $logDir = dirname($this->logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true); // Kreira direktorijum ako ne postoji
        }
        if (!file_exists($this->logFile)) {
            file_put_contents(
                $this->logFile,
                ""
            ); // Kreira prazan log fajl ako ne postoji
        }
    }

    public function log($level, $message, array $context = [])
    {
        $timestamp = date('Y-m-d H:i:s');
        $contextString = json_encode($context);
        $logMessage = "[$timestamp] [$level] $message $contextString" . PHP_EOL;
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }

    public function info($message, array $context = [])
    {
        $this->log('INFO', $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->log('WARNING', $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->log('ERROR', $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->log('CRITICAL', $message, $context);
    }
//PRIMENA
//$logger = new \App\Utils\Logger();
//
//// Za različite tipove informacija koristi odgovarajući nivo logovanja
//$logger->debug('Debugging information', ['variable' => 'value']);
//$logger->info('Informational message');
//$logger->warning('Warning about potential issues');
//$logger->error('Error encountered in application');
//$logger->critical('Critical issue that needs immediate attention');
}