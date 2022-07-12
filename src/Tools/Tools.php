<?php

function explodeFormattedNames(string $names): array
{
    $unformattedNames = explode(separator: ',',string: $names);
    $out = [];

    foreach ($unformattedNames as $name){
        $out = trim($name);
    }

    return $unformattedNames;
}