<?php

namespace App\GraphQL\Scalars;

use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;

class Json extends ScalarType
{
    public function serialize(mixed $value): mixed
    {
        return $value;
    }

    public function parseValue(mixed $value): mixed
    {
        return $value;
    }

    public function parseLiteral(Node $valueNode, ?array $variables = null): mixed
    {
        if ($valueNode instanceof StringValueNode) {
            return json_decode($valueNode->value, true);
        }

        return null;
    }
}
