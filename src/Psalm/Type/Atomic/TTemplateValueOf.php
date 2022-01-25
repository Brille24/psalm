<?php

namespace Psalm\Type\Atomic;

use Psalm\Type\Atomic;
use Psalm\Type\Union;

/**
 * Represents the type used when using TValueOfArray when the type of the array is a template
 */
class TTemplateValueOf extends Atomic
{
    /**
     * @var string
     */
    public $param_name;

    /**
     * @var string
     */
    public $defining_class;

    /**
     * @var Union
     */
    public $as;

    public function __construct(
        string $param_name,
        string $defining_class,
        Union $as
    ) {
        $this->param_name = $param_name;
        $this->defining_class = $defining_class;
        $this->as = $as;
    }

    public function getKey(bool $include_extra = true): string
    {
        return 'value-of<' . $this->param_name . '>';
    }

    public function getId(bool $exact = true, bool $nested = false): string
    {
        if (!$exact) {
            return 'value-of<' . $this->param_name . '>';
        }

        return 'value-of<' . $this->param_name . ':' . $this->defining_class . ' as ' . $this->as->getId($exact) . '>';
    }

    /**
     * @param array<lowercase-string, string> $aliased_classes
     */
    public function toNamespacedString(
        ?string $namespace,
        array $aliased_classes,
        ?string $this_class,
        bool $use_phpdoc_format
    ): string {
        return 'value-of<' . $this->param_name . '>';
    }

    /**
     * @param  array<lowercase-string, string> $aliased_classes
     */
    public function toPhpString(
        ?string $namespace,
        array $aliased_classes,
        ?string $this_class,
        int $analysis_php_version_id
    ): ?string {
        return null;
    }

    public function canBeFullyExpressedInPhp(int $analysis_php_version_id): bool
    {
        return false;
    }
}
