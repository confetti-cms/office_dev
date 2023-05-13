<?php /** @noinspection DuplicatedCode */

declare(strict_types=1);

namespace Confetti\Components;

use Confetti\Helpers\ComponentEntity;
use Confetti\Helpers\ComponentStandard;
use Confetti\Helpers\ComponentStore;
use Confetti\Helpers\ContentStore;
use Confetti\Helpers\HasMapInterface;

return new class extends ComponentStandard implements HasMapInterface {
    public function get(): string
    {
        $component = $this->componentStore->findOrNull($this->id);
        if ($component !== null) {
            return $this->getValueFromOptions($component);
        }
        $component = $this->componentStore->findOrNull($this->id . '/-');
        if ($component !== null) {
            return $this->getValueFromByDirectory($component);
        }
        return '!!! Error: Component with type `select` need to have decoration `options` or `byDirectory` !!!';
    }

    public function getValueFromOptions(ComponentEntity $component): string
    {
        // Get saved value
        $content = $this->contentStore->find($this->id);
        if ($content !== null) {
            return $content;
        }

        // Get default value
        if ($component->hasDecoration('default')) {
            return $component->getDecoration('default')['value'];
        }

        // Get first option
        $options = $component->getDecoration('options')['options'];
        if (count($options) === 0) {
            return '';
        }
        return $component->getDecoration('options')['options'][0]['id'];
    }

    public function getValueFromByDirectory(ComponentEntity $component): string
    {
        // Get saved value
        $objectPath = $this->contentStore->find($this->id);
        if ($objectPath !== null) {
            if (str_ends_with($objectPath, '.blade.php')) {
                return self::getViewByPath($objectPath);
            }
            return $objectPath;
        }

        // Get default view
        $fileName = $component->getDecoration('default')['value'] ?? throw new \Exception('Error: No default defined. Use ->default(\'filename_without_directory\') to define the default value. In ' . $component->source);
        $target = $component->getDecoration('byDirectory')['target'];
        $objectPath = $target . '/' . $fileName;
        if (str_ends_with($objectPath, '.blade.php')) {
            return self::getViewByPath($objectPath);
        }
        return $objectPath;
    }

    public static function getAllOptions(ComponentEntity $component): array
    {
        $options = [];
        if ($component->hasDecoration('byDirectory')) {
            $target  = $component->getDecoration('byDirectory')['target'];
            $objects = new ComponentStore($target);
            foreach ($objects->whereParentKey($target) as $object) {
                $options[$object->key] = self::fileNameToLabel($object->source->file);
            }
        }
        if ($component->hasDecoration('options')) {
            foreach ($component->getDecoration('options')['options'] as $option) {
                $options[$option['id']] = $option['label'];
            }
        }
        return $options;
    }

    public function toMap(): Map
    {
        return new Map(
            $this->id . '/-',
            new ComponentStore($this->id . '/-'),
            new ContentStore(),
        );
    }

    private static function getViewByPath(string $path): string
    {
        $path = str_replace('.blade.php', '', $path);
        $path  = preg_replace('/^\/object/', '', $path);
        return str_replace('/', '.', $path);
    }

    private static function fileNameToLabel(string $file): string
    {
        $name = basename($file, '.blade.php');
        $name = str_replace(['-', '_'], ' ', $name);
        return ucwords($name);
    }
};
