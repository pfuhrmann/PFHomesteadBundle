<?php

namespace PF\HomesteadBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pf_homestead');

        $rootNode
            ->children()
                ->scalarNode('ip')->end()
                ->integerNode('memory')->end()
                ->integerNode('cpus')->end()
                ->scalarNode('hostname')->end()
                ->scalarNode('name')->end()
                ->scalarNode('provider')->end()
                ->scalarNode('authorize')->end()
                ->arrayNode('keys')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('folders')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('map')->isRequired()->end()
                            ->scalarNode('to')->isRequired()->end()
                            ->scalarNode('type')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('sites')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('map')->isRequired()->end()
                            ->scalarNode('to')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('databases')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('variables')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('key')->end()
                            ->scalarNode('value')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('blackfire')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('id')->end()
                            ->scalarNode('token')->end()
                            ->scalarNode('client-id')->end()
                            ->scalarNode('client-token')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('ports')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('send')->end()
                            ->scalarNode('to')->end()
                            ->scalarNode('protocol')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
