<?php

namespace Coa\ScroogeBundle\Command;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\ProgressHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Imports the ISV files located at http://coa.inducks.org/inducks/isv
 *
 * @author davide
 */
class ImportDatabaseCommand extends ContainerAwareCommand
{
    /**
     *
     * @var Connection
     */
    private $db;

    protected function configure()
    {
        $this->setName('coa:import');
        $this->addOption('uri', null, InputOption::VALUE_OPTIONAL, 'use a different location for isv files');
        $this->addOption('db', null, InputOption::VALUE_OPTIONAL, 'use an already initialized database');
        $this->addOption('tables', null, InputOption::VALUE_OPTIONAL, 'import specified comma separated tables');
    }

    protected function execute(InputInterface $input,
                               OutputInterface $output)
    {
        $db = $input->getOption('db');
        $tables = $input->hasOption('tables') ? explode(',', $input->getOption('tables')) : null;
        $uri = "http://coa.inducks.org/inducks/isv";
        if ($input->getOption('uri')) {
            $uri = $input->getOption('uri');
        }
        if (!$db) {
            $db = tempnam(sys_get_temp_dir(), 'coa_');
            $output->writeln("Creating database schema into [$dbTempFile]");
            $this->initDb($db);
        } else {
            $this->initDb($db, false);
        }
        $output->writeln('Retrieving isv list from [' . $uri . ']');
        $isvList = $this->retrieveIsvList($uri);
        foreach ($isvList as $isv) {
            $output->writeln("Importing [$isv]...");
            $this->import($isv, $output, $tables);
        }
        $output->writeln('Generating Full Text Indexes...');
        $fts = file_get_contents($this->getContainer()->getParameter('kernel.root_dir') . '/inducks_fts.sql');
        $this->db->beginTransaction();
        $this->db->exec($fts);
        $this->db->commit();
        $this->db->close();
        $prodDb = $this->getContainer()->getParameter('database_path');
        $output->writeln('Replacing production database');
        rename($db, $prodDb);

    }

    private function initDb($dbFile, $createSchema = true)
    {
        $c = new Configuration();
//        $c->setAutoCommit(false);
        $params = [
            'driver' => 'pdo_sqlite',
            'path' => $dbFile
        ];
        $this->db = DriverManager::getConnection($params, $c);
        if ($createSchema) {
            $schema = file_get_contents($this->getContainer()->getParameter('kernel.root_dir') . '/inducks_sqlite.sql');
            $this->db->beginTransaction();
            $this->db->exec($schema);
            $this->db->commit();
        }
    }

    private function import($isv, $out, $tables = null)
    {
        $table = basename($isv, '.isv');
        if ($tables != null && !in_array($table, $tables)) {
            $out->writeln("Skipping table $table, not in list");
            return;
        }
        /* @var $progress ProgressBar */
        $progress = $this->getHelper('progress');
        $progress->setFormat(ProgressHelper::FORMAT_VERBOSE_NOMAX);
        $progress->setRedrawFrequency(5000);
        $c = 0;
        $f = fopen($isv, 'r');
        stream_set_read_buffer($f, 2048 * 1000);       
        try {
            $header = [];
            $this->db->beginTransaction();
            $progress->start($out);

            while (($line = fgets($f)) !== false) {
                $fields = explode('^', $line, -1);
                if (empty($header)) {
                    $header = $fields;
                    continue;
                }
                if (count($header) != count($fields)) {
                    $fields = array_pad($fields, count($header), null);
                }
                $data = array_combine($header, $fields);
                $this->db->insert($table, $data);
                $c++;
                if ($c % 1000 == 0) {
                    $progress->advance(1000);
                    $this->db->commit();
                    $this->db->beginTransaction();
                }
            }
            $this->db->commit();
            if (!feof($f)) {
                throw new Exception("Error reading $isv");
            }
        } catch (Exception $ex) {
            fclose($f);
            throw $ex;
        }
        fclose($f);
        $progress->finish();
    }

    private function retrieveIsvList($uri)
    {
        $scheme = parse_url($uri, PHP_URL_SCHEME);
        if ($scheme == 'file') {
            $path = parse_url($uri, PHP_URL_PATH);
            if (!file_exists($path) || !is_dir($path)) {
                throw new Exception("Invalid path $path. Not exists or not is dir");
            }
            $isvs = glob("$path/*.isv");
            return $isvs;
        } else {
            // assume directory listing from http
            $index = file_get_contents($uri);
            $success = preg_match_all('/<a href="(.*\.isv)">/', $index, $matches);
            if ($success === false) {
                throw new \Exception("Index is invalid");
            }
            $isvs = $matches[1];
            $isvs = array_map(function($v) use($uri) { return "$uri/$v"; }, $isvs);
            return $isvs;
        }
    }


}