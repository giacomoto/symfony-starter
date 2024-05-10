<?php

namespace App\Entity\Trait;

trait TEntityIsClonable {
    public function clone($withRelations = false): self
    {
        $cloned = clone($this);

        if ($withRelations) {
            $reflect = new \ReflectionClass($this);

            $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PRIVATE);

            foreach ($props as $prop) {
                $value = $prop->getValue($this);
                if (is_object($value)) {
                    $clonedValue = clone $value;
                    $prop->setValue($cloned, $clonedValue);
                }
            }
        }

        $cloned->id = null;

        return $cloned;
    }
}
