<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;

class CustomLogHandler
{
    /**
     * Crea una instancia personalizada de Monolog.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $maxFiles = 5; // Número máximo de archivos de log a mantener
        $maxFileSize = 3 * 1024 * 1024 * 1024; // Tamaño máximo de archivo (3 GB)

        // Crea un manejador de archivo con el nombre de archivo rotado
        $handler = new StreamHandler($this->getRotatedFilename(), Logger::DEBUG, true, 0664);
        $handler->setFormatter(new LineFormatter(null, null, true, true));
        
        // Crea un logger con el manejador configurado
        $logger = new Logger('custom', [$handler]);
        $logger->pushProcessor(new IntrospectionProcessor());
        
        return $logger;
    }

    /**
     * Obtiene el nombre de archivo rotado.
     *
     * @return string
     */
    private function getRotatedFilename()
    {
        $logDir = storage_path('logs');
        $logFile = $logDir . '/laravel.log';

        // Rota los archivos de log si el archivo actual excede el tamaño máximo
        if (file_exists($logFile) && filesize($logFile) >= 3 * 1024 * 1024 * 1024) {
            $files = glob($logDir . '/laravel-*.log');
            natsort($files);

            // Renombra el archivo de log actual
            $latestFileIndex = count($files) + 1;
            rename($logFile, $logDir . "/laravel-{$latestFileIndex}.log");

            // Elimina archivos de log antiguos si exceden el número máximo permitido
            if (count($files) >= 5) {
                unlink($files[0]);
            }
        }

        return $logFile;
    }
}
