<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('Resources')
    ->exclude('travis')
    ->exclude('vendor')
    ->in(__DIR__)
;
return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;