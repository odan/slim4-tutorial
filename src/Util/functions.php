<?php

/**
 * Convert all applicable characters to HTML entities.
 *
 * @param string $text The string
 *
 * @return string The html encoded string
 */
function html(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Set locale
 *
 * @param string $locale The locale e.g. en_US
 * @param string $domain The text domain
 *
 * @retrun void
 */
function set_locale($locale = 'en_US', $domain = 'messages'): void
{
    $codeset = 'UTF-8';
    $directory = __DIR__ . '/../../resources/text';

    // Activate the locale settings
    putenv('LC_ALL=' . $locale);
    setlocale(LC_ALL, $locale);

    // Debugging output
    $file = sprintf('%s/%s/LC_MESSAGES/%s_%s.mo', $directory, $locale, $domain, $locale);

    // Generate new text domain
    $textDomain = sprintf('%s_%s', $domain, $locale);

    // Set base directory for all locales
    bindtextdomain($textDomain, $directory);

    // Set domain codeset (optional)
    bind_textdomain_codeset($textDomain, $codeset);

    // File: ./text/de_DE/LC_MESSAGES/messages_de_DE.mo
    textdomain($textDomain);
}

/**
 * Text translation (I18n)
 *
 * @param string $message
 * @param mixed[] ...$context
 *
 * @return string
 *
 * <code>
 * echo __('Hello');
 * echo __('There are %s persons logged', 7);
 * </code>
 */
function __(string $message, ...$context): string
{
    $translated = gettext($message);

    if (!empty($context)) {
        $translated = vsprintf($translated, $context);
    }

    return $translated;
}
