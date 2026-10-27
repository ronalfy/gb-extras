<?php
/**
 * Add ABSPATH exit guards to Composer-generated files.
 *
 * Runs via Composer's post-autoload-dump event.
 *
 * @package MediaRon_Block_Shortcuts_For_GB
 */

// Prevent direct web access, but allow CLI execution.
if ( ! defined( 'ABSPATH' ) && 'cli' !== PHP_SAPI ) {
	exit; // Exit if accessed directly.
}

$composer_dir = __DIR__ . '/../lib/composer';

if ( ! is_dir( $composer_dir ) ) {
	echo "Composer directory not found: {$composer_dir}\n";
	exit( 1 );
}

$files = glob( $composer_dir . '/*.php' );

if ( false === $files ) {
	echo "Failed to read files from {$composer_dir}\n";
	exit( 1 );
}

$guard = <<<'GUARD'

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

GUARD;

$updated = 0;
$skipped = 0;

foreach ( $files as $file ) {
	$contents = file_get_contents( $file );

	if ( false === $contents ) {
		echo "Failed to read {$file}\n";
		continue;
	}

	if ( false !== strpos( $contents, "defined( 'ABSPATH' )" ) ) {
		++$skipped;
		continue;
	}

	if ( substr( $contents, 0, 5 ) !== '<?php' ) {
		echo "Skipping {$file}: does not start with <?php\n";
		++$skipped;
		continue;
	}

	$remainder    = ltrim( substr( $contents, 5 ) );
	$new_contents = '<?php' . $guard . $remainder;

	$result = file_put_contents( $file, $new_contents, LOCK_EX );

	if ( false === $result ) {
		echo "Failed to write {$file}\n";
		continue;
	}

	echo "Guard added to {$file}\n";
	++$updated;
}

echo "Updated {$updated} file(s), skipped {$skipped} file(s).\n";
