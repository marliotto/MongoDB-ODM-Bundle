<?php

namespace JPC\Bundle\MongoDBBundle\Factory;

use JPC\MongoDB\ODM\Factory\DocumentManagerFactory as BaseFactory;
use Symfony\Component\DependencyInjection\Container;

class DocumentManagerFactory extends BaseFactory {

    public function __construct($repositoryClass){
        parent::__construct($repositoryClass);
    }

    public function getDocumentManager($config){
        $uri = $this->buildMongoDBUri($config);
        return $this->createDocumentManager($uri, $config['host']['database'], $logger = null, $debug = $config['debug']);
    }

    public function buildMongoDBUri($config){
        $uri = "mongodb://";

        if($config['auth']['enabled']){
            $uri .= $config['auth']['user'] . ':' . urlencode($config['auth']['password']) . '@';
        }

        $uri .= $config['host']['address'] . ':' . $config['host']['port'];

        if($config['auth']['enabled']){
            $uri .= '/' . $config['auth']['auth_database'];
        }

        return $uri;
    }
}
