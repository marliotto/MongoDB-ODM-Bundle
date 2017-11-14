<?php

namespace JPC\Bundle\MongoDBBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('jpc_mongo_db');

        $rootNode
            ->children()
                ->scalarNode('repository_class')
                    ->defaultNull()
                    ->end()
                ->booleanNode('debug')
                    ->defaultValue('%kernel.debug%')
                    ->end()
                ->arrayNode('host')
                    ->children()
                        ->scalarNode('address')
                            ->isRequired()
                            ->end()
                        ->integerNode('port')
                            ->defaultValue(27017)
                            ->end()
                        ->scalarNode('database')
                            ->isRequired()
                            ->end()
                    ->end()
                ->end()
                ->arrayNode('auth')
                    ->canBeEnabled()
                    ->children()
                        ->booleanNode('enabled')
                            ->defaultFalse()
                            ->end()
                        ->scalarNode('user')->isRequired()->end()
                        ->scalarNode('password')->isRequired()->end()
                        ->scalarNode('auth_database')->defaultValue('admin')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
