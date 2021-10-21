<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class ProcessorFactory
{
    public function __construct()
    {
    }

    public function createFromOutputParserName(string $outputParserName): ?AbstractCommandParser
    {
        $className = 'Reconmap\\CommandOutputParsers\\' . ucfirst($outputParserName) . 'OutputProcessor';

        if (class_exists($className)) {
            return new $className();
        }

        return null;
    }

    public function getAll(): array
    {
        $currentDir = __DIR__;
        $fileIterator = new \GlobIterator("$currentDir/*OutputProcessor.php");

        $list = [];
        foreach ($fileIterator as $file) {
            $fileName = $file->getFileName();
            $commandName = str_replace('OutputProcessor.php', '', $fileName);
            $commandCode = strtolower($commandName);
            $list[] = ['name' => $commandName, 'code' => $commandCode];
        }
        return $list;
    }
}
