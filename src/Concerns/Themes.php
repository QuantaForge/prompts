<?php

namespace QuantaForge\Prompts\Concerns;

use InvalidArgumentException;
use QuantaForge\Prompts\ConfirmPrompt;
use QuantaForge\Prompts\MultiSearchPrompt;
use QuantaForge\Prompts\MultiSelectPrompt;
use QuantaForge\Prompts\Note;
use QuantaForge\Prompts\PasswordPrompt;
use QuantaForge\Prompts\Progress;
use QuantaForge\Prompts\SearchPrompt;
use QuantaForge\Prompts\SelectPrompt;
use QuantaForge\Prompts\Spinner;
use QuantaForge\Prompts\SuggestPrompt;
use QuantaForge\Prompts\Table;
use QuantaForge\Prompts\TextPrompt;
use QuantaForge\Prompts\Themes\Default\ConfirmPromptRenderer;
use QuantaForge\Prompts\Themes\Default\MultiSearchPromptRenderer;
use QuantaForge\Prompts\Themes\Default\MultiSelectPromptRenderer;
use QuantaForge\Prompts\Themes\Default\NoteRenderer;
use QuantaForge\Prompts\Themes\Default\PasswordPromptRenderer;
use QuantaForge\Prompts\Themes\Default\ProgressRenderer;
use QuantaForge\Prompts\Themes\Default\SearchPromptRenderer;
use QuantaForge\Prompts\Themes\Default\SelectPromptRenderer;
use QuantaForge\Prompts\Themes\Default\SpinnerRenderer;
use QuantaForge\Prompts\Themes\Default\SuggestPromptRenderer;
use QuantaForge\Prompts\Themes\Default\TableRenderer;
use QuantaForge\Prompts\Themes\Default\TextPromptRenderer;

trait Themes
{
    /**
     * The name of the active theme.
     */
    protected static string $theme = 'default';

    /**
     * The available themes.
     *
     * @var array<string, array<class-string<\QuantaForge\Prompts\Prompt>, class-string<object&callable>>>
     */
    protected static array $themes = [
        'default' => [
            TextPrompt::class => TextPromptRenderer::class,
            PasswordPrompt::class => PasswordPromptRenderer::class,
            SelectPrompt::class => SelectPromptRenderer::class,
            MultiSelectPrompt::class => MultiSelectPromptRenderer::class,
            ConfirmPrompt::class => ConfirmPromptRenderer::class,
            SearchPrompt::class => SearchPromptRenderer::class,
            MultiSearchPrompt::class => MultiSearchPromptRenderer::class,
            SuggestPrompt::class => SuggestPromptRenderer::class,
            Spinner::class => SpinnerRenderer::class,
            Note::class => NoteRenderer::class,
            Table::class => TableRenderer::class,
            Progress::class => ProgressRenderer::class,
        ],
    ];

    /**
     * Get or set the active theme.
     *
     * @throws \InvalidArgumentException
     */
    public static function theme(string $name = null): string
    {
        if ($name === null) {
            return static::$theme;
        }

        if (! isset(static::$themes[$name])) {
            throw new InvalidArgumentException("Prompt theme [{$name}] not found.");
        }

        return static::$theme = $name;
    }

    /**
     * Add a new theme.
     *
     * @param  array<class-string<\QuantaForge\Prompts\Prompt>, class-string<object&callable>>  $renderers
     */
    public static function addTheme(string $name, array $renderers): void
    {
        if ($name === 'default') {
            throw new InvalidArgumentException('The default theme cannot be overridden.');
        }

        static::$themes[$name] = $renderers;
    }

    /**
     * Get the renderer for the current prompt.
     */
    protected function getRenderer(): callable
    {
        $class = get_class($this);

        return new (static::$themes[static::$theme][$class] ?? static::$themes['default'][$class])($this);
    }

    /**
     * Render the prompt using the active theme.
     */
    protected function renderTheme(): string
    {
        $renderer = $this->getRenderer();

        return $renderer($this);
    }
}
